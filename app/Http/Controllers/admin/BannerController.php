<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Traits\CommonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;


class BannerController extends Controller
{
    use CommonController;
    public function banners(){
        Session::put('page', 'banners');
        $banners = Banner::get()->toArray();
        return view('admin.banners.banners')->with(compact('banners'));
    }

    public function UpdateBannerStatus(Request $request, Banner $banner)
    {
        Session::put('page','banners');
        $arr = $this->UpdateStatus($request, $banner);
        return response()->json($arr);
    }

    public function DeleteBanner($id)
    {
        //Get Banner
        $banner = Banner::find($id)->first();
//        dd($banner->image);
        //Delete from Host
        $banner_path = 'front/images/banner_images/';
        if(file_exists($banner_path.$banner->image) && $banner->image != null ){
            unlink($banner_path.$banner->image);
        }
        //Delete from Database
        $banner->delete();
        return redirect()->back()->with('success_message', 'Banner has been deleted successfully!');

    }

    public function AddBanner(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //Upload Vendor Image
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate New Image Name
                    $imageName = rand(111, 9999) . '.' . $extension;
                    $imagePath = 'front/images/banner_images/' . $imageName;
                    //Upload The Image
                    Image::make($image_tmp)->save($imagePath);
                }
            }
            else {
                $imageName = '';
            }
            //Insert Data into database
            $data = $request->all();
            Banner::insert([
                'title' => $data['title'],
                'alt' => $data['alt'],
                'link' => $data['link'],
                'status' => $data['status'],
                'image' => $imageName,
            ]);
            return redirect('admin/banners')->with('success_message', 'Banner has been Added Succeessfully!');
        }else {
            return view('admin.banners.add_banner');
        }
    }
    public function editBanner(Request $request, $id=null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
//            dd($data);
            //Upload Vendor Image
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate New Image Name
                    $imageName = rand(111, 9999) . '.' . $extension;
                    $imagePath = 'front/images/banner_images/' . $imageName;
                    //Upload The Image
                    Image::make($image_tmp)->save($imagePath);
                }
            }
            else {
                $imageName = '';
            }
            //Insert Data into database
            $data = $request->all();
            Banner::where('id', $data['id'])->update([
                'title' => $data['title'],
                'alt' => $data['alt'],
                'link' => $data['link'],
                'status' => $data['status'],
                'image' => $imageName,
            ]);
            return redirect('admin/banners')->with('success_message', 'Banner has been Added Successfully!');
        }else {
            $banner = Banner::where('id', $id)->get()->first()->toArray();
            return view('admin.banners.edit_banner')->with(compact('banner'));
        }
    }
    public function DeleteBannerImage($id){
        Session::put('page','banners');
        //Get Video name from product table
        $image_file = Banner::select('image')->where('id',$id)->first();
        //The Path for the video
        $image_path = 'front/images/banner_images/';
        //Delete from domain files
        if(file_exists($image_path.$image_file->image)){
            unlink($image_path.$image_file->image);
        }
        //Delete from database
        Banner::where('id',$id)->update([
            'image' => '',
        ]);
        $message = 'Banner Image has been deleted successfully!';
        return redirect()->back()->with('success_message',$message);
    }
}
