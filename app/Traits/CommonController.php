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
}
