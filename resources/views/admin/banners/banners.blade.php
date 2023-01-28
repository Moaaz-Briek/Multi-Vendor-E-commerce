@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a type="button" class="btn btn-primary float-end" href="{{url('admin/banners/add-banner')}}">Add New Banner</a>
                            <div class="table-responsive pt-3">
                            <h4 class="card-title">All Sections:</h4>
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
                                <table id="sections" class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Link</th>
                                        <th>Title</th>
                                        <th>Alt</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0;?>
                                    @foreach($banners as $banner)
                                        <tr>
                                            <td style="width: 15px" id="checkbox"><input type="checkbox" name="ids" id="ids" value="{{$banner['id']}}"></td>
                                            <td>{{++$i}}</td>
                                            <td>
                                                <img src="{{ url('front/images/banner_images/'.$banner['image']) }}">
                                            </td>
                                            <td>{{$banner['link']}}</td>
                                            <td>{{$banner['title']}}</td>
                                            <td>{{$banner['alt']}}</td>
                                            {{--status--}}
                                            <td>
                                                @if($banner['status'] == 1)
                                                    <a class="updateStatus" module="banner" id="module-{{$banner['id']}}" module-id="{{$banner['id']}}" href="javascript:void(0)">
                                                        <i title="Active" style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>
                                                    </a>
                                                @else
                                                    <a class="updateStatus" module="banner" id="module-{{$banner['id']}}" module-id="{{$banner['id']}}" href="javascript:void(0)">
                                                        <i title="Inactive" style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            {{--Actions--}}
                                            <td>
                                                <a title="Edit Section Name" href="{{url('admin/banners/edit-banner/'.$banner['id'])}}">
                                                    <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                                </a>
                                                <a class="confirm_delete" module="banner" module_id="{{$banner['id']}}" title="Delete Banner Image" href="javascript:void(0)">
                                                    <i class="mdi mdi-file-excel-box" style="font-size: 25px; color: red; margin-left: 10px"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <a id="delete_product_images" module="selected_images" class="confirm_delete btn btn-primary mr-2">Delete Selected Banners</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
            </div>
        </footer>
        <!-- partial -->
    </div>
@endsection
