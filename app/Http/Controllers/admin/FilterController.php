<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductsFilters;
use Illuminate\Support\Facades\Session;

class FilterController extends Controller
{
    public function filters()
    {
        Session::put('page', 'filters');
        $filters = ProductsFilters::get()->toArray();
        return view('admin.filters.filters')->with(compact('filters'));
    }
}
