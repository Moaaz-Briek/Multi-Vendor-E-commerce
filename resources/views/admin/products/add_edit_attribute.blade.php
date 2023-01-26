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
                            <h3 class="font-weight-normal mb-2">Add Product Attributes:</h3>
                            <h6 class="font-weight-normal mb-0"><a href="{{url('admin/products')}}">Back to Products</a></h6>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-12  grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form class="forms-sample" action="{{url('admin/products/add-attribute')}}" autocomplete="on" method="post">
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
                                    <div class="field_wrapper form-group">
                                        <div>
                                            <label class="form-label">Product Attributes : </label><br>
                                            <input type="text" name="size[]" placeholder="Size" required>
                                            <input type="text" name="sku[]" placeholder="SKU" required>
                                            <input type="text" name="price[]" placeholder="Price" required>
                                            <input type="text" name="stock[]" placeholder="Stock" required>
                                            <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                        </div>
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
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Size</th>
                                        <th class="text-center">SKU</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Stock</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0;?>
                                    @foreach($product['attributes'] as $attribute)
                                        <input type="text" style="display: none" value="{{$attribute['id']}}" name="attribute_id[]">
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$attribute['size']}}</td>
                                            <td>{{$attribute['sku']}}</td>
                                            <td>
                                                <input type="text" class="form-control text-center" name="price[]" required value="{{$attribute['price']}}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control text-center" name="stock[]" required value="{{$attribute['stock']}}">
                                            </td>
                                            <td>
                                                @if($attribute['status'] == 1)
                                                    <a class="updateStatus" module="attribute" id="module-{{$attribute['id']}}" module-id="{{$attribute['id']}}" href="javascript:void(0)">
                                                        <i title="Active" style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>
                                                    </a>
                                                @else
                                                    <a class="updateStatus" module="attribute" id="module-{{$attribute['id']}}" module-id="{{$attribute['id']}}" href="javascript:void(0)">
                                                        <i title="Inactive" style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            {{--Actions--}}
                                            <td>
                                                <a title="Edit Category Information" href="{{url('admin/categories/edit-category/'.$attribute['id'])}}">
                                                    <i class="mdi mdi-pencil-box" style="font-size: 25px;"></i>
                                                </a>
                                                <a class="confirm_delete" module="attribute" module_id="{{$attribute['id']}}" title="Delete Attribte" href="javascript:void(0)">
                                                    <i class="mdi mdi-file-excel-box" style="font-size: 25px; color: red; margin-left: 10px"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                    <button type="submit" class="btn btn-primary mr-2">Update Attributes</button>
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
