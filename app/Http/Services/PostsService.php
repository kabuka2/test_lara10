<?php


namespace App\Http\Services;
use App\Http\Repositories\PostsRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class PostsService extends CoreService
{
    private PostsRepository $repository;

    public function __construct()
    {
        $this->repository = new PostsRepository();
    }

    public function getAllPostsPagination():LengthAwarePaginator
    {
       return $this->repository->getAllPostsPagination();
    }

    /**
     * @inheritDoc
     */
    protected function errors(): array
    {
        return [
            0 => ['code' => 1, 'message'=> 'Undefined error'],
        ];
    }
}
