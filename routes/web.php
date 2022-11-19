<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/product/{product:product_code}','productInfo')->name('product_info');
    Route::get('list-product','productList')->name('product_list');
});

Route::resource('cart', CartController::class);
Route::post('add-cart',[CartController::class,'addCart'])->name('add_cart');
Route::get('store-order',[CartController::class,'storeOrder'])->name('store_order');

Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::get('/forgot-password', 'forgotPassword')->name('forgot_password');
    Route::post('/forgot-password', 'sendForgotPasswordEmail')->name('send_forgot_password_email');
    Route::get('/reset-password/{token}', 'resetPassword')->name('reset_password');
    Route::post('/reset-password', 'resetPasswordData')->name('reset_password_data');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/profile', 'userProfile')->name('user_profile');
    Route::put('/profile', 'userProfileUpdate')->name('user_profile_update');
    Route::post('/user-image-update', 'userProfileImageUpdate')->name('user_profile_image_update');
});

Route::group(['prefix'=>'/admin-panel',['middleware'=>['checkRoles']]],function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('admin_home');
        Route::get('/user','list')->name('admin_user_list');
        Route::get('/user/{id}','edit')->name('admin_user_edit');
        Route::put('/user/{id}','update')->name('admin_user_update');
        Route::post('/user-profile/{id}','userProfile')->name('admin_user_profile_update');
        Route::get('/register-user', 'registerUser')->name('admin_user_register');
        Route::post('/register-user', 'registerStoreUser')->name('admin_user_profile_register');
        Route::get('/user-status/{id}/{status?}', 'userStatus')->name('admin_user_status');
    });

    Route::resource('brands', BrandController::class);
    Route::controller(BrandController::class)->group(function(){
        Route::post('brand-image/{id}','brandImage')->name('admin_brand_image');
        Route::get('brand-status/{id}/{status?}','brandStatus')->name('admin_brand_status');
    });

    Route::resource('products', ProductController::class);
    Route::controller(ProductController::class)->group(function(){
        Route::post('product-image/{id}','productImage')->name('admin_product_image');
        Route::get('product-status/{id}/{status?}','productStatus')->name('admin_product_status');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('/order','index')->name('admin_order_list');
        Route::post('/order-status/{id}','orderStatus')->name('admin_order_status');
        Route::get('/order-items/{id}','orderItem')->name('admin_order_item');
    });
});
