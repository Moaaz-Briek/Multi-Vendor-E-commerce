@extends('front.layout.layout')
@section('content')
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Shop</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="index.html">Home</a>
                </li>
                <?php echo $categoryDetails['bread-crumb']; ?>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
<!-- Shop-Page -->
<div class="page-shop u-s-p-t-80">
    <div class="container">
        <!-- Shop-Intro -->
        <div class="shop-intro">
            <ul class="bread-crumb">
                <li class="has-separator">
                    <a href="/">Home</a>
                </li>
                <?php echo $categoryDetails['bread-crumb']; ?>
            </ul>
        </div>
        <!-- Shop-Intro /- -->
        <div class="row">
            @include('front.products.filters')
            <!-- Shop-Right-Wrapper -->
            <div class="col-lg-9 col-md-9 col-sm-12">
                <!-- Page-Bar -->
                <div class="page-bar clearfix">
                    <div class="shop-settings">
                        <a id="list-anchor">
                            <i class="fas fa-th-list"></i>
                        </a>
                        <a id="grid-anchor" class="active">
                            <i class="fas fa-th"></i>
                        </a>
                    </div>
                    <!-- Toolbar Sorter 1  -->
                    <div class="toolbar-sorter">
                        <div class="select-box-wrapper">
                            <label class="sr-only" for="sort-by">Sort By</label>
                            <select class="select-box" id="sort-by">
                                <option selected="selected" value="">Sort By: Best Selling</option>
                                <option value="">Sort By: Latest</option>
                                <option value="">Sort By: Lowest Price</option>
                                <option value="">Sort By: Highest Price</option>
                                <option value="">Sort By: Best Rating</option>
                            </select>
                        </div>
                    </div>
                    <!-- //end Toolbar Sorter 1  -->
                    <!-- Toolbar Sorter 2  -->
                    <div class="toolbar-sorter-2">
                        <div class="select-box-wrapper">
                            <label class="sr-only" for="show-records">Show Records Per Page</label>
                            <select class="select-box" id="show-records">
                                <option selected="selected" value="">Showing : {{count($categoryProducts)}}</option>
                                <option value="">Show: All</option>
                            </select>
                        </div>
                    </div>
                    <!-- //end Toolbar Sorter 2  -->
                </div>
                <!-- Page-Bar /- -->
                <!-- Row-of-Product-Container -->
                <div class="row product-container list-style">
                    @foreach($categoryProducts as $product)
                    <div class="product-item col-lg-4 col-md-6 col-sm-6">
                        <div class="item">
                            <div class="image-container">
                                <a class="item-img-wrapper-link" href="{{url('products/'.$product['id'])}}">
                                    <img class="img-fluid"  alt="Product"
                                         src="{{($product['product_image'] && file_exists('front/images/product_images/small/' . $product['product_image']))
                                                    ? asset('front/images/product_images/small/'
                                                    . $product['product_image']) : asset('front/images/product_images/small/250x250.jpg')}}">
                                </a>
                                <div class="item-action-behaviors">
                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                    <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                </div>
                            </div>
                            <div class="item-content">
                                <div class="what-product-is">
                                    <ul class="bread-crumb">
                                        <li class="has-separator">
                                            <a href="shop-v1-root-category.html">{{$product['product_code']}}</a>
                                        </li>
                                        <li class="has-separator">
                                            <a href="javascript:;">{{$product['brand']['name']}}</a>
                                        </li>
                                        <li class="{{$product['sub_category'] ? "has-separator" : ''}}">
                                            <a href="{{$product['category']['url']}}">{{$product['category']['category_name']}}</a>
                                        </li>
                                            @if($product['sub_category'])
                                        <li>
                                            <a href="{{$product['sub_category']['url']}}">{{$product['sub_category']['category_name']}}</a>
                                        </li>
                                            @endif
                                    </ul>
                                    <h6 class="item-title">
                                        <a href="single-product.html">{{$product['product_name']}}</a>
                                    </h6>
                                    <div class="item-description">
                                        <p>{{$product['product_description']}}</p>
                                    </div>
{{--                                    <div class="item-stars">--}}
{{--                                        <div class='star' title="4.5 out of 5 - based on 23 Reviews">--}}
{{--                                            <span style='width:67px'></span>--}}
{{--                                        </div>--}}
{{--                                        <span>(23)</span>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="price-template">
                                    <div class="item-new-price">
                                        {{$product['product_price'] - (($product['product_discount'] / 100) * $product['product_price'])}}
                                    </div>
                                    @if($product['product_discount'] != 0)
                                        <div class="item-old-price">
                                            {{$product['product_price']}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tag new">
                                <span>NEW</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Row-of-Product-Container /- -->
            </div>
            <!-- Shop-Right-Wrapper /- -->
            <!-- Shop-Pagination -->
            <div class="pagination-area">
                <div class="pagination-number">
                    <ul>
                        <li style="display: none">
                            <a href="shop-v1-root-category.html" title="Previous">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        <li class="active">
                            <a href="shop-v1-root-category.html">1</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">2</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">3</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">...</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">10</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html" title="Next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Shop-Pagination /- -->
        </div>
    </div>
</div>
<!-- Shop-Page /- -->
@endsection
