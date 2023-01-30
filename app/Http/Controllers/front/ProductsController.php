<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
class ProductsController extends Controller
{
    public function listing()
    {
        $url = Route::getFacadeRoot()->current()->uri();
        $categoryCount = Category::where(['url'=> $url, 'status' => 1])->count();
        if($categoryCount > 0)
        {
            dd(Category::categoryDetails($url));
        }
        else
        {
            abort(404);
        }
    }

}
