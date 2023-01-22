<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image;
use App\Http\Controllers\Section;
use App\Models\Product;
use App\Traits\CommonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    use CommonController;
    //Display All categories
    public function products(){
        Session::put('page','products');
        $products = Product::get()->toArray();
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
            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate New Image Name
                    $imageName = rand(111, 9999) . '.' . $extension;
                    $imagePath = 'front/images/category_images/' . $imageName;
                    //Upload The Image
                    Image::make($image_tmp)->save($imagePath);
                }
            }
            else {
                $imageName = '';
            }
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];

            $customMessages = [
                'section_name.required' => 'Section Name is Required',
                'section_name.regex' => 'Valid Section Name is Required',
            ];
            $this->validate($request, $rules, $customMessages);
            //Insert Data into database
            $data = $request->all();
            Product::insert([
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
            return redirect('admin/categories')->with('success_message', 'Product has been Added Succeessfully!');
        }else {
            $sections = Section::get()->toArray();
            $categories = Product::with('SubProduct')->where('parent_id', 0)->get()->toArray();
            return view('admin.categories.add_category')->with(compact('sections', 'categories'));

        }
    }
    //Get Section Categories
    public function GetSectionProduct(Request $request){
        if($request->ajax())
        {
            $data = $request->all();
            $categ = Product::with('Section')->where(['section_id' => $data['section_id'], 'parent_id' => 0])->pluck('id','category_name');
            return response()->json($categ);
        }
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

    //Delete Product
    public function DeleteProduct($id){
        Product::where('id',$id)->delete();
        $message = 'Product has been deleted successfully!';
        return redirect()->back()->with('success_message',$message);
    }
    public function DeleteProductImage($id){
        $category_image = Product::select('category_image')->where('id',$id)->first();
        $category_image_path = 'front/images/category_images/';
        //Delete from domain files
        if(file_exists($category_image_path.$category_image->category_image)){
            unlink($category_image_path.$category_image->category_image);
        }
        //Delete from database
        Product::where('id',$id)->update([
            'category_image' => '',
        ]);
        $message = 'Product Image has been deleted successfully!';
        return redirect()->back()->with('success_message',$message);
    }


}
