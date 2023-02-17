<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;

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
Route::get('/',function(){
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    //admin
    Route::get('/dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('admin/update',[ProfileController::class,'updateAdminAccount'])->name('admin#update');
    Route::get('admin/changePassword',[ProfileController::class,'directChangePassword'])->name('admin#directChangePassword');
    Route::post('password/change',[ProfileController::class,'changePassword'])->name('admin#changePassword');

    //admin list
    Route::get('admin/list',[ListController::class,'index'])->name('admin#list');
    Route::get('admin/accountDelete/{id}',[ListController::class,'accountDelete'])->name('admin#accountDelete');


    //category
    Route::get('category',[CategoryController::class,'index'])->name('admin#category');
    Route::post('category/create',[CategoryController::class,'create'])->name('admin#categoryCreate');
    Route::get('category/delete/{id}',[CategoryController::class,'delete'])->name('admin#categoryDelete');


    //post
    Route::get('post',[PostController::class,'index'])->name('admin#post');

    //trend post
    Route::get('trendPost',[TrendPostController::class,'index'])->name('admin#trendPost');
});
