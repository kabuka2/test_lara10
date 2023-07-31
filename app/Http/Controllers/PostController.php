<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PostsService;
use App\Http\Requests\ShowFromUserPageRequest;
use App\Http\Requests\PostCreateRequest;
use Illuminate\Support\Facades\Redirect;

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

       return view('post_list',['dataProvider'=> $dataProvider]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post');
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
            )->with('success', 'Item saved successfully.');

        } catch (\Exception){
            return view('post')->withErrors(['error' => 'Failed to save the item. Please try again.']);
        }

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
        $post = current($this->service->getPostAndCommentsById($id));

        return view('post_page', ['post' => current($post)]);

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
    public function destroy(ShowFromUserPageRequest $request)
    {
        $id = $request->id;
        $this->service->softDelete($id);
        return redirect('post-list');
    }
}
