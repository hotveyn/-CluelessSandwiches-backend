<?php

use App\Http\Controllers\OptionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::prefix('/user')->group(function (){
    Route::get("/login", [UserController::class, "login"]);
    Route::post("/register", [UserController::class, "store"]);

    Route::middleware('auth:api')->group(function (){
       Route::patch("update", [UserController::class,"update"]);
    });
});

Route::prefix('/order')->group(function (){
   Route::get('/', [OrderController::class, "info"]);
   Route::post('/create', [OrderController::class, "store"]);
   Route::get('/{order}', [OrderController::class, "infoOne"]);
   Route::patch('/{order}/status', [OrderController::class, "update"]);
});

Route::prefix('/product')->group(function (){
    Route::get('/', [ProductController::class, "info"]);
    Route::get('/{product}', [ProductController::class, "infoOne"]);
    Route::get('/{product}/category', [ProductController::class, "categoryInfo"]);
    Route::get('/{product}/option', [ProductController::class, "optionInfo"]);
});

Route::prefix('/option')->group(function (){
    Route::patch('/{option}', [OptionController::class, "info"]);
    Route::patch('/{option}/toggle', [OptionController::class, "update"]);
});
