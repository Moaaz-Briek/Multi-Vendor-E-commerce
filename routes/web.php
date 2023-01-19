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

        //Display sections
        Route::get('sections', 'SectionController@sections');
        //Update section status
        Route::post('sections/update_section_status','SectionController@UpdateSectionStatus');
        //Edit section status
        Route::post('sections/update_section/{id}','SectionController@EditSection');
        //Delete section status
        Route::get('sections/delete-section/{id}','SectionController@DeleteSection');
    });
});

require __DIR__.'/auth.php';
