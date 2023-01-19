@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    @if(Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error : </strong> {{Session::get('error_message')}}
                        </div>
                    @endif
                    @if(Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{Session::get('success_message')}} </strong>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold mb-3">Settings</h3>
                            <h6 class="font-weight-normal mb-0">Update Vendor Details</h6>
                        </div>
                    </div>
                </div>
            </div>
            @if($slug == 'personal')
                <div class="row">
                    <div class="col-12  grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Vendor Personal Information</h4>
                                <form class="forms-sample" action="{{url('admin/update-vendor-details/personal')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Vendor Username/Email</label>
                                        <input type="text" class="form-control" value="{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->email}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_name">Name</label>
                                        <input type="text" class="form-control" id="vendor_name" name="vendor_name" value="{{$VendorDetails['name']}}"
                                               required placeholder="Enter Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="vendor_address">Address</label>
                                        <input type="text" class="form-control" id="vendor_address" name="vendor_address" value="{{$VendorDetails['address']}}"
                                               required placeholder="Enter Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_city">City</label>
                                        <input type="text" class="form-control" id="vendor_city" name="vendor_city" value="{{$VendorDetails['city']}}"
                                               required placeholder="Enter City">
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_state">State</label>
                                        <input type="text" class="form-control" id="vendor_state" name="vendor_state" value="{{$VendorDetails['state']}}"
                                               required placeholder="Enter State">
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_country">Country</label>
                                        <select class="form-control" id="country" name="country">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->country_name}}"
                                                        @if($country->country_name === $VendorDetails['country'])
                                                            selected
                                                    @endif>
                                                    {{$country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_pincode">PinCode</label>
                                        <input type="text" class="form-control" id="vendor_pincode" name="vendor_pincode" value="{{$VendorDetails['pincode']}}"
                                               required placeholder="Enter PinCode">
                                    </div>

                                    <div class="form-group">
                                        <label for="vendor_mobile">Mobile</label>
                                        <input type="text" class="form-control" id="vendor_mobile" name="vendor_mobile" value="{{$VendorDetails['mobile']}}"
                                               placeholder="Enter New Password" required maxlength="11" minlength="11">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Vendor Image</label>
                                        <input type="file" class="form-control form-control-lg" id="vendor_image" name="vendor_image">
                                        @if(!empty(\Illuminate\Support\Facades\Auth::guard('admin')->user()->image))
                                            <a target="_blank" href="{{url('admin/images/photos/'.\Illuminate\Support\Facades\Auth::guard('admin')->user()->image)}}">
                                                View Image
                                            </a>
                                        @endif
                                        <input type="hidden" name="current_vendor_image" value="{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->image}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($slug == 'business')
                <div class="row">
                    <div class="col-12  grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Vendor Business Information</h4>
                                <form class="forms-sample" action="{{url('admin/update-vendor-details/business')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Vendor Username/Email</label>
                                        <input type="text" class="form-control" value="{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->email}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_name">Shop Name</label>
                                        <input type="text" class="form-control" id="shop_name" name="shop_name" value="{{$VendorDetails['shop_name']}}"
                                               required placeholder="Enter Shop Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="shop_address">Shop Address</label>
                                        <input type="text" class="form-control" id="shop_address" name="shop_address" value="{{$VendorDetails['shop_address']}}"
                                               required placeholder="Enter Shop Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_city">Shop City</label>
                                        <input type="text" class="form-control" id="shop_city" name="shop_city" value="{{$VendorDetails['shop_city']}}"
                                               required placeholder="Enter Shop City">
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_state">Shop State</label>
                                        <input type="text" class="form-control" id="shop_state" name="shop_state" value="{{$VendorDetails['shop_state']}}"
                                               required placeholder="Enter Shop State">
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_country">Shop Country</label>
                                        <select class="form-control" id="country" name="country">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->country_name}}"
                                                @if($country->country_name === $VendorDetails['shop_country'])
                                                    selected
                                                @endif>
                                                    {{$country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="shop_pincode">Shop PinCode</label>
                                        <input type="text" class="form-control" id="shop_pincode" name="shop_pincode" value="{{$VendorDetails['shop_pincode']}}"
                                               required placeholder="Enter Shop PinCode">
                                    </div>

                                    <div class="form-group">
                                        <label for="shop_mobile">Shop Mobile</label>
                                        <input type="text" class="form-control" id="shop_mobile" name="shop_mobile" value="{{$VendorDetails['shop_mobile']}}"
                                               placeholder="Enter Shop Mobile">
                                    </div>

                                    <div class="form-group">
                                        <label for="shop_email">Shop Email</label>
                                        <input type="text" class="form-control" id="shop_email" name="shop_email" value="{{$VendorDetails['shop_email']}}"
                                               placeholder="Enter Shop Email">
                                    </div>

                                    <div class="form-group">
                                        <label for="shop_website">Shop Website</label>
                                        <input type="text" class="form-control" id="shop_website" name="shop_website" value="{{$VendorDetails['shop_website']}}"
                                               placeholder="Enter Shop Mobile">
                                    </div>

                                    <div class="form-group">
                                        <label for="business_license_number">Business License Number</label>
                                        <input type="text" class="form-control" id="business_license_number" name="business_license_number" value="{{$VendorDetails['business_license_number']}}"
                                               placeholder="Enter Business License Number">
                                    </div>

                                    <div class="form-group">
                                        <label for="shop_address_proof">Address Proof</label>
                                        <select class="form-control" id="shop_address_proof" name="shop_address_proof">
                                               <option value="Passport">Passport</option>
                                               <option value="National Id">National Id</option>
                                               <option value="Voting Card">Voting Card</option>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label class="form-label">Address Proof Image</label>
                                        <input type="file" class="form-control form-control-lg" id="address_prof_image" name="address_prof_image">
                                        @if(!empty($VendorDetails['address_prof_image']))
                                                <a target="_blank" href="{{url('admin/images/proofs/'.$VendorDetails['address_prof_image'])}}">
                                                View Image
                                            </a>
                                        @endif
                                        <input type="hidden" name="current_address_prof_image" value="{{$VendorDetails['address_prof_image']}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($slug == 'bank')
                <div class="row">
                    <div class="col-12  grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Vendor Bank Information</h4>
                                <form class="forms-sample" action="{{url('admin/update-vendor-details/bank')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Vendor Username/Email</label>
                                        <input type="text" class="form-control" value="{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->email}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="account_holder_name">Account Holder Name</label>
                                        <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" value="{{$VendorDetails['account_holder_name']}}"
                                               required placeholder="Enter Account Holder Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="account_number">Account Number</label>
                                        <input type="text" class="form-control" id="account_number" name="account_number" value="{{$VendorDetails['account_number']}}"
                                               required placeholder="Enter Account Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_name">Bank Name</label>
                                        <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{$VendorDetails['bank_name']}}"
                                               required placeholder="Enter Bank Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_ifsc_code">Bank Ifsc Code</label>
                                        <input type="text" class="form-control" id="bank_ifsc_code" name="bank_ifsc_code" value="{{$VendorDetails['bank_ifsc_code']}}"
                                               required placeholder="Enter Bank Ifsc Code">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admin.layout.footer')
        <!-- partial -->
    </div>

@endsection
