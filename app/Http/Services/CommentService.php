<?php


namespace App\Http\Services;

use App\Http\Repositories\CommentRepository;

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



    protected function errors(): array
    {
        return[
            0 => ['code' => 400, 'message'=> 'Undefined Error']
        ];
    }
}
