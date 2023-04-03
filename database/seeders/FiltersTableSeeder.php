<?php

namespace Database\Seeders;

use App\Models\ProductsFilters;
use Illuminate\Database\Seeder;

class FiltersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filterRecords = [
          ['id' => 1, 'cat_ids' => '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18', 'filter_name' => 'نوع القماش', 'filter_column' => 'cotton', 'status' => 1],
          ['id' => 2, 'cat_ids' => '1,2,3,4,5,6,7', 'filter_name' => 'حجم الفوطة', 'filter_column' => '60x120', 'status' => 1],
          ['id' => 3, 'cat_ids' => '8,9,10,11', 'filter_name' => 'عدد القطع', 'filter_column' => '5 قطع', 'status' => 1],
        ];

        ProductsFilters::insert($filterRecords);
    }
}
