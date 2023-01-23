<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * id, category_id, section_id, brand_id, vendor_id, admin_type, product_name, product_code, product_color, main_image, description, product_price, product_discount, product_weight, product_video, meta_title, meta_description, meta_keywords, is_featured, status
     */
    public function run()
    {
        $productRecords = [
            ['id' => 1, 'category_id' => 1, 'section_id' => 1, 'brand_id' => 1, 'vendor_id' => 2, 'admin_id' => 1,'admin_type' => 'superadmin', 'product_name' => 'فوط السروجى دهب ', 'product_code' => 'hf12', 'product_color' => 'mix', 'main_image' => '', 'description' => '', 'product_price' => 250, 'product_discount' => 0, 'product_weight' => 150, 'product_video' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'is_featured' => '', 'status' => 1],
            ['id' => 2, 'category_id' => 1, 'section_id' => 1, 'brand_id' => 1, 'vendor_id' => 1, 'admin_id' => 1,'admin_type' => 'vendor', 'product_name' => 'فوط السروجى ريشة ', 'product_code' => 'hf19', 'product_color' => 'mix', 'main_image' => '', 'description' => '', 'product_price' => 350, 'product_discount' => 0, 'product_weight' => 200, 'product_video' => '', 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'is_featured' => '', 'status' => 1],
            ];
        Product::insert($productRecords);
    }
}
