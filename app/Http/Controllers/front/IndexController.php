<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $fixBanners = Banner::where(['status'=>1, 'type' => 'fix'])->get()->toArray();
        $sliderBanners = Banner::where(['status'=>1, 'type' => 'slider'])->get()->toArray();
        $bestSellers = Product::where(['is_bestseller' => 'Yes', 'status' => 1])->get()->toArray();
        return view('front.index')->with(compact('fixBanners', 'sliderBanners', 'bestSellers'));
    }
}
