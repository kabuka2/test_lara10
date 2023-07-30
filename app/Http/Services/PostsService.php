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
     * @param int $id_post
     */
    public function getPostAndCommentsById(int $id_post)
    {
        return $this->repository->getAllPostsAndComments($id_post);
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
