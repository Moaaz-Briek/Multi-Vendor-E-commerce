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
        /**
         * Get all categories and subCategories with url = $url
         */
        $categoryDetails = Category::select('id', 'parent_id', 'category_name', 'url')
            ->with(['SubCategory' => function($query){$query->select('id','parent_id','category_name','url');}])
            ->where('url', $url)->first()->toArray();
        /**
         * Get Category and SubCategories Ids
         */
        //Define an array to holds the category and subcategories ids.
        $catId = array();
        //Push Category id
        $catId[] = $categoryDetails['id'];
        //Push SubCategories ids
        foreach ($categoryDetails['sub_category'] as $key => $subCat)
        {
            $catId[] = $subCat['id'];
        }
        /**
         * Shop-Page bread-crumb
         */
        if($categoryDetails['parent_id'] == 0)
        {
            //Root Categories have parent_id = 0, then only Show Root Category
            $breadcrumbs = '<li class=""><a href="'.url($categoryDetails['url']).'">'.$categoryDetails['category_name'].'</a></li>';
        }
        else
        {
            //SubCategories have parent_id != 0, then we need to get their root category first.
            $parentCategory = Category::where('id', $categoryDetails['parent_id'])->select('category_name', 'url')->first()->toArray();

            $breadcrumbs = '<li class="has-separator"><a href="'.url($parentCategory['url']).'">'.$parentCategory['category_name'].'</a></li>
                            <li class=""><a href="'.url($categoryDetails['url']).'">'.$categoryDetails['category_name'].'</a></li>';
        }

        return array('catIds'=>$catId, 'categoryDetails'=>$categoryDetails, 'bread-crumb' => $breadcrumbs);
    }

    public static function getCategoryName($category_id)
    {
        $Category = Category::select('category_name')->where('id',$category_id)->first();
        return ($Category->category_name);
    }
}
