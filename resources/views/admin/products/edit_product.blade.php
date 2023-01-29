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
                            <h3 class="font-weight-normal mb-2">Edit Product:</h3>
                            <h6 class="font-weight-normal mb-0"><a href="{{url('admins/products')}}">Back to Products</a></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" action="{{url('admin/products/edit-product')}}" autocomplete="off" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{$product['id']}}">
                                    <label for="select_section">Select Section</label>
                                    <select class="form-control" id="section_categories" module="product" name="section_id">
                                        <option selected value="{{$product['section_id']}}">{{$product['section']['name']}}</option>
                                        @foreach($sections as $section)
                                            @if($product['section_id'] !== $section['id'])
                                                <option value="{{$section['id']}}">{{$section['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Select Category</label>
                                    <select class="form-control" id="category" name="category_id">
                                        @if($product['category_id'] != null)
                                            <option value="{{$product['category_id']}}">{{$product['category']['category_name']}}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub_category_id">Select Sub Category</label>
                                    <select class="form-control" id="sub-category" name="sub_category_id">
                                        @if($product['sub_category_id'] != null)
                                            <option value="{{$product['sub_category_id']}}">{{$product['sub_category']['category_name']}}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="brand_id">Brand Name</label>
                                    <select class="form-control" name="brand_id">
                                        <option selected value="{{$product['brand_id']}}">{{$product['brand']['name']}}</option>
                                        @foreach($brands as $brand)
                                            @if($brand['id'] !== $product['brand_id'])
                                                <option value="{{$brand['id']}}">{{$brand['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name"
                                           required placeholder="Enter Product Name" value="{{$product['product_name']}}">
                                </div>
                                <div class="form-group">
                                    <label for="product_color">Product Color</label>
                                    <input type="color" class="mt-2 form-control form-control-color" id="product_color" name="product_color"
                                           required placeholder="Enter Color" value="{{$product['product_color']}}">
                                </div>
                                <div class="form-group">
                                    <label for="product_code">Product Code</label>
                                    <input type="text" class="form-control" id="product_code" name="product_code"
                                           required placeholder="Enter Code" value="{{$product['product_code']}}">
                                </div>
                                <div class="form-group">
                                    <label for="product_price">Product Price</label>
                                    <input type="text" class="form-control" id="product_price" name="product_price"
                                           required placeholder="Enter Price" value="{{$product['product_price']}}">
                                </div>
                                <div class="form-group">
                                    <label for="product_discount">Product Discount (%)</label>
                                    <input type="text" class="form-control" id="product_discount" name="product_discount"
                                           required placeholder="Enter Discount" value="{{$product['product_discount']}}">
                                </div>
                                <div class="form-group">
                                    <label for="product_weight">Product Weight</label>
                                    <input type="text" class="form-control" id="product_weight" name="product_weight"
                                           required placeholder="Enter Weight" value="{{$product['product_weight']}}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                                           value="{{$product['meta_title']}}" required placeholder="Enter Meta Title">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <input type="text" class="form-control" id="meta_description" name="meta_description"
                                           value="{{$product['meta_description']}}" required placeholder="Enter Meta Description">
                                </div>
                                <div class="form-group">
                                    <label for="meta_keywords">Meta KeyWords</label>
                                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                           value="{{$product['meta_keywords']}}" required placeholder="Enter Meta Keywords">
                                </div>
                                <div class="form-group">
                                    <label for="product_description">Product Description</label>
                                    <input type="text" class="form-control" id="product_description" name="product_description"
                                           value="{{$product['product_description']}}" required placeholder="Enter ">
                                </div>
                                <div class="form-group">
                                    <label for="product_status">Product Status</label>
                                    <select name="product_status" class="form-control">
                                        @if($product['status'] == 1)
                                            <option selected value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        @else
                                            <option selected value="2">Inactive</option>
                                            <option value="1">Active</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="is_featured">Featured Items</label>
                                    <input type="checkbox" id="is_featured" name="is_featured" value="Yes"
                                           {{($product['is_featured'] === 'Yes') ? 'checked':''}}>
                                    &nbsp&nbsp|&nbsp&nbsp
                                    <label for="is_bestseller">Best Seller Items</label>
                                    <input type="checkbox" id="is_bestseller" name="is_bestseller" value="Yes"
                                        {{($product['is_bestseller'] === 'Yes') ? 'checked':''}}>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Product Image</label>
                                    <input type="file" class="form-control form-control-lg" id="product_image" name="product_image">
                                    @if(!empty($product['product_image']))
                                        <a target="_blank" href="{{url('front/images/product_images/medium/'.$product['product_image'])}}">
                                            View Image
                                        </a>
                                        &nbsp;|&nbsp;
                                        <a href="javascript:void(0)" class="confirm_delete" module="product_image" module_id="{{$product['id']}}">
                                            Delete Image
                                        </a>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Product Video (Recommended Size: Less Than 2 MB)</label>
                                    <input type="file" class="form-control form-control-lg" id="product_video" name="product_video">
                                    @if(!empty($product['product_video']))
                                        <a target="_blank" href="{{url('front/videos/product_videos/'.$product['product_video'])}}">
                                            View Image
                                        </a>
                                        &nbsp;|&nbsp;
                                        <a href="javascript:void(0)" class="confirm_delete" module="product_video" module_id="{{$product['id']}}">
                                            Delete Image
                                        </a>
                                    @endif
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
