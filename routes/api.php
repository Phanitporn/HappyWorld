<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//Route::get('getData',[AuthController::class,'getData']);        //เรียกใช้ข้อมูล
//Route::post('postData',[AuthController::class,'postData']);       //สร้างข้อมูล
//Route::put('putData',[AuthController::class,'putData']);        //แก้ไขข้อมูล
//Route::delete('deleteData',[AuthController::class,'deleteData']);     //ลบข้อมูล

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::get('productRead',[ProductController::class,'productRead']);
Route::get('productReadID/{id}',[ProductController::class,'productReadID']);

//ใช้Token
Route::group(['middleware' => 'auth:sanctum'], function () {
Route::post('productCreate',[ProductController::class,'productCreate']);
Route::put('productUpdate/{id}',[ProductController::class,'productUpdate']);
Route::delete('productDelete/{id}',[ProductController::class,'productDelete']);
Route::post('logout',[AuthController::class,'logout']);
});