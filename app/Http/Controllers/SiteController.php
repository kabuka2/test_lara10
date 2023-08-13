<?php

namespace App\Http\Controllers;

use App\Http\Services\PostsService;
use App\Http\Filter\PostFilter;


class SiteController extends Controller
{

    public function __invoke(PostFilter $request)
    {
        $posts = (new PostsService())->getAllPostsPagination($request);

        return view('posts.welcome', ['data' => $posts]);
    }

}
