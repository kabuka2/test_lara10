<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

Route::middleware('auth')->group(function () {

    Route::get('/comment-list', 'CommentController@index')->name('comment.list');



});
