<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('categories', App\Http\Controllers\API\CategoryAPIController::class);


Route::resource('discounts', App\Http\Controllers\API\DiscountAPIController::class);


Route::resource('discount_coupons', App\Http\Controllers\API\DiscountCouponAPIController::class);


Route::resource('promotions', App\Http\Controllers\API\PromotionAPIController::class);


Route::resource('products', App\Http\Controllers\API\ProductAPIController::class);


Route::resource('customers', App\Http\Controllers\API\CustomerAPIController::class);


Route::resource('order_statuses', App\Http\Controllers\API\OrderStatusAPIController::class);


Route::resource('cart_statuses', App\Http\Controllers\API\CartStatusAPIController::class);


Route::resource('return_statuses', App\Http\Controllers\API\ReturnStatusAPIController::class);


Route::resource('carts', App\Http\Controllers\API\CartAPIController::class);


Route::resource('cart_items', App\Http\Controllers\API\CartItemAPIController::class);


Route::resource('orders', App\Http\Controllers\API\OrderAPIController::class);


Route::resource('order_items', App\Http\Controllers\API\OrderItemAPIController::class);


Route::resource('returns', App\Http\Controllers\API\ReturnsAPIController::class);


Route::resource('return_items', App\Http\Controllers\API\ReturnItemAPIController::class);


Route::resource('messages', App\Http\Controllers\API\MessageAPIController::class);


Route::resource('ratings', App\Http\Controllers\API\RatingsAPIController::class);
