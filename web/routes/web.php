<?php

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

//User
Route::group(['prefix' => ''], function(){
    Route::get('', [\App\Http\Controllers\User\HomeController::class, 'index'])->name('home.index');
});

//Detail
Route::group(['prefix' => 'product'], function(){
    Route::get('{proid}', [\App\Http\Controllers\User\DetailController::class, 'index']);
    Route::get('{proid}/getsize', [\App\Http\Controllers\User\DetailController::class, 'getSize']);
    Route::get('{proid}/addreview', [\App\Http\Controllers\User\DetailController::class, 'review']);
    Route::delete('{proid}/{reviewID}', [\App\Http\Controllers\User\DetailController::class, 'removeReview']);
});

//Shop
Route::group(['prefix' => 'shop'], function(){
    Route::get('', [\App\Http\Controllers\User\ShopController::class, 'index']);
    Route::get('{catid}', [\App\Http\Controllers\User\ShopController::class, 'category']);
});

//Cart
Route::group(['prefix' => 'cart'], function(){
    Route::get('', [\App\Http\Controllers\User\CartController::class, 'index']);
    Route::get('add', [\App\Http\Controllers\User\CartController::class, 'add']);
    Route::get('delete', [\App\Http\Controllers\User\CartController::class, 'delete']);
    Route::get('edit', [\App\Http\Controllers\User\CartController::class, 'edit']);
    Route::get('update', [\App\Http\Controllers\User\CartController::class, 'update']);
    Route::get('check', [\App\Http\Controllers\User\CartController::class, 'check']);
});

//CheckOut
Route::group(['prefix' => 'checkout'], function(){
    Route::get('', [\App\Http\Controllers\User\CheckOutController::class, 'index']);
    Route::post('', [\App\Http\Controllers\User\CheckOutController::class, 'add']);
});

//Love
Route::group(['prefix' => 'love'], function(){
    Route::get('', [\App\Http\Controllers\User\LoveController::class, 'index']);
    Route::get('add', [\App\Http\Controllers\User\LoveController::class, 'add']);
    Route::get('delete', [\App\Http\Controllers\User\LoveController::class, 'delete']);;
});

//BLog
Route::group(['prefix' => 'blog'], function(){
    Route::get('', [\App\Http\Controllers\User\BlogController::class, 'index']);
});

//Contact
Route::group(['prefix' => 'contact'], function(){
    Route::get('', [\App\Http\Controllers\User\ContactController::class, 'index']);
});

//Account
Route::group(['prefix' => 'account'], function(){
    Route::get('', [\App\Http\Controllers\User\AccountController::class, 'index']);
    Route::post('', [\App\Http\Controllers\User\AccountController::class, 'update']);
});

//Login
Route::get('sign in', [\App\Http\Controllers\Sign\UserController::class, 'signIn'])->name('login');
Route::post('sign in', [\App\Http\Controllers\Sign\UserController::class, 'checkSignIn']);

//Register
Route::get('sign up', [\App\Http\Controllers\Sign\UserController::class, 'signUp'])->name('register');
Route::post('sign up', [\App\Http\Controllers\Sign\UserController::class, 'checkSignUp']);

//Logout
Route::get('/sign out', [\App\Http\Controllers\Sign\UserController::class, 'signOut'])->name('logout');

//Admin
Route::prefix('admin') -> middleware('check') -> group( function() {
    Route::resource('category', '\App\Http\Controllers\Admin\CategoryController');
    Route::resource('brand', '\App\Http\Controllers\Admin\BrandController');
    Route::resource('product', '\App\Http\Controllers\Admin\ProductController');
    Route::resource('product/{proid}/image', '\App\Http\Controllers\Admin\ImageController');
    Route::resource('product/{proid}/detail', '\App\Http\Controllers\Admin\ProductDetailController');
    Route::resource('slide', '\App\Http\Controllers\Admin\SlideController');
    Route::resource('blog', '\App\Http\Controllers\Admin\BlogController');
    Route::resource('order', '\App\Http\Controllers\Admin\OrderController');
    Route::resource('overview', '\App\Http\Controllers\Admin\OverviewController');
    Route::resource('user', '\App\Http\Controllers\Admin\UserController');
});