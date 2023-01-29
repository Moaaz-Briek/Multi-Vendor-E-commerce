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
            $imageName = $this->addBannerImageFunction($request);
            //Insert Data into database
            $data = $request->all();
            Banner::insert([
                'title' => $data['title'],
                'type' => $data['type'],
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
            //Upload Banner Image
            $imageName = $this->addBannerImageFunction($request);
            //Insert Data into database
            $data = $request->all();
            Banner::where('id', $data['id'])->update([
                'title' => $data['title'],
                'type' => $data['type'],
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
        //Get banner image
        $image_file = Banner::select('image')->where('id',$id)->first();
        //The Path for the image
        $image_path = 'front/images/banner_images/';
        //Delete from domain files
        if(file_exists($image_path.$image_file->image) && $image_file->image!= null){
            unlink($image_path.$image_file->image);
        }
        //Delete from database
        Banner::where('id',$id)->update([
            'image' => '',
        ]);
        $message = 'Banner Image has been deleted successfully!';
        return redirect()->back()->with('success_message',$message);
    }

    public function addBannerImageFunction(Request $request)
    {
        $type = $request->type;
        switch ($type){
            case 'slider':
                $width = '1920';
                $height = '720';
                break;
            case 'fix':
                $width = '1920';
                $height = '450';
                break;
        }
        //Add New Banner Request
        if ($request->hasFile('image')) {
            $image_tmp = $request->file('image');
            if ($image_tmp->isValid()) {
                //Get Image Extension
                $extension = $image_tmp->getClientOriginalExtension();
                //Generate New Image Name
                $imageName = rand(111, 9999) . '.' . $extension;
                $imagePath = 'front/images/banner_images/' . $imageName;
                //Upload The Image
                Image::make($image_tmp)->resize($width, $height)->save($imagePath);
            }
        //Edit Banner Request
        }else if(!empty($request->current_image)){
            //Read the existing file
            $image_name = 'front/images/banner_images/' . $request->current_image;
            //Load the Image File, in-case it's a jpeg image
            $image = imagecreatefromjpeg($image_name);
            //Scale the image
            $imgResized = imagescale($image , $width, $height);
            //Save the Resized image to the directory.
            imagejpeg($imgResized, $image_name);
            //Assign it to imageName variable
            $imageName = $request->current_image;
        }
        else {
            $imageName = '';
        }
            return $imageName;
    }
}
