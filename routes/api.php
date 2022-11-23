<?php

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
    Route::post("/register", [UserController::class, "store"]);

    Route::middleware('auth:api')->group(function (){
       Route::patch("update", [UserController::class,"update"]);
    });
});
