<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannerRecord = [
            ['id' => 1, 'image' => '1.jpg', 'link' => 'دفايات', 'title' => 'دفايات', 'alt' => 'دفايات', 'status' => 1],
            ['id' => 2, 'image' => '3.jpg', 'link' => 'مفرش', 'title' => 'مفرش', 'alt' => 'مفرش', 'status' => 1],
            ['id' => 3, 'image' => '6.jpg', 'link' => 'لحاف', 'title' => 'لحاف', 'alt' => 'لحاف', 'status' => 1],
        ];
        Banner::insert($bannerRecord);
    }
}
