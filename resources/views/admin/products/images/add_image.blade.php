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
                            <h3 class="font-weight-normal mb-2">Add Product Image:</h3>
                            <h6 class="font-weight-normal mb-0"><a href="{{url('admin/products')}}">Back to Products</a></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Images</h4>
                            <form class="forms-sample" action="{{url('admin/products/add-image')}}" autocomplete="on" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                    <label for="product_name">Product Name : </label>
                                    <input type="hidden" name="id" value="{{$product['id']}}">
                                    {{$product['product_name']}}
                                </div>
                                <div class="form-group">
                                    <label for="product_color">Product Color : </label>
                                    {{$product['product_color']}}
                                </div>
                                <div class="form-group">
                                    <label for="product_code">Product Code : </label>
                                    {{$product['product_code']}}
                                </div>
                                <div class="form-group">
                                    <label for="product_price">Product Price : </label>
                                    {{$product['product_price']}}
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Product Image : </label><br>
                                    <img class="form-img" src={{$product['product_image'] ? url('front/images/product_images/small/'.$product['product_image']) : url('front/images/product_images/small/250x250.jpg')}}>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Add Images: </label>
                                    <input class="form-control" type="file" name="images[]" multiple id="images">
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a class="btn btn-light" href="{{url('admin/products')}}">Cancel</a>
                            </form>
                        </div>
                    </div>
                    </div>
                    <div class="col-12  grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{url('admin/products/product_attributes/update_attribute_value')}}" autocomplete="off">
                                @csrf
                                <table id="categories" class="table table-striped table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width: 10px"></th>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">status</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0;?>
                                    @foreach($product['Image'] as $image)
                                        <tr>
                                            <td style="width: 15px" id="checkbox"><input type="checkbox" name="ids" id="ids" value="{{$image['id']}}"></td>
                                            <td>{{++$i}}</td>
                                            <td>
                                                <img class="form-img" src={{$image['image'] ? url('front/images/product_images/small/'.$image['image']) : url('front/images/product_images/small/250x250.jpg')}}>
                                            </td>
                                            {{--Actions--}}
                                            <td>
                                                @if($image['status'] == 1)
                                                    <a class="updateStatus" module="product_image" id="module-{{$image['id']}}" module-id="{{$image['id']}}" href="javascript:void(0)">
                                                        <i title="Active" style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>
                                                    </a>
                                                @else
                                                    <a class="updateStatus" module="product_image" id="module-{{$image['id']}}" module-id="{{$image['id']}}" href="javascript:void(0)">
                                                        <i title="Inactive" style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="confirm_delete" module="product_image" module_id="{{$image['id']}}" title="Delete Image" href="javascript:void(0)">
                                                    <i class="mdi mdi-file-excel-box" style="font-size: 25px; color: red; margin-left: 10px"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                    <a id="delete_product_images" module="selected_images" class="confirm_delete btn btn-primary mr-2">Delete Selected Images</a>
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
