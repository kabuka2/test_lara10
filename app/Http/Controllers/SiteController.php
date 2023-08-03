<?php

namespace App\Http\Controllers;

use App\Http\Services\PostsService;
use App\Models\Posts;
use Illuminate\Http\Request;
use App\Http\Filter\PostFilter;

class SiteController extends Controller
{

    public function __invoke(PostFilter $request)
    {
        $posts = (new PostsService())->getAllPostsPagination($request);

        return view('welcome', ['data' => $posts]);
    }


}
