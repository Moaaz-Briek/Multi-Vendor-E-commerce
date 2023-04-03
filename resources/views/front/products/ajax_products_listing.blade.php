<div class="row product-container grid-style">
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
            @if(App\Models\Product::isProductNew($product['id']) == 'Yes')
                <div class="tag new">
                    <span>NEW</span>
                </div>
            @endif
        </div>
    </div>
@endforeach
</div>
