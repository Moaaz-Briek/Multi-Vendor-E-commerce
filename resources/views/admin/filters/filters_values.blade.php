@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="text-black-50">Filters Values:</h1>
                            <a type="button" class="btn btn-primary float-end ms-2" href="{{url('admin/filters/')}}">View Filters</a>
                            <a type="button" class="btn btn-primary float-end" href="{{url('admin/filters/add_filter_value')}}">Add New Filter Value</a>
                            <div class="table-responsive pt-3">
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
                                <table id="brands" class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Filter ID</th>
                                        <th>Filter Name</th>
                                        <th>Filter Value</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0;?>
                                    @foreach($filter_values as $filter)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$filter['filter_id']}}</td>
                                            <td>
                                                <?php
                                                    echo \App\Models\ProductsFilters::getFilterName($filter['filter_id'])
                                                ?>
                                            </td>
                                            <td>{{$filter['filter_value']}}</td>
                                            <td>
                                                @if($filter['status'] == 1)
                                                    <a class="updateStatus" title="Active" module="filterValue" id="module-{{$filter['id']}}" module-id="{{$filter['id']}}" href="javascript:void(0)">
                                                        <i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>
                                                    </a>
                                                @else
                                                    <a class="updateStatus" title="Inactive" module="filterValue" id="module-{{$filter['id']}}" module-id="{{$filter['id']}}" href="javascript:void(0)">
                                                        <i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            {{--Actions--}}
                                            <td>
                                                <a title="Edit Brand Name" href="{{url('admin/brands/edit-brand/'.$filter['id'])}}">
                                                    <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                                </a>
                                                <a class="confirm_delete" module="brand" module_id="{{$filter['id']}}" title="Delete Brand" href="javascript:void(0)">
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
