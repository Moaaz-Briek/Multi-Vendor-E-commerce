<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

Trait CommonController
{
    public function UpdateStatus($request, $model){
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
            $model::where('id', $data['module_id'])->update(['status' => $status]);
            return ['status'=>$status, 'module_id'=>$data['module_id']];
        }
    }

    //$model_image_video_name == product_image or product_video or category_image ...
    public function DeleteProductVideo($id, $model_image_video_name, Model $model){
//        Session::put('page','products');
        //Get Video name from product table
        $file = $model::select($model_image_video_name)->where('id',$id)->first();
        //The Path for the video

        $file_path = 'front/videos/product_videos/';
        $file_path = 'front/images/product_videos/';
        $file_path = 'front/videos/product_videos/';
        //Delete from domain files
        if(file_exists($file_path.$file->$model_image_video_name)){
            unlink($file_path.$file->$model_image_video_name);
        }
        //Delete from database
        $model::where('id',$id)->update([
            $model_image_video_name => '',
        ]);
        $message = 'Product Video has been deleted successfully!';
        return redirect()->back()->with('success_message',$message);
    }

}
