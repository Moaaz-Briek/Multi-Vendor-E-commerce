<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductsFilters;
use App\Models\ProductsFiltersValues;
use App\Traits\CommonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FilterController extends Controller
{
    use CommonController;

    public function filters()
    {
        Session::put('page', 'filters');
        $filters = ProductsFilters::get()->toArray();
        return view('admin.filters.filters')->with(compact('filters'));
    }

    public function UpdateFilterStatus(Request $request, ProductsFilters $filter)
    {
        Session::put('page','filters');
        $arr = $this->UpdateStatus($request, $filter);
        return response()->json($arr);
    }

    public function filterValues()
    {
        Session::put('page','filters');
        $filter_values = ProductsFiltersValues::get()->toArray();
        return view('admin.filters.filters_values')->with(compact('filter_values'));
    }

    public function updateFilterValueStatus(Request $request, ProductsFiltersValues $filtersValues)
    {
        Session::put('page','filters');
        $arr = $this->UpdateStatus($request, $filtersValues);
        return response()->json($arr);
    }
}
