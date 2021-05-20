<?php

use App\Http\Controllers\FollowsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;
use App\Mail\NewUserWelcome;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('email/', function () {
    return new NewUserWelcome();
});
Route::post('/follow/{user}', [FollowsController::class, 'store']); // for followers

Route::get('/', [PostsController::class, 'index']);
Route::post('/posts', [PostsController::class, 'store']);
Route::post('/posts/{post}', [PostsController::class, 'show']);
Route::resource('/posts', PostsController::class);
Route::put('/profile/{user}', [ProfilesController::class, 'update'])->name('profile.update');
Route::get('/profile/{user}/', [ProfilesController::class, 'profile'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfilesController::class, 'edit'])->name('profile.edit');
