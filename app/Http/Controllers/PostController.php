<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PostsService;
use App\Http\Requests\ShowFromUserPageRequest;

class PostController extends Controller
{
    private PostsService $service;

    public function __construct()
    {
        $this->service = new PostsService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data = $this->service->getAllPosts();

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

    public function showFromUserPage(ShowFromUserPageRequest $request)
    {

        $id = $request->id;
        $res = $this->service->getPostAndCommentsById($id);

        dd($res);

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
