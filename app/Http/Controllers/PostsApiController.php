<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Services\PostsService;



class PostsApiController extends Controller
{

    private PostsService $service;

    public function __construct()
    {
        $this->service = new PostsService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = (int)$request->page ?? 1;
        $res = $this->service->getPostsToApi($page);

        return view('posts.posts_api.all_posts_page',['data'=> $res]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
