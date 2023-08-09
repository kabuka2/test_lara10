<?php


namespace App\Http\Services;

use App\Http\Repositories\CommentRepository;
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
            $this->error(0,$e->getMessage());
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
            0 => ['code' => 400, 'message'=> 'Undefined Error']
        ];
    }
}
