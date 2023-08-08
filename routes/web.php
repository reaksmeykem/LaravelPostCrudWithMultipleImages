<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/index', function(){
//     return view("index");
// });

Route::get("post/create/", [PostController::class,'index'])->name("create_post");

Route::post('post/store/', [PostController::class,'store'])->name('store_post');
Route::get('post/detail/{id}',[PostController::class,'view_detail'])->name('view_detail');
Route::get('post/edit/{id}/', [PostController::class,'edit'])->name('post.edit');
Route::post('post/update/{id}/', [PostController::class,'update'])->name('post.update');
Route::get('post/image/delete/{id}', [PostController::class,'delete_image'])->name('post.delete.image');
Route::get('post/delete/{id}/', [PostController::class,'delete'])->name('post.delete');
