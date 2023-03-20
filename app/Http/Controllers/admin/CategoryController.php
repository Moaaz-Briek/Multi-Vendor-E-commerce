<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use App\Traits\CommonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
    use CommonController;
    //Display All categories
    public function categories(){
        Session::put('page','categories');
        $categories = Category::with(['Section', 'ParentCategory'])->get()->toArray();
        return view('admin.categories.categories')->with(compact('categories'));
    }

    //Update Category status
    public function UpdateCategoryStatus(Request $request, Category $category){
        $arr = $this->UpdateStatus($request, $category);
        return response()->json($arr);
    }

    //Add Category
    public function AddCategory(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
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
                'category_name' => '',
            ];

            $customMessages = [
                'section_name.required' => 'Section Name is Required',
                'section_name.regex' => 'Valid Section Name is Required',
            ];
            $this->validate($request, $rules, $customMessages);
            //Insert Data into database
            $data = $request->all();
            Category::insert([
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
            return redirect('admin/categories')->with('success_message', 'Category has been Added Succeessfully!');
        }else {
            $sections = Section::get()->toArray();
            $categories = Category::with('SubCategory')->where('parent_id', 0)->get()->toArray();
            return view('admin.categories.add_category')->with(compact('sections', 'categories'));

        }
    }
    //Get Section Categories
    public function GetSectionCategory(Request $request){
        if($request->ajax())
        {
            $data = $request->all();
            $categ = Category::with('Section')->where(['section_id' => $data['section_id'], 'parent_id' => 0])->pluck('id','category_name');
            return response()->json($categ);
        }
    }

    //Edit Category Information
    public function EditCategory(Request $request,$id=null){
            if($request->isMethod('post')) {
                $data = $request->all();
//                dd($data);
                //Upload Admin Image
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
                else if(!empty($data['current_category_image'])){
                    $imageName = $data['current_category_image'];
                    $request['category_image'] = $imageName;
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
                'category_name.required' => 'Category Name is Required',
                'category_name.regex' => 'Valid Category Name is Required',
                'meta_description.required' => 'Meta Description Name is Required',
                'meta_description.regex' => 'Valid Meta Description Name is Required',
                'meta_keywords.required' => 'Meta Keyword Name is Required',
                'meta_keywords.regex' => 'Valid Meta Keyword Name is Required',
                'description.required' => 'Description Name is Required',
                'description.regex' => 'Valid Description Name is Required',
                'section_id.required' => 'Section Name is Required',
                'parent_id.required' => 'Parent Category Name is Required',
                'category_discount.required' => 'Category Discount is Required',
                'url.required' => 'Url Name is Required',
                'status.required' => 'Status is Required',
                'category_image.required' => 'Category Image is Required',
            ];
            $this->validate($request, $rules, $customMessages);

            Category::where('id', $data['id'])->update([
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
            return redirect('admin/categories')->with('success_message', 'Category has been Updated Succeessfully!');
        }
        else{
            $sections = Section::get()->toArray();
            $category = Category::with('Section', 'ParentCategory')->where('id', $id)->get()->first()->toArray();
//            dd($category);
            return view('admin.categories.edit_category')->with(compact('category', 'sections'));
        }
    }

    //Delete Category
    public function DeleteCategory($id){
        Category::where('id',$id)->delete();
        $message = 'Category has been deleted successfully!';
        return redirect()->back()->with('success_message',$message);
    }

    public function DeleteCategoryImage($id){
        $category_image = Category::select('category_image')->where('id',$id)->first();
        $category_image_path = 'front/images/category_images/';
        //Delete from domain files
        if(file_exists($category_image_path.$category_image->category_image)){
            unlink($category_image_path.$category_image->category_image);
        }
        //Delete from database
        Category::where('id',$id)->update([
            'category_image' => '',
        ]);
        $message = 'Category Image has been deleted successfully!';
        return redirect()->back()->with('success_message',$message);
    }


}
