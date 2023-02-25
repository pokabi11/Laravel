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

Route::prefix(env("ADMIN_PATH"))->group(function(){
    Route::get('/dashboard', [\App\Http\Controllers\WebController::class,'home']);

    Route::prefix("product")->group(function (){
        Route::get("/",[ProductController::class,"list"]);
        Route::get("/create",[ProductController::class,"create"]);
        Route::post("/create",[ProductController::class,"store"]);
        Route::get("/edit/{product}",[ProductController::class,"edit"])->name("product_edit");
        Route::put("/edit/{product}",[ProductController::class,"update"]);
        Route::delete("/delete/{product}",[ProductController::class,"delete"])->name("product_delete");
    });
});

Route::get("/",[\App\Http\Controllers\GuestController::class,"index"]);
