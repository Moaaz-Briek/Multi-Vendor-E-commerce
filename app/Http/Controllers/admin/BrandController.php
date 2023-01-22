<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Traits\CommonController;
class BrandController extends Controller
{
    use CommonController;
    //Display All brands
    public function brands(){
        Session::put('page','brands');
        $brands = Brand::get()->toArray();
//        dd($brands);
        return view('admin.brands.brands')->with(compact('brands'));
    }

    //Update Brand status
    public function UpdateBrandStatus(Request $request, Brand $brand){
        $arr = $this->UpdateStatus($request, $brand);
        return response()->json($arr);
    }

    //Delete Brand
    public function DeleteBrand($id){
        Brand::where('id',$id)->delete();
        $message = 'Brand has been deleted successfully!';
        return redirect()->back()->with('success_message',$message);
    }

    //Add brand
    public function AddBrand(Request $request){
        Session::put('page','brands');
        if($request->isMethod('post')){
            $rules = [
                'brand_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];

            $customMessages = [
                'brand_name.required' => 'Brand Name is Required',
                'brand_name.regex' => 'Valid Brand Name is Required',
            ];
            $this->validate($request, $rules, $customMessages);

            $data = $request->all();
            Brand::insert([
                'name' => $data['brand_name'],
                'status' => $data['status'],
            ]);
            return redirect()->back()->with('success_message', 'Brand has been Added Succeessfully!');
        }
        return view('admin.brands.add_brand');
    }

    //Edit brand
    public function EditBrand(Request $request,$id=null){
        Session::put('page','brands');
        if($request->isMethod('post')){
            $rules = [
                'brand_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];

            $customMessages = [
                'brand_name.required' => 'Brand Name is Required',
                'brand_name.regex' => 'Valid Brand Name is Required',
            ];
            $this->validate($request, $rules, $customMessages);
            $data = $request->all();
            Brand::where('id', $data['brand_id'])->update([
                'name' => $data['brand_name'],
            ]);
            return redirect('admin/brands')->with('success_message', 'Brand has been Updated Succeessfully!');
        }
        else{
            $brand = Brand::where('id', $id)->get()->first()->toArray();
            return view('admin.brands.edit_brand')->with(compact('brand'));
        }
    }

}
