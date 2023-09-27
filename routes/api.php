<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\WishlistController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () 
{

    
    
    Route::middleware(['permission:update_User'])->put('/updateUser', [UserProfileController::class, 'update']);
    Route::middleware(['permission:show_User'])->get('/user/profile', [UserProfileController::class, 'show']);
    
    Route::middleware(['permission:delete_User'])->delete('/users/{user_id}', [UserProfileController::class, 'destroy']);
    
    Route::post('/subscribe', [UserProfileController::class, 'subscription']);


    Route::middleware(['permission:show_cart'])->get('/cart', [CartController::class, 'viewCart']);
    Route::middleware(['permission:add_cart'])->post('/cart/add', [CartController::class, 'addToCart']);
    Route::middleware(['permission:update_cart'])->post('/cart/update/{id}', [CartController::class, 'updateCartItem']);
    Route::middleware(['permission:delete_cart'])->delete('/cart/remove/{id}', [CartController::class, 'removeCartItem']);


    Route::middleware(['permission:create_order'])->post('create/orders', [OrderController::class, 'createOrder']);
    Route::middleware(['permission:update_order'])->post('update/orders/{order_id}', [OrderController::class, 'updateOrder']);
    Route::middleware(['permission:show_order'])->get('show/orders', [OrderController::class, 'showAllOrders']);
    Route::middleware(['permission:show_order_against_orderid'])->get('show/orders/{order_id}', [OrderController::class, 'showOrder']);
    Route::middleware(['permission:show_order_against_userid'])->get('/orders/{user_id}', [OrderController::class, 'showOrdersByUserId']);
    Route::middleware(['permission:delete_order'])->delete('delete/orders/{order_id}', [OrderController::class, 'deleteOrder']);

    

    Route::middleware(['permission:show_orderitem'])->get('/orderitems/show', [OrderItemController::class, 'showAllitems']);
    Route::middleware(['permission:show_orderitem_against_id'])->get('/orderitems/show/{orderItem_id}', [OrderItemController::class, 'showItem']);
    Route::middleware(['permission:delete_orderitem'])->delete('/orderitems/delete/{orderItem_id}', [OrderItemController::class, 'deletItem']);
    
    Route::middleware(['permission:review'])->post('/create/review', [ReviewController::class, 'createReview']);
    Route::middleware(['permission:rating'])->post('/giverating/{bookid}/{rating}', [BookController::class, 'giveRating']);
    
    Route::middleware(['permission:add_wishlist'])->post('/wishlist/add/{bookId}', [WishlistController::class, 'addToWishlist']);
    Route::middleware(['permission:delete_wishlist'])->delete('/wishlist/remove/{bookId}', [WishlistController::class, 'removeFromWishlist']);
    Route::middleware(['permission:show_wishlist'])->get('/wishlist/show', [WishlistController::class, 'getUserWishlist']);
    

    Route::post('/logout', [AuthController::class, 'logout']);

});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('/showbooks', [BookController::class, 'showAllBooks']);
Route::get('/showbooks/{id}', [BookController::class, 'showBook']);