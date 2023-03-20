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
                    <form name="sortProducts" id="sortProducts">
                        <input type="hidden" name="url" id="url" value="{{$url}}">
                        <div class="toolbar-sorter">
                        <div class="select-box-wrapper">
                            <label class="sort" for="sort-by">Sort By</label>
                            <select name="sort" id="sort" class="select-box" autocomplete="off">
                                <option selected="" value="">Select</option>
                                <option @if(isset($_GET['sort']) && $_GET['sort'] == "latest") selected @endif value="latest">Sort By: Latest</option>
                                <option @if(isset($_GET['sort']) && $_GET['sort'] == "lowest") selected @endif value="lowest">Sort By: Lowest Price</option>
                                <option @if(isset($_GET['sort']) && $_GET['sort'] == "highest") selected @endif value="highest">Sort By: Highest Price</option>
                                <option @if(isset($_GET['sort']) && $_GET['sort'] == "a-z") selected @endif value="a-z">Sort By: Name A - Z</option>
                                <option @if(isset($_GET['sort']) && $_GET['sort'] == "z-a") selected @endif value="z-a">Sort By: Name Z - A</option>
                            </select>
                        </div>
                    </div>
                    </form>
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
                <div class="filter_products">
                    @include('front.products.ajax_products_listing')
                </div>
                <!-- Row-of-Product-Container /- -->

                <!-- Shop-Pagination -->
                <!-- This if condition helps in moving between pages and making the sort value of the select input exists -->
                @if(isset($_GET['sort']))
                    <div> {{$categoryProducts->appends(['sort' => $_GET['sort']])->links()}} </div>
                @else
                    <div> {{$categoryProducts->links()}} </div>
                @endif
                <!-- End Shop-Pagination -->
            </div>
        </div>
    </div>
</div>
<!-- Shop-Page /- -->
@endsection
