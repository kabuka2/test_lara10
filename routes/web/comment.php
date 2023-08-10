<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

Route::middleware('auth')->group(function () {

    Route::get('/comment-list', 'CommentController@index')->name('comment.list');
    Route::get('/comments-edit/{id}','CommentController@edit')->name('comments.edit');
    Route::patch('/comments-update/{id}', 'CommentController@update')->name('comments.update');
    Route::put('/comment-create','CommentController@store')->name('comment_create');

});
