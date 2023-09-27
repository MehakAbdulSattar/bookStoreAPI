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

    
    
    Route::put('/updateUser', [UserProfileController::class, 'update']);
    Route::get('/user/profile', [UserProfileController::class, 'show']);
    
    Route::delete('/users/{user_id}', [UserProfileController::class, 'destroy']);
    
    Route::post('/subscribe', [UserProfileController::class, 'subscription']);


    Route::get('/cart', [CartController::class, 'viewCart']);
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::post('/cart/update/{id}', [CartController::class, 'updateCartItem']);
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeCartItem']);


    Route::post('create/orders', [OrderController::class, 'createOrder']);
    Route::post('update/orders/{order_id}', [OrderController::class, 'updateOrder']);
    Route::get('show/orders', [OrderController::class, 'showAllOrders']);
    Route::get('show/orders/{order_id}', [OrderController::class, 'showOrder']);
    Route::delete('delete/orders/{order_id}', [OrderController::class, 'deleteOrder']);
    
    

    Route::get('/orderitems/show', [OrderItemController::class, 'showAllitems']);
    Route::get('/orderitems/show/{orderItem_id}', [OrderItemController::class, 'showItem']);
    Route::delete('/orderitems/delete/{orderItem_id}', [OrderItemController::class, 'deletItem']);
    
    Route::post('/create/review', [ReviewController::class, 'createReview']);
    Route::post('/giverating/{bookid}/{rating}', [BookController::class, 'giveRating']);
    
    Route::post('/wishlist/add/{bookId}', [WishlistController::class, 'addToWishlist']);
    Route::delete('/wishlist/remove/{bookId}', [WishlistController::class, 'removeFromWishlist']);
    Route::get('/wishlist/show', [WishlistController::class, 'getUserWishlist']);
    

    Route::post('/logout', [AuthController::class, 'logout']);

});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('/showbooks', [BookController::class, 'showAllBooks']);
Route::get('/showbooks/{id}', [BookController::class, 'showBook']);