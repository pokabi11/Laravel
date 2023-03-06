<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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

Route::get("/about-us",[\App\Http\Controllers\WebController::class,"aboutUs"]);

Route::prefix(env("ADMIN_PATH")) -> group(function(){
    Route::get('/dashboard', [\App\Http\Controllers\WebController::class,'home']);

    Route::prefix("product") -> group(function (){
        Route::get("/",[ProductController::class,"list"]);
        Route::get("/create",[ProductController::class,"create"]);
        Route::post("/create",[ProductController::class,"store"]);
        Route::get("/edit/{product}",[ProductController::class,"edit"]) -> name("product_edit");
        Route::put("/edit/{product}",[ProductController::class,"update"]);
        Route::delete("/delete/{product}",[ProductController::class,"delete"]) -> name("product_delete");
    });
});

Route::get("/",[\App\Http\Controllers\GuestController::class,"index"]);
Route::get("/detail/{product}",[\App\Http\Controllers\GuestController::class,"product"]);
Route::get("/add-to-cart/{product}",[\App\Http\Controllers\GuestController::class,"addToCart"]);
Route::get("/cart",[\App\Http\Controllers\GuestController::class,"cart"]);
Route::get("/remove-item/{product}",[\App\Http\Controllers\GuestController::class,"removeItem"]);
Route::get("/checkout",[\App\Http\Controllers\GuestController::class,"checkout"]);
Route::post("/checkout",[\App\Http\Controllers\GuestController::class,"placeOrder"]);

Route::get("/process-paypal/{order}",[\App\Http\Controllers\GuestController::class,"processPaypal"])->name("process_paypal");
Route::get("/success-paypal/{order}",[\App\Http\Controllers\GuestController::class,"successPaypal"])->name("success_paypal");
Route::get("/cancel-paypal/}",[\App\Http\Controllers\GuestController::class,"cancelPaypal"])->name("cancel_paypal");


//live code
Route::prefix(env("LIVE_PATH")) -> group(function (){
    Route::get('homepage',[\App\Http\Controllers\LiveWebController::class,'home']);
});
