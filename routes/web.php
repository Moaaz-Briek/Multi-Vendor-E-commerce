<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\admin')->group(callback: function (){

        //Admin login Route
        Route::match(['get', 'post'],'/login', 'AdminController@login');
        Route::group(['middleware' => ['admin']], function (){
        // Admin Dashboard Route
        Route::get('/dashboard', 'AdminController@dashboard');
        //Admin logout Route
        Route::get('/logout', 'AdminController@logout');
        //Update admin password
        Route::match(['get', 'post'], 'update-admin-password', 'AdminController@updateAdminPassword');
        //Update admin password
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails');
        //Check Admin Password
        Route::post('check_current_password', 'AdminController@checkAdminPassword');
        //Update Vendor Details
        Route::match(['get', 'post'], 'update-vendor-details/{slug}', 'AdminController@updateVendorDetails');
        //View Admins / SubAdmins / Vendors
        Route::get('admins/{type?}', 'AdminController@admins');
        //View Vendor Details
        Route::get('admins/view_vendor_details/{id}', 'AdminController@ViewVendorDetails');
        //View Admin Details
        Route::get('admins/view_admin_details/{id}', 'AdminController@ViewAdminDetails');
        //Update Admin Status
        Route::post('update_admin_status','AdminController@UpdateAdminStatus');

        //Display Sections
        Route::get('sections', 'SectionController@sections');
        //Update section status
        Route::post('sections/update_section_status','SectionController@UpdateSectionStatus');
        //Delete section
        Route::get('sections/delete-section/{id}','SectionController@DeleteSection');
        //Edit section
        Route::match(['get', 'post'], 'sections/edit-section/{id?}','SectionController@EditSection');
        //Add section
        Route::match( ['get', 'post'],'sections/add-section','SectionController@AddSection' );

        //Display Categories
        Route::get('categories', 'CategoryController@categories');
        //Update category status
        Route::post('categories/update_category_status','CategoryController@UpdateCategoryStatus');
        //Add category
        Route::match( ['get', 'post'],'categories/add-category','CategoryController@AddCategory');
        //Get Section Categories
        Route::post('categories/get-section-category', 'CategoryController@GetSectionCategory');
        //Delete category
        Route::get('categories/delete-category/{id}','CategoryController@DeleteCategory');
        //Delete category image
        Route::get('categories/delete-category-image/{id}','CategoryController@DeleteCategoryImage');
        //Edit category
        Route::match(['get', 'post'], 'categories/edit-category/{id?}','CategoryController@EditCategory');

        //Display Brands
        Route::get('brands', 'BrandController@brands');
        //Update section status
        Route::post('brands/update_brand_status','BrandController@UpdateBrandStatus');
        //Delete brands
        Route::get('brands/delete-brand/{id}','BrandController@DeleteBrand');
        //Edit brands
        Route::match(['get', 'post'], 'brands/edit-brand/{id?}','BrandController@EditBrand');
        //Add brands
        Route::match( ['get', 'post'],'brands/add-brand','BrandController@AddBrand' );

        //.... Product CRUD ....//
        Route::get('products', 'ProductController@products');
        //Add products
        Route::match( ['get', 'post'],'products/add-product','ProductController@AddProduct' );
        //Get Sub Categories
        Route::post('products/get-sub-categories', 'ProductController@GetSubCategory');
        //Update product status
        Route::post('products/update_product_status','ProductController@UpdateProductStatus');
        //Delete products
        Route::get('products/delete-product/{id}','ProductController@DeleteProduct');
        //Edit products
        Route::match(['get', 'post'], 'products/edit-product/{id?}','ProductController@EditProduct');

        //.... Product Images and Attributes ....//
        //Add/Display product Attribute
        Route::match( ['get', 'post'],'products/add-attribute/{id?}','ProductController@AddAttribute' );
        //Update product Attribute Status
        Route::post('products/product_attributes/update_attribute_status','ProductController@UpdateProductAttributeStatus');
        //Delete product attrribute
        Route::get('products/product_attributes/delete-attribute/{id}','ProductController@DeleteProductAttribute');
        //Update product values
        Route::post('products/product_attributes/update_attribute_value','ProductController@UpdateProductAttributeValues');
        //Add / Display product Images
        Route::match( ['get', 'post'],'products/add-image/{id?}','ProductController@AddImage');
        //Update product Image Status
        Route::post('products/product_image_status','ProductController@UpdateProductImageStatus');
        //Delete product image
        Route::get('products/delete-product_image/{id}','ProductController@DeleteProductImage');
        //Delete product image
        Route::get('products/delete-product_video/{id}','ProductController@DeleteProductVideo');
        //Delete product selected image
        Route::get('products/delete-selected_images/{id}','ProductController@DeleteProductSelectedImages');

        //.... Filter CRUD ....//
        Route::get('filters', 'FilterController@filters');

        //.... Banner CRUD ....//
        Route::get('banners', 'BannerController@banners');
        //Add banners
        Route::match( ['get', 'post'],'banners/add-banner','BannerController@addBanner' );
        //Edit banners
        Route::match( ['get', 'post'],'banners/edit-banner/{id?}','BannerController@editBanner' );
        //Update banner status
        Route::post('banners/update_banner_status','BannerController@UpdateBannerStatus');
        //Delete banner
        Route::get('banners/delete-banner/{id}','BannerController@DeleteBanner');
        //Delete Image banner
        Route::get('banners/delete-banner_image/{id}','BannerController@DeleteBannerImage');
    });
});

Route::namespace('App\Http\Controllers\front')->group(function (){
    Route::get( '/', 'IndexController@index');
    //Listing Categories Routes
    $categoryUrls = Category::select('url')->where('status', 1)->get()->pluck('url')->toArray();
    foreach ($categoryUrls as $key => $url) {
        Route::match(['get', 'post'],'/'.$url, 'ProductsController@listing');
    }
});

require __DIR__.'/auth.php';
