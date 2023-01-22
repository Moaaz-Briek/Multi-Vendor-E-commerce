<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Route::prefix('/admin')->namespace('App\Http\Controllers\admin')->group(function (){
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

        //Display Products
        Route::get('products', 'ProductController@products');
        //Update section status
        Route::post('products/update_product_status','ProductController@UpdateProductStatus');
        //Delete products
        Route::get('products/delete-product/{id}','ProductController@DeleteProduct');
        //Edit products
        Route::match(['get', 'post'], 'products/edit-product/{id?}','ProductController@EditProduct');
        //Add products
        Route::match( ['get', 'post'],'products/add-product','ProductController@AddProduct' );

    });
});

require __DIR__.'/auth.php';
