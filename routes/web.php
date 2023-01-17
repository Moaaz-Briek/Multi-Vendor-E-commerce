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
    });
});

require __DIR__.'/auth.php';
