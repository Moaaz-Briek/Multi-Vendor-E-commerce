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
                ->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);

            //Filtering Products based on Latest | Lowest price | Highest Price | A-Z | Z-A
            if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                if ($_GET['sort'] == 'latest') {
                    $categoryProducts->orderBy('id', 'Desc');
                } elseif ($_GET['sort'] == 'lowest') {
                    $categoryProducts->orderBy('products.product_price', 'Asc');
                } elseif ($_GET['sort'] == 'highest') {
                    $categoryProducts->orderBy('products.product_price', 'Desc');
                } elseif ($_GET['sort'] == 'a-z') {
                    $categoryProducts->orderBy('products.product_name', 'Asc');
                } elseif ($_GET['sort'] == 'z-a') {
                    $categoryProducts->orderBy('products.product_name', 'Desc');
                }
            }
            $categoryProducts = $categoryProducts->paginate(3);
            return view('front.products.listing')->with(compact('categoryDetails','categoryProducts'));
        }  else  {
            abort(404);
        }
    }

}
