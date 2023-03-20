<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
class ProductsController extends Controller
{
    public function listing()
    {
        $url = Route::getFacadeRoot()->current()->uri();
        $categoryCount = Category::where(['url'=> $url, 'status' => 1])->count();
        if($categoryCount > 0) {
            $categoryDetails = Category::categoryDetails($url);
            $categoryProducts = Product::with(['brand', 'SubCategory', 'category'])
                ->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->simplePaginate(3);
            return view('front.products.listing')->with(compact('categoryDetails','categoryProducts'));
        }  else  {
            abort(404);
        }
    }

}
