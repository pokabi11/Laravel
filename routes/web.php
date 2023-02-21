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

Route::get('/', [\App\Http\Controllers\WebController::class,'home']);
Route::get("/about-us",[\App\Http\Controllers\WebController::class,"aboutUs"]);

Route::get("admin/product",[ProductController::class,"list"]);
Route::get("admin/product/create",[ProductController::class,"create"]);
Route::post("admin/product/create",[ProductController::class,"store"]);
Route::get("admin/product/edit/{product}",[ProductController::class,"edit"])->name("product_edit");
Route::put("admin/product/edit/{product}",[ProductController::class,"update"]);
Route::delete("admin/product/delete/{product}",[ProductController::class,"delete"])->name("product_delete");
