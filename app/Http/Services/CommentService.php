<?php


namespace App\Http\Services;

use App\Http\Repositories\CommentRepository;
use App\Http\Requests\CreateComment;
use App\Models\Comments;

class CommentService extends CoreService
{
    private CommentRepository $repository;

    public function __construct()
    {
        $this->repository = new CommentRepository;
    }

    public function getAllCommentsGrid()
    {
        return $this->repository->getAllCommentsGridTable();
    }

    public function updateById($data)
    {
        try{
            $this->repository->updateById($data);
        } catch (\Exception $e){
            $this->error(0);
        }
    }

    /**@param CreateComment $data - [
        "post_id" => "1"
        "parent_comment_id" => null
        "message" => "sfsdfsdfsdfsdfsdfsdfsdfsdfsdf"
     * ]
    **/
    public function createComment(CreateComment $data):array|\Exception
    {
        try {
           $create_comment =  $this->repository->createComment(
                (int)$data->input('post_id'),
                $data->input('message'),
                $data->input('parent_comment_id') ?? 0
            );
            return ['id'=> $create_comment];
        } catch (\Exception $e) {
            $this->error(1);
        }

    }

    /**
     * @param int $id_comment *
     * @return Comments|null
    **/
    public function getCommentsById(int $id_comment):Comments|null
    {
        return $this->repository->getModelById($id_comment);
    }


    protected function errors(): array
    {
        return[
            0 => ['code' => 400, 'message'=> 'Undefined Error'],
            1 => ['code' => 400, 'message'=> 'Error Save'],
        ];
    }
}
