<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->middleware(['web','auth','isAdmin'])->group(function(){
    
    Route::get('/dashboard',[App\Http\Controllers\Admin\DashboardController::class,'index']);    
    
    Route::get('category',[App\Http\Controllers\Admin\CategoryController::class,'index'])->name('category.testindex');
    Route::get('add-category',[App\Http\Controllers\Admin\CategoryController::class,'create']);
    Route::post('add-category',[App\Http\Controllers\Admin\CategoryController::class,'store']);
    Route::get('edit-category/{category_id}',[App\Http\Controllers\Admin\CategoryController::class,'edit']); 
    Route::get('delete-category/{category_id}',[App\Http\Controllers\Admin\CategoryController::class,'destroy']);
    Route::post('add-category/{category_id}',[App\Http\Controllers\Admin\CategoryController::class,'store'])->name('category.teststore');
    Route::get('show-category/{category_id}',[App\Http\Controllers\Admin\CategoryController::class,'show'])->name('category.testshow');
    Route::put('update-category/{category_id}',[App\Http\Controllers\Admin\CategoryController::class,'update'])->name('category.testupdate');
    Route::delete('delete-category/{category_id}',[App\Http\Controllers\Admin\CategoryController::class,'destroy'])->name('category.testdelete');
    
    
    Route::get('posts',[App\Http\Controllers\Admin\PostController::class,'index'])->name('post.testindex');
    Route::get('add-post',[App\Http\Controllers\Admin\PostController::class,'create']);
    Route::get('post/{post_id}',[App\Http\Controllers\Admin\PostController::class,'edit']);   
    Route::get('delete-post/{post_id}',[App\Http\Controllers\Admin\PostController::class,'destroy']);
    Route::post('add-post',[App\Http\Controllers\Admin\PostController::class,'store'])->name('post.teststore');
    Route::get('show-post/{post_id}',[App\Http\Controllers\Admin\PostController::class,'show'])->name('post.testshow');
    Route::put('update-post/{post_id}',[App\Http\Controllers\Admin\PostController::class,'update'])->name('post.testupdate');
    Route::delete('delete-post/{post_id}',[App\Http\Controllers\Admin\PostController::class,'destroy'])->name('post.testdelete');

    Route::get('users',[App\Http\Controllers\Admin\UserController::class, 'index']);
    
});