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
                            <h6 class="font-weight-normal mb-0">Update Admin Password</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Admin Details</h4>
                            <form class="forms-sample" action="{{url('admin/update-admin-details')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Admin Username/Email</label>
                                    <input type="text" class="form-control" value="{{$adminDetails['email']}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Admin Type</label>
                                    <input type="email" class="form-control" value="{{$adminDetails['type']}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="admin_name">Name</label>
                                    <input type="text" class="form-control" id="admin_name" name="admin_name" value="{{$adminDetails['name']}}"
                                           required placeholder="Enter Name">
                                </div>
                                <div class="form-group">
                                    <label for="admin_mobile">Mobile</label>
                                    <input type="text" class="form-control" id="admin_mobile" name="admin_mobile" value="{{$adminDetails['mobile']}}"
                                           placeholder="Enter New Password" required maxlength="11" minlength="11">
                                </div>
                                <div class="form-group">
                                    <label for="formFileLg" class="form-label">Admin Image</label>
                                    <input type="file" class="form-control form-control-lg" id="admin_image" name="admin_image">
                                @if(!empty(\Illuminate\Support\Facades\Auth::guard('admin')->user()->image))
                                    <a target="_blank" href="{{url('admin/images/photos/'.\Illuminate\Support\Facades\Auth::guard('admin')->user()->image)}}">
                                        View Image
                                    </a>
                                @endif
                                    <input type="hidden" name="current_admin_image" value="{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->image}}">
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
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
