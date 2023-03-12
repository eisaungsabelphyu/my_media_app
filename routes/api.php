<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\PostApiController;
use App\Http\Controllers\Api\ActionLogsController;
use App\Http\Controllers\Api\CategoryApiController;




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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('user/register',[AuthApiController::class,'register']);
Route::post('user/login',[AuthApiController::class,'login']);

//category
Route::get('category',[CategoryApiController::class,'index']);
Route::post('category/search',[CategoryApiController::class,'search']);

//post
Route::get('post',[PostApiController::class,'index']);
Route::post('post/search',[PostApiController::class,'searchData']);
Route::post('post/detail',[PostApiController::class,'detail']);

//action logs
Route::post('post/actionLogs',[ActionLogsController::class,'action']);
