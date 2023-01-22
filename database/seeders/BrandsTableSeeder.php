<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecords = [
          ['id' => 1, 'name' => 'السروجى', 'status' => 1],
          ['id' => 2, 'name' => 'العالمية', 'status' => 1],
          ['id' => 3, 'name' => 'الحسن والحسين', 'status' => 1],
          ['id' => 4, 'name' => 'الحرية جروب', 'status' => 1],
          ['id' => 5, 'name' => 'المجد', 'status' => 1],
        ];
        Brand::insert($brandRecords);
    }
}
