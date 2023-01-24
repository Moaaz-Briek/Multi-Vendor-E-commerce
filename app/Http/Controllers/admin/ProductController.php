<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_Attribute;
use App\Models\Section;
use App\Traits\CommonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    use CommonController;
    //Display All categories
    public function products(){
        Session::put('page','products');
        $products = Product::with([
            'section'=>function($query){$query->select('id', 'name');},
            'category'=>function($query){$query->select('id', 'category_name');},
            'vendor'=>function($query){$query->select('id', 'name');},
            'brand'=>function($query){$query->select('id', 'name');},
            'admin'=>function($query){$query->select('id', 'type');},
        ])->get()->toArray();
        return view('admin.products.products')->with(compact('products'));
    }

    //Update Product status
    public function UpdateProductStatus(Request $request, Product $product){
        $arr = $this->UpdateStatus($request, $product);
        return response()->json($arr);
    }
    public function UpdateProductAttributeStatus(Request $request, Product_Attribute $product_Attribute){
        $arr = $this->UpdateStatus($request, $product_Attribute);
        return response()->json($arr);
    }

    //Add Product
    public function AddProduct(Request $request){
        if($request->isMethod('post')){
//            dd($request->toArray());
            //Upload Product Image after resize
            //small: 250*250, medium: 500*500, large: 1000*1000
            if ($request->hasFile('product_image')) {
                $image_tmp = $request->file('product_image');
                if ($image_tmp->isValid()) {
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate New Image Name
                    $imageName = rand(111, 9999) . '.' . $extension;
                    $LargeImagePath = 'front/images/product_images/large/' . $imageName;
                    $mediumImagePath = 'front/images/product_images/medium/' . $imageName;
                    $smallImagePath = 'front/images/product_images/small/' . $imageName;
                    //Upload The Image after resizing
                    Image::make($image_tmp)->resize(1000,1000)->save($LargeImagePath);
                    Image::make($image_tmp)->resize(500 ,500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250,250)->save($smallImagePath);
                }
            }
            else {
                $imageName = '';
            }

            //Product Video
            if($request->hasFile('product_video')){
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()){
                    //Upload video in video folder
                    $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    $mimetype = $video_tmp->getMimeType();
                    $videoName = $video_name .'_'.rand() . '.' .$extension;
                    $videoPath = 'front/videos/product_videos/';
                    // we didn't use Intervention package as we did with product image because it's not work with videos.
                    $video_tmp->move($videoPath,$videoName);
                }
            }else{
                $videoName = '';
            }

            $rules = [
                    "section_id" => "required|numeric|regex:/^[\d]+$/",
                    "category_id" => "regex:/(^[\d]+$)?/",
                    "sub_category_id" => "regex:/(^[\d]+$)?/",
                    "brand_id" => "required|numeric|regex:/^[\d]+$/",
                    "product_name" => "required|regex:/^[\pL\s\-*]+$/u",
                    "product_color" => "required|regex:/^[\d\w\#]+$/",
                    "product_code" => "required|regex:/^[\d\pL]+$/",
                    "product_price" => "required|numeric|regex:/^[\d]+$/",
                    "product_discount" => "required|numeric|regex:/^[\d]+$/",
                    "product_weight" => "required|numeric|regex:/^[\d]+$/",
                    "meta_title" => "required|regex:/^[\pL\s\-*]+$/u",
                    "meta_description" => "required|regex:/^[\pL\s\-*]+$/u",
                    "meta_keywords" => "required|regex:/^[\pL\s\-*]+$/u",
                    "product_description" => "required|regex:/^[\pL\s\-*]+$/u",
                    "is_featured" => "required|regex:/^[\pL\s\-*]+$/u",
                    'product_image' => 'mimes:jpg,png,jpeg,gif,svg|max:2048',
//                    'product_video' => 'required|mimes:video/mp4,qt|max:2000000',
            ];

            $this->validate($request, $rules);
            //Insert Data into database
            $admin_type = Auth::guard('admin')->user()->type;
            $admin_id = Auth::guard('admin')->user()->id;
            $vendor_id = Auth::guard('admin')->user()->vendor_id;
            ($admin_type == 'vendor') ?  : $vendor_id = 0;
            $data = $request->all();
            $data['category_id'] = (empty($data['category_id'])) ? null : $data['category_id'];
            $data['sub_category_id'] = (empty($data['sub_category_id'])) ? null : $data['sub_category_id'];
            ($data['is_featured'] == 'yes') ?  : $data['is_featured'] = "No";
            Product::insert([
                "section_id" => $data['section_id'],
                "category_id" => $data['category_id'],
                "sub_category_id" => $data['sub_category_id'],
                "brand_id" => $data['brand_id'],
                "product_name" => $data['product_name'],
                "product_color" => $data['product_color'],
                "product_code" => $data['product_code'],
                "product_price" => $data['product_price'],
                "product_discount" => $data['product_discount'],
                "product_weight" => $data['product_weight'],
                "meta_title" => $data['meta_title'],
                "meta_description" => $data['meta_description'],
                "meta_keywords" => $data['meta_keywords'],
                "product_description" => $data['product_description'],
                "is_featured" => $data['is_featured'],
                "product_status" => $data['product_status'],
                "admin_type" => $admin_type,
                "admin_id" => $admin_id,
                "vendor_id" => $vendor_id,
                "product_image" => $imageName,
                "product_video" => $videoName,
            ]);
            return redirect('admin/products')->with('success_message', 'Product has been Added Succeessfully!');
        }
        else {
            $sections = Section::with('Categories')->get()->toArray();
            $brands = Brand::get()->toArray();
//            return $brands;
//            return $sections;
            return view('admin.products.add_product')->with(compact('sections', 'brands'));
        }
    }
    public function GetSectionProduct(Request $request){
        if($request->ajax())
        {
            $data = $request->all();
            $categ = Product::with('Section')->where(['section_id' => $data['section_id'], 'parent_id' => 0])->pluck('id','category_name');
            return response()->json($categ);
        }
    }
    public function GetSubCategory(Request $request){
        if($request->ajax())
        {
            $data = $request->all();
            $categ = Category::with('SubCategory')->where(['parent_id' => $data['category_id']])->pluck('id','category_name');
            return response()->json($categ);
        }
    }
    //Delete Product
    public function DeleteProduct($id){
        Product::where('id',$id)->delete();
        $message = 'Product has been deleted successfully!';
        return redirect()->back()->with('success_message',$message);
    }
    //Edit Product Information
    public function EditProduct(Request $request,$id=null){
        if($request->isMethod('post')){
            $data = $request->all();
//                dd($data);
            //Upload Admin Image
            if($request->hasFile('category_image')){
                $image_tmp = $request->file('category_image');
                if($image_tmp->isValid()){
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate New Image Name
                    $imageName = rand(111,9999).'.'.$extension;
                    $imagePath = 'front/images/category_images/'.$imageName;
                    //Upload The Image
                    Image::make($image_tmp)->save($imagePath);
                }
            }
            else if(!empty($data['current_category_image'])){
                $imageName = $data['current_category_image'];
            }
            else{
                $imageName = '';
            }

            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'meta_description' => 'required|regex:/^[\pL\s\-]+$/u',
                'meta_keywords' => 'required|regex:/^[\pL\s\-]+$/u',
                'description' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'parent_id' => 'required',
                'category_discount' => 'required',
                'url' => 'required',
                'status' => 'required',
                'category_image' => 'required',

            ];

            $customMessages = [
                'category_name.required' => 'Product Name is Required',
                'category_name.regex' => 'Valid Product Name is Required',
                'meta_description.required' => 'Meta Description Name is Required',
                'meta_description.regex' => 'Valid Meta Description Name is Required',
                'meta_keywords.required' => 'Meta Keyword Name is Required',
                'meta_keywords.regex' => 'Valid Meta Keyword Name is Required',
                'description.required' => 'Description Name is Required',
                'description.regex' => 'Valid Description Name is Required',
                'section_id.required' => 'Section Name is Required',
                'parent_id.required' => 'Parent Product Name is Required',
                'category_discount.required' => 'Product Discount is Required',
                'url.required' => 'Url Name is Required',
                'status.required' => 'Status is Required',
                'category_image.required' => 'Product Image is Required',
            ];
            $this->validate($request, $rules, $customMessages);

            Product::where('id', $data['id'])->update([
                'category_name' => $data['category_name'],
                'section_id' => $data['section_id'],
                'parent_id' => $data['parent_id'],
                'category_discount' => $data['category_discount'],
                'url' => $data['url'],
                'meta_title' => $data['meta_title'],
                'meta_description' => $data['meta_description'],
                'meta_keywords' => $data['meta_keywords'],
                'status' => $data['status'],
                'description' => $data['description'],
                'category_image' => $imageName,
            ]);
            return redirect('admin/categories')->with('success_message', 'Product has been Updated Succeessfully!');
        }
        else{
            $sections = Section::get()->toArray();
            $category = Product::with('Section', 'ParentProduct')->where('id', $id)->get()->first()->toArray();
//            dd($category);
            return view('admin.categories.edit_category')->with(compact('category', 'sections'));
        }
    }
    //Add new product attribute
    public function AddAttribute(Request $request, $id=null){
        if($request->isMethod('post')){
            $data = $request->all();
//            dd($data);
            foreach($data['sku'] as $key => $value){
                if(!empty($value)){
                    //Check SKU Duplicate before insertion
                    $SKUCount = Product_Attribute::where('sku', $value)->count();
                    if($SKUCount > 0){
                        return redirect()->back()->with('error_message', 'SKU already exists, please add another SKU!');
                    }
                    //Check Size Duplicate before insertion
                    $SizeCount = Product_Attribute::where('size', $data['size'])->count();
                    if($SizeCount > 0){
                        return redirect()->back()->with('error_message', 'Size already exists, please add another Size!');
                    }
                    Product_Attribute::insert([
                        'product_id' => $data['id'],
                        'sku' => $value,
                        'size' => $data['size'][$key],
                        'price' => $data['price'][$key],
                        'stock' => $data['stock'][$key],
                        'status' => 1,
                    ]);
                }
            }
            return redirect()->back()->with('success_message', 'Product Attributes have been added successfully');
        }
        $product = Product::select('id','product_name','product_color','product_code','product_price','product_image')->with('Attributes')->find($id);
//        dd($product);
        return view('admin.products.add_edit_attribute')->with(compact('product'));
    }
    //Delete Product
    public function DeleteProductAttribute($id){
        Product_Attribute::where('id',$id)->delete();
        $message = 'Product Attribute has been deleted successfully!';
        return redirect()->back()->with('success_message',$message);
    }
    public function UpdateProductAttributeValues(Request $request){
        $data = $request->all();
//        dd($data);
        foreach ($data['attribute_id'] as $key => $value){
            if(!empty($value)){
                Product_Attribute::where('id', $value)->update([
                    'price' => $data['price'][$key],
                    'stock' => $data['stock'][$key],
                ]);
            }
        }
        $message = 'Product Attribute has been updated successfully!';
        return redirect()->back()->with('success_message',$message);
    }

}
