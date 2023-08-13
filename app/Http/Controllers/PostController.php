<?php

namespace App\Http\Controllers;

use App\Http\Services\PostsService;
use App\Http\Requests\ShowFromUserPageRequest;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;

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
       $dataProvider = $this->service->getAllPostGrid();
       return view('posts.post_list',['dataProvider'=> $dataProvider]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.post');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request;
        try {
            $res =  $this->service->savePost($data);
            return redirect()->route(
                'post.user.show',
                [
                    'id' => $res['id']
                ]
            )->with('success','Item saved successfully.');
        } catch (\Exception $exception){
            return redirect()->route(('posts.create')->with('danger', $exception->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowFromUserPageRequest $request)
    {
        $id = (int)$request->id;
        $post = current($this->service->getPostAndCommentsById($id));

        return view('posts.post_page', ['post' => current($post)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $id_post = $id;
        $item = $this->service->edit($id_post);
        if(!$item){
            abort(404);
        }
        return view('posts.post',  compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, int $id)
    {
        $data = $request;

        try {
            $res = $this->service->update($id,$data);

            return redirect()->route(
                'post.user.show',
                [
                    'id' => $res['id']
                ]
            )->with('success', 'Item saved successfully.');

        } catch (\Exception){
            return view('post')->withErrors(['error' => 'Failed to save the item. Please try again.']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShowFromUserPageRequest $request)
    {
        $id = (int)$request->id;
        $this->service->softDelete($id);
        return redirect('post-list');
    }
}
