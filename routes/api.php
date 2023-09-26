<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\UserProfileController;
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

    Route::post('/create/review', [ReviewController::class, 'createReview']);
    Route::post('/giverating/{bookid}/{rating}', [BookController::class, 'giveRating']);
    

    Route::get('/cart', [CartController::class, 'viewCart']);
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::put('/cart/update/{id}', [CartController::class, 'updateCartItem']);
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeCartItem']);

    


    Route::put('/updateUser', [UserProfileController::class, 'update']);

    // Route to get the user's own profile
    Route::get('/user/profile', [UserProfileController::class, 'show'])->middleware('auth:api');

    // Route to delete a user's profile (admin only)
    Route::delete('/admin/users/{user}', [UserProfileController::class, 'destroy'])->middleware(['auth:api', 'admin']);


    // // Orders Routes
    // Route::resource('orders', OrderController::class);

    // // Order Items Routes
    // Route::resource('order-items', OrderItemController::class);


});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::get('/showbooks', [BookController::class, 'showAllBooks']);
Route::get('/showbooks/{id}', [BookController::class, 'showBook']);











