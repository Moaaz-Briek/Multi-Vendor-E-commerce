@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a type="button" class="btn btn-primary float-end" href="{{url('admin/categories/add-category')}}">Add New Category</a>
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
                                <table id="categories" class="table table-striped table-bordered ">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Parent Category</th>
                                        <th>Section Name</th>
                                        <th>Url</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0;?>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$category['category_name']}}</td>

                                            @if(isset($category['parent_category']['category_name']) &&!empty($category['parent_category']['category_name']))
                                            <td>{{$category['parent_category']['category_name']}}</td>
                                            @else
                                            <td>Root</td>
                                            @endif

                                            <td>{{$category['section']['name']}}</td>
                                            <td>{{$category['url']}}</td>
                                            {{--status--}}
                                            <td>
                                                @if($category['status'] == 1)
                                                    <a class="updateCategoryStatus" id="category-{{$category['id']}}" category-id="{{$category['id']}}" href="javascript:void(0)">
                                                        <i title="Active" style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>
                                                    </a>
                                                @else
                                                    <a class="updateCategoryStatus" id="category-{{$category['id']}}" category-id="{{$category['id']}}" href="javascript:void(0)">
                                                        <i title="Inactive" style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            {{--Actions--}}
                                            <td>
                                                <a title="Edit Category Information" href="{{url('admin/categories/edit-category/'.$category['id'])}}">
                                                    <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                                </a>
                                                <a class="confirm_delete" module="category" module_id="{{$category['id']}}" title="Delete Section" href="javascript:void(0)">
                                                    <i class="mdi mdi-file-excel-box" style="font-size: 25px; color: red; margin-left: 10px"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
