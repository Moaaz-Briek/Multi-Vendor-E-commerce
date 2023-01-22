<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SectionController extends Controller
{
    //Display All sections
    public function sections(){
        Session::put('page','sections');
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
            Section::where('id', $data['module_id'])->update(['status' => $status,]);
            return response()->json(['status'=>$status, 'module_id'=>$data['module_id']]);
        }
    }

    //Delete Section
    public function DeleteSection($id){
        Section::where('id',$id)->delete();
        $message = 'Section has been deleted successfully!';
        return redirect()->back()->with('success_message',$message);
    }

    //Add section
    public function AddSection(Request $request){
        if($request->isMethod('post')){
            $rules = [
                'section_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];

            $customMessages = [
                'section_name.required' => 'Section Name is Required',
                'section_name.regex' => 'Valid Section Name is Required',
            ];
            $this->validate($request, $rules, $customMessages);

            $data = $request->all();
            Section::insert([
                'name' => $data['section_name'],
                'status' => $data['status'],
            ]);
            return redirect()->back()->with('success_message', 'Section has been Added Succeessfully!');
        }
        return view('admin.sections.add_section');
    }

    //Edit section
    public function EditSection(Request $request,$id=null){
        if($request->isMethod('post')){
            $rules = [
                'section_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];

            $customMessages = [
                'section_name.required' => 'Section Name is Required',
                'section_name.regex' => 'Valid Section Name is Required',
            ];
            $this->validate($request, $rules, $customMessages);
            $data = $request->all();
            Section::where('id', $data['section_id'])->update([
                'name' => $data['section_name'],
            ]);
            return redirect('admin/sections')->with('success_message', 'Section has been Updated Succeessfully!');
        }
        else{
        $section = Section::where('id', $id)->get()->first()->toArray();
        return view('admin.sections.edit_section')->with(compact('section'));
        }
    }

}
