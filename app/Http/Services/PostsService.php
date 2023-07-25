<?php


namespace App\Http\Services;
use App\Http\Repositories\PostsRepository;


class PostsService extends CoreService
{
    private PostsService $repository;

    public function __construct()
    {
        $this->repository = new PostsRepository();
    }

    public function getAllPosts()
    {

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
