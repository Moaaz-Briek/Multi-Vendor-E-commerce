<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function Section(){
        return $this->belongsTo(Section::class, 'section_id')->select('id','name');
    }

    public function ParentCategory(){
        return $this->belongsTo(Category::class, 'parent_id')->select('id','category_name');
    }

    public function SubCategory(){
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1);
    }

    public static function categoryDetails($url)
    {
        //Get all categories and subCategories with url = $url
        $categoryDetails = Category::select('id', 'category_name', 'url')->with('SubCategory')->where('url', $url)->first()->toArray();

        //Define an array to holds the category and subcategories ids.
        $catId = array();
        //Push Category id
        $catId[] = $categoryDetails['id'];
        //Push SubCategories ids
        foreach ($categoryDetails['sub_category'] as $key => $subCat)
        {
            $catId[] = $subCat['id'];
        }

        return array('catIds'=>$catId, 'categoryDetails'=>$categoryDetails);
    }
}
