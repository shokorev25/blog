<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;


Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::resource('posts', PostController::class);


Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');

Route::resource('posts', PostController::class);
Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');
Route::post('comments/{comment}/reject', [CommentController::class, 'reject'])->name('comments.reject');
Route::post('posts/{post}/toggle-publish', [PostController::class, 'togglePublish'])->name('posts.toggle-publish');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
