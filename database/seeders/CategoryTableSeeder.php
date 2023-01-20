<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
        [    'id' => '1',
            'parent_id' => '0',
            'section_id' => '1',
            'category_name' => 'فوط أطفال',
            'category_image' => '',
            'category_discount' => 0,
            'description' => '',
            'url' => 'Baby-towel',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'status' => '1',
        ],[    'id' => '2',
            'parent_id' => '0',
            'section_id' => '1',
            'category_name' => 'فوط نص بشكير',
            'category_image' => '',
            'category_discount' => 0,
            'description' => '',
            'url' => 'half-towel',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'status' => '1',
        ],[    'id' => '3',
            'parent_id' => '0',
            'section_id' => '1',
            'category_name' => 'فوط 4*1',
            'category_image' => '',
            'category_discount' => 0,
            'description' => '',
            'url' => '4-1-towel',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'status' => '1',
        ]
    ];
        Category::insert($categoryRecords);
    }
}
