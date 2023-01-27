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
                            <h3 class="font-weight-normal mb-2">Add New Product:</h3>
                            <h6 class="font-weight-normal mb-0"><a href="{{url('admin/products')}}">Back to Products</a></h6>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-12  grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form class="forms-sample" action="{{url('admin/products/add-product')}}" autocomplete="on" method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <label for="select_section">Select Section</label>
                                        <select class="form-control" id="section_categories" module="product" name="section_id">
                                            <option disabled selected value="">Select</option>
                                            @foreach($sections as $section)
                                                <option value="{{$section['id']}}">{{$section['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id">Select Category</label>
                                        <select class="form-control" id="category" name="category_id"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="sub_category_id">Select Sub Category</label>
                                        <select class="form-control" id="sub-category" name="sub_category_id">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="brand_id">Brand Name</label>
                                        <select class="form-control" name="brand_id">
                                            @foreach($brands as $brand)
                                                <option value="{{$brand['id']}}">{{$brand['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_name">Product Name</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name"
                                               required placeholder="Enter Product Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="product_color">Product Color</label>
                                        <input type="color" class="mt-2 form-control form-control-color" id="product_color" name="product_color"
                                               required placeholder="Enter Color">
                                    </div>
                                    <div class="form-group">
                                        <label for="product_code">Product Code</label>
                                        <input type="text" class="form-control" id="product_code" name="product_code"
                                               required placeholder="Enter Code">
                                    </div>
                                    <div class="form-group">
                                        <label for="product_price">Product Price</label>
                                        <input type="text" class="form-control" id="product_price" name="product_price"
                                               required placeholder="Enter Price">
                                    </div>
                                    <div class="form-group">
                                        <label for="product_discount">Product Discount (%)</label>
                                        <input type="text" class="form-control" id="product_discount" name="product_discount"
                                               required placeholder="Enter Discount">
                                    </div>
                                    <div class="form-group">
                                        <label for="product_weight">Product Weight</label>
                                        <input type="text" class="form-control" id="product_weight" name="product_weight"
                                            required placeholder="Enter Weight">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                                               required placeholder="Enter Meta Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <input type="text" class="form-control" id="meta_description" name="meta_description"
                                               required placeholder="Enter Meta Description">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta KeyWords</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                               required placeholder="Enter Meta Keywords">
                                    </div>
                                    <div class="form-group">
                                        <label for="product_description">Product Description</label>
                                        <input type="text" class="form-control" id="product_description" name="product_description"
                                               required placeholder="Enter ">
                                    </div>
                                    <div class="form-group">
                                        <label for="product_status">Product Status</label>
                                        <select name="product_status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_featured">Featured Items</label>
                                        <input type="checkbox" id="is_featured" name="is_featured" value="yes"
                                               required checked="">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Product Image (Recommended Size: 1000*1000)</label>
                                        <input type="file" class="form-control form-control-lg" id="product_image" name="product_image">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Product Video (Recommended Size: Less Than 2 MB)</label>
                                        <input type="file" class="form-control form-control-lg" id="product_video" name="product_video">
                                    </div>

                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <a class="btn btn-light" href="{{url('admin/products')}}">Cancel</a>
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
