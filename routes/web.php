<?php

use App\Http\Controllers\Blog\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WelcomeController;

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

Route::get('/', [WelcomeController::class,  'index'])->name('welcome');
Route::get('blog/posts/{post}', [PostController::class,  'show'])->name('blog.show');
Route::get('blog/categories/{category}', [PostController::class,  'category'])->name('blog.category');
Route::get('blog/categories/{tag}', [PostController::class,  'tag'])->name('blog.tag');

Auth::routes();

Route::middleware(['auth'])->group(function () {

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/categories', CategoryController::class);
Route::resource('/tags', TagController::class);
Route::resource('/post', PostsController::class);
Route::get('/trashed-posts', [PostsController::class,'trashed'])->name('trashpost.index');
Route::put('/restore-posts/{post}', [PostsController::class,'restore'])->name('restore-posts');

});

Route::middleware(['auth','admin'])->group(function(){

    Route::get('users/profile', [UsersController::class, 'edit'])->name('users.edit-profile');
    Route::put('users/profile', [UsersController::class, 'update'])->name('users.update-profile');
    Route::get('users', [UsersController::class, 'index'])->name('users.index');
    Route::post('users/{user}/make-admin', [UsersController::class, 'MakeAdmin'])->name('users.make-admin');
});
