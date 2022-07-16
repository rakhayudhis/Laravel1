<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishlistController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [FrontendController::class, 'index']);
Route::get('category', [FrontendController::class, 'category']);
Route::get('category/{slug}', [FrontendController::class, 'viewCategory']);
Route::get('category/{cate_slug}/{prod_slug}', [FrontendController::class, 'productsView']);


Auth::routes();

Route::get('load-cart-data',[CartController::class, 'cartcount']);
Route::get('load-wishlist-count',[WishlistController::class, 'wishlistcount']); 


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('add-to-cart', [CartController::class, 'addProduct']);
Route::post('delete-cart-item', [CartController::class, 'deleteproduct']);
Route::post('update-cart', [CartController::class, 'updatecart']);
Route::post('add-to-wishlist', [WishlistController::class, 'add']);
Route::post('remove-wishlist-item', [WishlistController::class, 'delete']);


Route::middleware(['auth'])->group(function () {
    Route::get('cart', [CartController::class, 'viewcart']);
    Route::get('checkout', [CheckoutController::class, 'index']);
    Route::post('place-order', [CheckoutController::class, 'placeorder']);

    Route::get('my-orders', [UserController::class, 'index']);
    Route::get('view-order/{id}', [UserController::class, 'view']);

    Route::get('wishlist', [WishlistController::class, 'index']);
    Route::post('proceed-to-pay', [CheckoutController::class, 'razorpaycheck']);
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dasboard', 'Admin\FrontendController@index');
    Route::get('categories', 'Admin\CategoryController@index');

    Route::get('add-category', 'Admin\CategoryController@addRakha');
    Route::post('insert-category', 'Admin\CategoryController@insertRakha');
    Route::get('edit-category/{id}', [CategoryController::class, 'editRakha']);
    Route::put('update-category/{id}', [CategoryController::class, 'updateRakha']);
    Route::get('delete-category/{id}', [CategoryController::class, 'destroyRakha']);

    Route::get('products', [ProductController::class, 'index']);
    Route::get('add-products', [ProductController::class, 'addRakha']);
    Route::post('insert-products', [ProductController::class, 'insertRakha']);

    Route::get('edit-product/{id}', [ProductController::class, 'editRakha']);
    Route::put('update-product/{id}', [ProductController::class, 'updateRakha']);
    Route::get('delete-product/{id}', [ProductController::class, 'destroyRakha']);


    Route::get('orders', [OrderController::class, 'index']);
    Route::get('admin/view-order/{id}', [OrderController::class, 'view']);
    Route::put('update-order/{id}', [OrderController::class, 'updateorder']);
    Route::get('order-history', [OrderController::class, 'orderhistory']);


    Route::get('users', [DashboardController::class, 'users']);
    Route::get('view-users/{id}', [DashboardController::class, 'viewuser']);
});
