<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateComment;
use Illuminate\Http\Request;
use App\Http\Services\CommentService;
use App\Http\Requests\CommentsUpdateRequest;
use \Exception;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    private CommentService $service;

    public function __construct()
    {
        $this->service = new CommentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataProvider = $this->service->getAllCommentsGrid();
        return view('comments.comments_list',compact('dataProvider'));
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
    public function store(CreateComment $request)
    {
        $data = $request;
        $result = $this->service->createComment($data);

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $data = $this->service->getCommentsById((int)$request->id);

        if (empty($data)) {
            abort(404);
        }

        return view('comments.comments_edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentsUpdateRequest $request)
    {
      $data = $request;
      try {
          $this->service->updateById($data);
        return  Redirect::route('comments.edit',['id'=> $data->id])->with('success','Success');
      } catch (Exception $e){
         return Redirect::route('comments.edit',['id'=> $data->id])->with('warning',$e->getMessage());
      }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
