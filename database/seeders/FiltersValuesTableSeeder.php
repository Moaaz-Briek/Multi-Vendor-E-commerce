<?php

namespace Database\Seeders;

use App\Models\ProductsFiltersValues;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FiltersValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filterValueRecords = [
          ['id' => 1, 'filter_id' => 1, 'filter_value' => 'بوليستر', 'status' => 1],
          ['id' => 2, 'filter_id' => 1, 'filter_value' => 'مخلوط', 'status' => 1],
          ['id' => 3, 'filter_id' => 2, 'filter_value' => '40x80', 'status' => 1],
          ['id' => 4, 'filter_id' => 2, 'filter_value' => '50x110', 'status' => 1],
          ['id' => 5, 'filter_id' => 3, 'filter_value' => '3 قطع', 'status' => 1],
          ['id' => 6, 'filter_id' => 3, 'filter_value' => '7 قطع', 'status' => 1],
        ];

        ProductsFiltersValues::insert($filterValueRecords);
    }
}
