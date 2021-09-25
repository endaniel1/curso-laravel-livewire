<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;

Route::get('', [HomeController::class, 'index'])->name('admin.home');


Route::get('/users/trash', [UserController::class, 'trash'])->name('admin.users.trash');
Route::get('/users/{id}/restore', [UserController::class, 'restore'])->name('admin.users.restore')->where('id', '[0-9]+');
Route::patch('/users/{id}/delete', [UserController::class, 'delete'])->name('admin.users.delete')->where('id', '[0-9]+');
Route::resource('users', UserController::class)->names('admin.users');

Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('admin.categories.trash');
Route::get('/categories/{id}/restore', [CategoryController::class, 'restore'])->name('admin.categories.restore')->where('id', '[0-9]+');
Route::patch('/categories/{id}/delete', [CategoryController::class, 'delete'])->name('admin.categories.delete')->where('id', '[0-9]+');
Route::resource('categories', CategoryController::class)->names('admin.categories');


Route::get('/tags/trash', [TagController::class, 'trash'])->name('admin.tags.trash');
Route::get('/tags/{id}/restore', [TagController::class, 'restore'])->name('admin.tags.restore')->where('id', '[0-9]+');
Route::patch('/tags/{id}/delete', [TagController::class, 'delete'])->name('admin.tags.delete')->where('id', '[0-9]+');
Route::resource('tags', TagController::class)->names('admin.tags');


Route::get('/posts/trash', [PostController::class, 'trash'])->name('admin.posts.trash');
Route::get('/posts/{id}/restore', [PostController::class, 'restore'])->name('admin.posts.restore')->where('id', '[0-9]+');
Route::patch('/posts/{id}/delete', [PostController::class, 'delete'])->name('admin.posts.delete')->where('id', '[0-9]+');
Route::resource('posts', PostController::class)->names('admin.posts');