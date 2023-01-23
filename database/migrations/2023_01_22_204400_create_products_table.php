<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * id, category_id, section_id, brand_id, vendor_id, admin_type, product_name, product_code, product_color, main_image, description, product_price, product_discount, product_weight, product_video, meta_title, meta_description, meta_keywords, is_featured and status
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('section_id');
            $table->integer('brand_id');
            $table->integer('vendor_id');
            $table->integer('admin_id');
            $table->string('admin_type');
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_color');
            $table->string('main_image');
            $table->text('description');
            $table->float('product_price');
            $table->float('product_discount');
            $table->float('product_weight');
            $table->string('product_video');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keywords');
            $table->string('is_featured');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
