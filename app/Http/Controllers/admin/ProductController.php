<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use App\Traits\CommonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    //Add Product
    public function AddProduct(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
//            dd($data);
//            return $request;
            //Upload Vendor Image
//            if ($request->hasFile('product_image')) {
//                $image_tmp = $request->file('product_image');
//                if ($image_tmp->isValid()) {
//                    //Get Image Extension
//                    $extension = $image_tmp->getClientOriginalExtension();
//                    //Generate New Image Name
//                    $imageName = rand(111, 9999) . '.' . $extension;
//                    $imagePath = 'front/images/product_images/' . $imageName;
//                    //Upload The Image
//                    Image::make($image_tmp)->save($imagePath);
//                }
//            }
//            else {
//                $imageName = '';
//            }
            $rules = [
                    "section_id" => "required|numeric|regex:/^[\d]+$/",
                    "category_id" => "required|numeric|regex:/^[\d]+$/",
                    "sub_category_id" => "required|numeric|regex:/^[\d]+$/",
                    "brand_id" => "required|numeric|regex:/^[\d]+$/",
                    "product_name" => "required|regex:/^[\pL\s\-*]+$/u",
                    "product_color" => "required|regex:/^[\d\w\#]+$/",
                    "product_code" => "required|regex:/^[\d\w]+$/",
                    "product_price" => "required|numeric|regex:/^[\d]+$/",
                    "product_discount" => "required|numeric|regex:/^[\d]+$/",
                    "product_weight" => "required|numeric|regex:/^[\d]+$/",
                    "meta_title" => "required|regex:/^[\pL\s\-*]+$/u",
                    "meta_description" => "required|regex:/^[\pL\s\-*]+$/u",
                    "meta_keywords" => "required|regex:/^[\pL\s\-*]+$/u",
                    "product_description" => "required|regex:/^[\pL\s\-*]+$/u",
                    "is_featured" => "required|regex:/^[\pL\s\-*]+$/u",
                    'product_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dime',
                    'product_video' => 'required|mimes:video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv| max:20000',
            ];

            $this->validate($request, $rules);
            //Insert Data into database
            $data = $request->all();
            $admin_type = Auth::guard('admin')->user()->type;
            $admin_id = Auth::guard('admin')->user()->id;
            $vendor_id = Auth::guard('admin')->user()->vendor_id;
            ($admin_type == 'vendor') ?  : $vendor_id = 0;
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
//                "prodcut_image" => ,
//                "prodcut_video" => ,
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
    //After choice the section we get it's Categories
    public function GetSectionProduct(Request $request){
        if($request->ajax())
        {
            $data = $request->all();
            $categ = Product::with('Section')->where(['section_id' => $data['section_id'], 'parent_id' => 0])->pluck('id','category_name');
            return response()->json($categ);
        }
    }
    //After choice the category we get it's sub Categories
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


}
