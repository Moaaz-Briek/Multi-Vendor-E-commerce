<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function section(){
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function SubCategory(){
        return $this->belongsTo(Category::class, 'sub_category_id' , 'id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function Attributes(){
        return $this->hasMany(Product_Attribute::class, 'product_id');
    }

    public function Image(){
        return $this->hasMany(Product_Image::class, 'product_id');
    }

    public static function isProductNew($product_id)
    {
        $productIds = Product::select('id')->where('status', 1)->orderBy('id', 'Desc')->limit(3)->pluck('id');
        $productIds = json_decode(json_encode($productIds), true);
        if(in_array($product_id, $productIds)) {
            $isProductNew = "Yes";
        } else {
            $isProductNew = "No";
        }
        return $isProductNew;
    }
}
