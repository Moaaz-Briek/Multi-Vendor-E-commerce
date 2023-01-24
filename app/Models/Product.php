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

}
