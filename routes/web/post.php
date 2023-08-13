<?php

use App\Http\Controllers\PostsApiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function(){
    Route::get('/posts_api/{id}', [PostController::class, 'show'])->name('post.user.show');

    Route::get('/posts_api', [PostsApiController::class, 'index'])->name('post_api.user.show');
});


Route::middleware('auth')->group(function () {
    Route::get('/post-list', 'PostController@index')->name('post_list');
    Route::match(['delete','get'],'/post-delete/{id}', 'PostController@destroy')->name('post_delete');
    Route::get('/posts-create', 'PostController@create')->name('posts.create');
    Route::put('/posts-add', 'PostController@store')->name('posts.store');
    Route::get('/posts-edit/{id}', 'PostController@edit')->name('posts.edit');
    Route::patch('/posts-update/{id}', 'PostController@update')->name('posts.update');
});


