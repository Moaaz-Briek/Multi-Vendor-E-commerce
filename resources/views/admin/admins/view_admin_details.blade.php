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
                            <h3 class="font-weight-bold mb-3">Admin Details</h3>
                            <h6 class="font-weight-normal mb-0"><a href="{{url('admin/admins/admins')}}">Back to Admins</a></h6>
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
                                        <input type="text" class="form-control" value="{{$admin['email']}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="vendor_name">Name</label>
                                        <input type="text" class="form-control"  value="{{$admin['name']}}"
                                               readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="vendor_mobile">Mobile</label>
                                        <input type="text" class="form-control" value="{{$admin['mobile']}}"
                                               readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="vendor_mobile">Admin Type</label>
                                        <input type="text" class="form-control" value="{{$admin['type']}}"
                                               readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="category_status">Admin Status</label>
                                        <input type="text" class="form-control" value="{{$admin['status'] == 1 ? "Active" : "Inactive"}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Admin Image</label>
                                        <br>
                                        @if(!empty($admin['image']))
                                            <a target="_blank" href="{{url('front/images/images/'.$admin['image'])}}">
                                                View Image
                                            </a>
                                        @endif
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
