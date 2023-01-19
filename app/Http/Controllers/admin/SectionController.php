<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    //Display All sections
    public function sections(){
        $sections = Section::get()->toArray();
//        dd($section);
        return view('admin.sections.sections')->with(compact('sections'));
    }

    //Update Section status
    public function UpdateSectionStatus(Request $request){
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
            Section::where('id', $data['section_id'])->update(['status' => $status,]);
            return response()->json(['status'=>$status, 'section_id'=>$data['section_id']]);
        }
    }

    //Delete Section
    public function DeleteSection($id){
        Section::where('id',$id)->delete();
        $message = 'Section has been deleted successfully!';
        return redirect()->back()->with('success_message',$message);
    }

}
