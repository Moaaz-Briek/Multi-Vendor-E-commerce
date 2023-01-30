<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $products = Product::where('status', 1)->limit(100)->inRandomOrder()->get()->toArray();
        $fixBanners = Banner::where(['status'=>1, 'type' => 'fix'])->get()->toArray();
        $sliderBanners = Banner::where(['status'=>1, 'type' => 'slider'])->get()->toArray();
        $bestSellers = Product::where(['is_bestseller' => 'Yes', 'status' => 1])->inRandomOrder()->get()->toArray();
        $isFeatured = Product::where(['is_featured' => 'Yes', 'status' => 1])->inRandomOrder()->get()->toArray();
        $discountedProducts = Product::where('product_discount','>', 0)->where('status', 1)->limit(6)->inRandomOrder()->get()->toArray();
        return view('front.index')->with(compact('fixBanners', 'sliderBanners', 'bestSellers', 'discountedProducts', 'isFeatured', 'products'));
    }
}
