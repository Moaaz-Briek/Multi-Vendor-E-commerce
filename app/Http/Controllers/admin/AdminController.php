<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Vendor;
use App\Models\VendorsBankDetail;
use App\Models\VendorsBusinessDetail;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Testing\Fluent\Concerns\Has;
use Intervention\Image\Facades\Image;
class AdminController extends Controller
{
    public function dashboard()
    {
        Session::put('page','dashboard');
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if($request->isMethod('post')){
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessages = [
              'email.required' => 'Email is Required',
              'email.email' => 'Valid Email is Required',
              'password.required' => 'Password is Required',
            ];

            $this->validate($request, $rules, $customMessages);

            $data = $request->all();

            if(Auth::guard('admin')->attempt( ['email' => $data['email'], 'password' => $data['password'], 'status' => 1] )){
                return redirect('/admin/dashboard');
            }
            else{
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
        }
        return view('admin.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    //Update Admin Password
    public function updateAdminPassword(Request $request){
        Session::put('page','updateAdminPassword');
        if($request->isMethod('post')){
            $data =$request->all();
            //Check if current password entered is correct or not
            if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
                //Check if new password is matching with confirm password
                if($data['new_password'] === $data['confirm_password']){
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message', 'Password has been updated successfully!!');
                }
                else{
                    return redirect()->back()->with('error_message', 'New Password and Confirm Password does not match!');
                }
            }
            else{
                return redirect()->back()->with('error_message', 'Your Current Password is Incorrect!');
            }
        }
        else{
            $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
            return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
        }
}

    //We use this function with the custom.js file to check old password before write a new one.
    public function CheckAdminPassword(Request $request){
        $data =$request->all();

        if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
            return "true";
        }
        else{
            return "false";
        }
    }

    //Update Admin Details : Name, Mobile.
    public function updateAdminDetails(Request $request)
    {
        Session::put('page','updateAdminDetails');
        if($request->isMethod('post')){
            //Upload Admin Image
            if($request->hasFile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate New Image Name
                    $imageName = rand(111,9999).'.'.$extension;
                    $imagePath = 'admin/images/photos/'.$imageName;
                    //Upload The Image
                    Image::make($image_tmp)->save($imagePath);
                }
            }
            else if(!empty($data['current_admin_image'])){
                $imageName = $data['current_admin_image'];
            }
            else{
                $imageName = '';
            }

            $data = $request->all();
            //Validate input data
            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric'
            ];
            $custom_message = [
                'admin_name.required' => 'Name is Required',
                'mobile_name.regex' => 'Valid Name is Required',
                'mobile_name.required' => 'Mobile is Required',
                'mobile_name.numeric' => 'Vaild Mobile is Required',
            ];
            $this->validate($request,$rules,$custom_message);

            //Update the Admin record with new data
            Admin::where('id', Auth::guard('admin')->user()->id)->update([
                'name' => $data['admin_name'],
                'mobile' => $data['admin_mobile'],
                'image' => $imageName,
            ]);

            return redirect()->back()->with('success_message', 'Details has been updated successfully!!');
        }
        else{
            $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
            return view('admin.settings.update_admin_details')->with(compact('adminDetails'));
        }
    }

    //Update Vendor Details
    public function updateVendorDetails($slug, Request $request){
        $countries = Country::where('status', 1)->get();
        if ($slug == 'personal') {
            Session::put('page','personal');
            if ($request->isMethod('post')) {
                $data = $request->all();
                //Upload Vendor Image
                if ($request->hasFile('vendor_image')) {
                    $image_tmp = $request->file('vendor_image');
                    if ($image_tmp->isValid()) {
                        //Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate New Image Name
                        $imageName = rand(111, 9999) . '.' . $extension;
                        $imagePath = 'admin/images/photos/' . $imageName;
                        //Upload The Image
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if (!empty($data['vendor_image'])) {
                    $imageName = $data['current_vendor_image'];
                } else {
                    $imageName = '';
                }
                //Validate personal data
                $rules = [
                    'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_address' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_state' => 'required|regex:/^[\pL\s\-]+$/u',
                    'country' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_pincode' => 'required|numeric',
                    'vendor_mobile' => 'required|numeric',
                ];
                $custom_message = [
                    'vendor_name.required' => 'Name is Required',
                    'vendor_name.regex' => 'Valid Name is Required, Only Characters',
                    'vendor_address.required' => 'Address is Required',
                    'vendor_address.regex' => 'Valid Address is Required, Only Characters',
                    'vendor_city.required' => 'City is Required',
                    'vendor_city.regex' => 'Valid City is Required, Only Characters',
                    'vendor_state.required' => 'State is Required',
                    'vendor_state.regex' => 'Valid State is Required, Only Characters',
                    'country.required' => 'Country is Required',
                    'country.regex' => 'Valid Country is Required, Only Characters',
                    'mobile_name.required' => 'Mobile is Required',
                    'mobile_name.numeric' => 'Vaild Mobile is Required, Only Numbers',
                    'vendor_pincode.required' => 'PinCode is Required',
                    'vendor_pincode.numeric' => 'Vaild PinCode is Required, Only Numbers',
                ];
                $this->validate($request, $rules, $custom_message);
                //Update the Admin record with personal data
                Admin::where('id', Auth::guard('admin')->user()->id)->update([
                    'name' => $data['vendor_name'],
                    'mobile' => $data['vendor_mobile'],
                    'image' => $imageName,
                ]);
                //Update the Vendor record with personal data
                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update([
                    'name' => $data['vendor_name'],
                    'mobile' => $data['vendor_mobile'],
                    'address' => $data['vendor_address'],
                    'city' => $data['vendor_city'],
                    'state' => $data['vendor_state'],
                    'country' => $data['country'],
                    'pincode' => $data['vendor_pincode'],
                ]);
                return redirect()->back()->with('success_message', 'Details has been updated successfully!!');
            }
            else
            {
                //If Get Request
                $VendorDetails = Vendor::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
                return view('admin.settings.update_vendor_details')->with(compact('slug', 'VendorDetails', 'countries'));
            }
        }
        elseif($slug == 'business') {
            Session::put('page','business');
             if($request->isMethod('post')){
                 $data = $request->all();
                 //Upload address_prof_image
                 if ($request->hasFile('address_prof_image')) {
                     $image_tmp = $request->file('address_prof_image');
                     if ($image_tmp->isValid()) {
                         //Get Image Extension
                         $extension = $image_tmp->getClientOriginalExtension();
                         //Generate New Image Name
                         $imageName = rand(111, 9999) . '.' . $extension;
                         $imagePath = 'admin/images/proofs/' . $imageName;
                         //Upload The Image
                         Image::make($image_tmp)->save($imagePath);
                     }
                 } else if (!empty($data['address_prof_image'])) {
                     $imageName = $data['current_address_prof_image'];
                 } else {
                     $imageName = '';
                 }
                 //Validate personal data
                 $Business_rules = [
                     'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                     'shop_address' => 'required|regex:/^[\pL\s\-]+$/u',
                     'shop_city' => 'required|regex:/^[\pL\s\-]+$/u',
                     'shop_state' => 'required|regex:/^[\pL\s\-]+$/u',
                     'country' => 'required|regex:/^[\pL\s\-]+$/u',
                     'shop_pincode' => 'required|numeric',
                     'shop_mobile' => 'required|numeric',
                     'shop_email' => 'required|email',
                     'shop_website' => 'required',
                     'shop_address_proof' => 'required',
                     'business_license_number' => 'required',

                 ];
                 $Business_custom_message = [
                     'shop_name.required' => 'Name is Required',
                     'shop_name.regex' => 'Valid Name is Required, Only Characters',
                     'shop_address.required' => 'Address is Required',
                     'shop_address.regex' => 'Valid Address is Required, Only Characters',
                     'shop_city.required' => 'City is Required',
                     'shop_city.regex' => 'Valid City is Required, Only Characters',
                     'shop_state.required' => 'State is Required',
                     'shop_state.regex' => 'Valid State is Required, Only Characters',
                     'country.required' => 'Country is Required',
                     'country.regex' => 'Valid Country is Required, Only Characters',
                     'mobile_name.required' => 'Mobile is Required',
                     'mobile_name.numeric' => 'Vaild Mobile is Required, Only Numbers',
                     'shop_pincode.required' => 'PinCode is Required',
                     'shop_pincode.numeric' => 'Vaild PinCode is Required, Only Numbers',
                     'shop_email.required' => 'Email is Required',
                     'shop_email.email' => 'Valid Email is Required',
                     'shop_website.required' => 'Website is Required',
                     'shop_address_proof.required' => 'Proof is Required',
                     'business_license_number.required' => 'Business License Number is Required',
                 ];
                 $this->validate($request, $Business_rules, $Business_custom_message);
                 //Update the Vendor Shop/Business Details record with new data
                 VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update([
                     'shop_name' => $data['shop_name'],
                     'shop_mobile' => $data['shop_mobile'],
                     'shop_address' => $data['shop_address'],
                     'shop_city' => $data['shop_city'],
                     'shop_state' => $data['shop_state'],
                     'shop_country' => $data['country'],
                     'shop_pincode' => $data['shop_pincode'],
                     'shop_email' => $data['shop_email'],
                     'shop_website' => $data['shop_website'],
                     'address_prof' => $data['shop_address_proof'],
                     'business_license_number' => $data['business_license_number'],
                     'address_prof_image' => $imageName,
                 ]);
                 return redirect()->back()->with('success_message', 'Details has been updated successfully!!');
             }
             else {
                 $VendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
                 return view('admin.settings.update_vendor_details')->with(compact('slug', 'VendorDetails', 'countries'));
             }
         }
        elseif($slug == 'bank')
        {
            Session::put('page','bank');
            if($request->isMethod('post')) {
                $data = $request->all();
                //Validate personal data
                $rules = [
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'account_number' => 'required|numeric',
                    'bank_name' => 'required',
                    'bank_ifsc_code' => 'required',
                ];
                $custom_message = [
                    'account_holder_name.required' => 'Account Holder Name is Required',
                    'account_holder_name.regex' => 'Valid Account Holder Name is Required, Only Characters',
                    'account_number.required' => 'Account Number is Required',
                    'account_number.numeric' => 'Valid Account Number is Required, Only Numbers',
                    'bank_name.required' => 'Bank Name is Required',
                    'bank_ifsc_code.required' => 'Bank Ifsc Code is Required',
                ];
                $this->validate($request, $rules, $custom_message);
                //Update the Vendor Bank Details record with new data
                VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update([
                    'account_holder_name' => $data['account_holder_name'],
                    'account_number' => $data['account_number'],
                    'bank_name' => $data['bank_name'],
                    'bank_ifsc_code' => $data['bank_ifsc_code'],
                ]);
                return redirect()->back()->with('success_message', 'Details has been updated successfully!!');
            }
            else{
                $VendorDetails = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
                return view('admin.settings.update_vendor_details')->with(compact('slug', 'VendorDetails'));
            }
        }
    }

    //View All Admins / Sub-Admins / Vendors, Only admins can see this function
    //It's in sidebar.blade.php
    public function admins($type=null){
        $admins = Admin::query();
        if(!empty($type)) {
            $admins = $admins->where('type', $type);
            $title = ucfirst($type) . 's';
            Session::put('page','view_'.strtolower($title));
        }else{
            $title = 'All Admins / Sub-Admins / Vendors';
            Session::put('page','view_all');
        }
        $admins = $admins->get()->toArray();
        return view('admin.admins.admins')->with(compact('admins', 'title'));
    }

    public function ViewVendorDetails($id)
    {
        $vendorDetails = Admin::with('vendorPersonal','vendorBusiness','vendorBank')->where('id', $id)->first();
        $VendorDetails = json_decode(json_encode($vendorDetails), true);
        return view('admin.admins.view_vendor_details')->with(compact('VendorDetails'));
    }

    //We use this function with the custom.js file to Update admin status
    public function UpdateAdminStatus(Request $request){
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
            Admin::where('id', $data['admin_id'])->update(['status' => $status,]);
            return response()->json(['status'=>$status, 'admin-id'=>$data['admin_id']]);
        }
    }
}
