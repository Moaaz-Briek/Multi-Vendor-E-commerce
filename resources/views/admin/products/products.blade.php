@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a type="button" class="btn btn-primary float-end" href="{{url('admin/products/add-product')}}">Add New Product</a>
                            <div class="table-responsive pt-3">
                                <h4 class="card-title">All Products:</h4>
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
                                @if ($errors->any())
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </div>
                                @endif

                                <table id="categories" class="table table-striped table-bordered table-responsive text-center">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Product Color</th>
                                        <th>Product Image</th>
                                        <th>Section</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Added By</th>
                                        <th>Vendor name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0;?>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$product['product_name']}}</td>
                                            <td>{{$product['product_code']}}</td>
                                            <td>{{$product['product_color']}}</td>
                                            <td>
                                                <img
                                                    src="{{$product['product_image'] ? asset('front/images/product_images/small/' . $product['product_image']) : asset('front/images/product_images/small/250x250.jpg')}}"
                                                >
                                            </td>
                                            <td>{{$product['section']['name']}}</td>
                                            <td>{{($product['category'] !== null ? $product['category']['category_name'] : '-')}}</td>
                                            <td>{{$product['brand']['name']}}</td>
                                            <td><a href="{{url('admin/admins/view_admin_details/'.$product['admin']['id'])}}" title="Show Details"> {{$product['admin'] !== null ? ucfirst($product['admin']['type']) : '-' }} </a></td>

                                            <td><a
                                                    href="{{$product['vendor'] !== null ? url('admin/admins/view_vendor_details/'.$product['vendor']['id']) : "" }}" title="Show Details">
                                                    {{$product['vendor'] !== null ? ucfirst($product['vendor']['name']) : "" }}
                                                </a></td>

                                            {{--status--}}
                                            <td>
                                                @if($product['status'] == 1)
                                                    <a class="updateStatus" module="product" id="module-{{$product['id']}}" module-id="{{$product['id']}}" href="javascript:void(0)">
                                                        <i title="Active" style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>
                                                    </a>
                                                @else
                                                    <a class="updateStatus" module="product" id="module-{{$product['id']}}" module-id="{{$product['id']}}" href="javascript:void(0)">
                                                        <i title="Inactive" style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            {{--Actions--}}
                                            <td>
                                                <a title="Edit Product Information" href="{{url('admin/products/edit-product/'.$product['id'])}}">
                                                    <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                                </a>
                                                <a class="confirm_delete" module="product" module_id="{{$product['id']}}" title="Delete Product" href="javascript:void(0)">
                                                    <i class="mdi mdi-file-excel-box" style="font-size: 25px; color: red; margin-left: 10px"></i>
                                                </a>
                                                <a title="Add Product Attribute" href="{{url('admin/products/add-attribute/'.$product['id'])}}">
                                                    <i class="mdi mdi-plus-box" style="font-size: 25px; color: #08ea79; margin-left: 10px"></i>
                                                </a>
                                                <a title="Add Product Image" href="{{url('admin/products/add-image/'.$product['id'])}}">
                                                    <i class="mdi mdi-library-plus" style="font-size: 25px; color: #08ea79; margin-left: 10px"></i>
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
