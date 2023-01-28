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
                            <form class="forms-sample" action="{{url('admin/banners/edit-banner')}}" method="post" autocomplete="on" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$banner['id']}}">
                                <div class="form-group">
                                    <label for="banner_title">Banner Title</label>
                                    <input type="text" class="form-control" id="banner_title" name="title" required placeholder="Banner Title" value="{{$banner['title']}}">
                                </div>
                                <div class="form-group">
                                    <label for="banner_alt">Banner Alt</label>
                                    <input type="text" class="form-control" id="banner_alt" name="alt" required placeholder="Banner Alt" value="{{$banner['alt']}}">
                                </div>
                                <div class="form-group">
                                    <label for="banner_link">Banner Link</label>
                                    <input type="text" class="form-control" id="banner_link" name="link" required placeholder="Banner Link" value="{{$banner['link']}}">
                                </div>
                                <div class="form-group">
                                    <label for="section_status">Section Status</label>
                                    <select name="status" class="form-control">
                                        @if($banner['status'] == 1)
                                            <option value="1" selected>Active</option>
                                            <option value="2">Inactive</option>
                                        @else
                                            <option value="1">Active</option>
                                            <option value="2" selected>Inactive</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Category Image</label>
                                    <input type="file" class="form-control form-control-lg" id="banner_image" name="image">
                                    @if(!empty($banner['image']))
                                        <a target="_blank" href="{{url('front/images/banner_images/'.$banner['image'])}}">
                                            View Image
                                        </a>
                                        &nbsp;|&nbsp;
                                        <a href="javascript:void(0)" class="confirm_delete" module="banner_image" module_id="{{$banner['id']}}">
                                            Delete Image
                                        </a>
                                    @endif
                                    <input type="hidden" name="current_image" value="{{$banner['image']}}">
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
