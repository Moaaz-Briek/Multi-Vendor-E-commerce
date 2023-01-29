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
                            <h3 class="font-weight-bold mb-2">Add New Section</h3>
                            <h6 class="font-weight-normal"><a href="{{url('admin/banners')}}">Back to Banners</a></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-12  grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form class="forms-sample" action="{{url('admin/banners/add-banner')}}" method="post" autocomplete="on" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="banner_type">Banner Type</label>
                                        <select name="type" class="form-control" required>
                                            <option value="" disabled selected>Select</option>
                                            <option value="slider">Slider</option>
                                            <option value="fix">Fix</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="banner_title">Banner Title</label>
                                        <input type="text" class="form-control" id="banner_title" name="title" required placeholder="Banner Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="banner_alt">Banner Alt</label>
                                        <input type="text" class="form-control" id="banner_alt" name="alt" required placeholder="Banner Alt">
                                    </div>
                                    <div class="form-group">
                                        <label for="banner_link">Banner Link</label>
                                        <input type="text" class="form-control" id="banner_link" name="link" required placeholder="Banner Link">
                                    </div>
                                    <div class="form-group">
                                        <label for="section_status">Section Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="banner_image">Banner Image</label>
                                        <input type="file" class="form-control" id="banner_image" name="image" required placeholder="Banner Image">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <a type="reset" href="{{url('admin/banners')}}" class="btn btn-light">Cancel</a>
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
