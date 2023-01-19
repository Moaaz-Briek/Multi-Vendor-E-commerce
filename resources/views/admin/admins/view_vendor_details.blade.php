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
                            <h3 class="font-weight-bold mb-3">Vendor Details</h3>
                            <h6 class="font-weight-normal mb-0"><a href="{{url('admin/admins/vendor')}}">Back to Vendors</a></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-12  grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Vendor Personal Information</h4>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" value="{{$VendorDetails['vendor_personal']['email']}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_name">Name</label>
                                        <input type="text" class="form-control" id="vendor_name" name="vendor_name" value="{{$VendorDetails['vendor_personal']['name']}}"
                                               readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="vendor_address">Address</label>
                                        <input type="text" class="form-control" id="vendor_address" name="vendor_address" value="{{$VendorDetails['vendor_personal']['address']}}"
                                               readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_city">City</label>
                                        <input type="text" class="form-control" id="vendor_city" name="vendor_city" value="{{$VendorDetails['vendor_personal']['city']}}"
                                               readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_state">State</label>
                                        <input type="text" class="form-control" id="vendor_state" name="vendor_state" value="{{$VendorDetails['vendor_personal']['state']}}"
                                               readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_country">Country</label>
                                        <input type="text" class="form-control" id="vendor_country" name="vendor_country" value="{{$VendorDetails['vendor_personal']['country']}}"
                                               readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_pincode">PinCode</label>
                                        <input type="text" class="form-control" id="vendor_pincode" name="vendor_pincode" value="{{$VendorDetails['vendor_personal']['pincode']}}"
                                               readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="vendor_mobile">Mobile</label>
                                        <input type="text" class="form-control" id="vendor_mobile" name="vendor_mobile" value="{{$VendorDetails['vendor_personal']['mobile']}}"
                                               readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Vendor Image</label>
                                        <br>
                                    @if(!empty($VendorDetails['image']))
                                        <img style="width: 300px;height: 300px" src="{{url('admin/images/photos/'.$VendorDetails['image'])}}">
                                    @endif
                                    </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Vendor Business Information</h4>
                                <div class="form-group">
                                    <label for="shop_name">Shop Name</label>
                                    <input type="text" class="form-control" id="shop_name" name="shop_name" value="{{$VendorDetails['vendor_business']['shop_name']}}"
                                           readonly>
                                </div>

                                <div class="form-group">
                                    <label for="shop_address">Shop Address</label>
                                    <input type="text" class="form-control" id="shop_address" name="shop_address" value="{{$VendorDetails['vendor_business']['shop_address']}}"
                                           readonly>
                                </div>
                                <div class="form-group">
                                    <label for="shop_city">Shop City</label>
                                    <input type="text" class="form-control" id="shop_city" name="shop_city" value="{{$VendorDetails['vendor_business']['shop_city']}}"
                                           readonly>
                                </div>
                                <div class="form-group">
                                    <label for="shop_state">Shop State</label>
                                    <input type="text" class="form-control" id="shop_state" name="shop_state" value="{{$VendorDetails['vendor_business']['shop_state']}}"
                                           readonly>
                                </div>
                                <div class="form-group">
                                    <label for="shop_country">Shop Country</label>
                                    <input type="text" class="form-control" id="shop_country" name="shop_country" value="{{$VendorDetails['vendor_business']['shop_country']}}"
                                           readonly>
                                </div>
                                <div class="form-group">
                                    <label for="shop_pincode">Shop PinCode</label>
                                    <input type="text" class="form-control" id="shop_pincode" name="shop_pincode" value="{{$VendorDetails['vendor_business']['shop_pincode']}}"
                                           readonly>
                                </div>

                                <div class="form-group">
                                    <label for="shop_mobile">Shop Mobile</label>
                                    <input type="text" class="form-control" id="shop_mobile" name="shop_mobile" value="{{$VendorDetails['vendor_business']['shop_mobile']}}"
                                           readonly>
                                </div>

                                <div class="form-group">
                                    <label for="shop_email">Shop Email</label>
                                    <input type="text" class="form-control" id="shop_email" name="shop_email" value="{{$VendorDetails['vendor_business']['shop_email']}}"
                                           readonly>
                                </div>

                                <div class="form-group">
                                    <label for="shop_website">Shop Website</label>
                                    <input type="text" class="form-control" id="shop_website" name="shop_website" value="{{$VendorDetails['vendor_business']['shop_website']}}"
                                           readonly>
                                </div>

                                <div class="form-group">
                                    <label for="business_license_number">Business License Number</label>
                                    <input type="text" class="form-control" id="business_license_number" name="business_license_number"
                                           value="{{$VendorDetails['vendor_business']['business_license_number']}}"
                                           readonly>
                                </div>

                                <div class="form-group">
                                    <label for="shop_address_proof">Address Proof</label>
                                    <input type="text" class="form-control" id="shop_address_proof" name="shop_address_proof"
                                           value="{{$VendorDetails['vendor_business']['address_prof']}}" readonly>
                                </div>


                                <div class="form-group">
                                    <label class="form-label">Address Proof Image</label>
                                    <br>
                                @if(!empty($VendorDetails['vendor_business']['address_prof_image']))
                                    <img src="{{url('admin/images/proofs/'.$VendorDetails['vendor_business']['address_prof_image'])}}">
                                @endif
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Vendor Bank Information</h4>
                                <div class="form-group">
                                    <label for="account_holder_name">Account Holder Name</label>
                                    <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" value="{{$VendorDetails['vendor_bank']['account_holder_name']}}"
                                           readonly>
                                </div>

                                <div class="form-group">
                                    <label for="account_number">Account Number</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number" value="{{$VendorDetails['vendor_bank']['account_number']}}"
                                           readonly>
                                </div>
                                <div class="form-group">
                                    <label for="bank_name">Bank Name</label>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{$VendorDetails['vendor_bank']['bank_name']}}"
                                           readonly>
                                </div>
                                <div class="form-group">
                                    <label for="bank_ifsc_code">Bank Ifsc Code</label>
                                    <input type="text" class="form-control" id="bank_ifsc_code" name="bank_ifsc_code" value="{{$VendorDetails['vendor_bank']['bank_ifsc_code']}}"
                                           readonly>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admin.layout.footer')
        <!-- partial -->
    </div>

@endsection
