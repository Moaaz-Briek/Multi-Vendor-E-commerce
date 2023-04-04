<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsFilters extends Model
{
    use HasFactory;

    public static function getFilterName($filter_id)
    {
        $filter = ProductsFilters::select('filter_name')->where('id', $filter_id)->first();
        return $filter->filter_name;
    }
}
