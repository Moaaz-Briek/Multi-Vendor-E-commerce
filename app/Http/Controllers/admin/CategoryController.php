<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
    //Display All categories
    public function categories(){
        Session::put('page','categories');
        $categories = Category::with(['Section', 'ParentCategory'])->get()->toArray();
        return view('admin.categories.categories')->with(compact('categories'));
    }

    //Update Category status
    public function UpdateCategoryStatus(Request $request){
        if($request->ajax())
        {
            $data = $request->all();
            if($data['status'] == 'Inactive'){
                $status = 1;
            }
            else{
                $status = 0;
            }
//            echo "<pre>"; print_r($data); die;
            Category::where('id', $data['category_id'])->update(['status' => $status,]);
            return response()->json(['status'=>$status, 'category_id'=>$data['category_id']]);
        }
    }

    //Add Category
    public function AddCategory(Request $request){
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
    public function GetSectionCategory(Request $request){
        if($request->ajax())
        {
            $data = $request->all();
            $categ = Category::with('Section')->where('section_id', $data['section_id']);
            $categ = $categ->where( 'parent_id', 0)->pluck('id','category_name');
            return response()->json($categ);
        }
    }
}
