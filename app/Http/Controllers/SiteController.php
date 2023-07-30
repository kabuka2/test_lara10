<?php

namespace App\Http\Controllers;

use App\Http\Services\PostsService;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function __invoke()
    {
        $posts = (new PostsService())->getAllPostsPagination();

        return view('welcome', ['data' => $posts]);
    }


}
