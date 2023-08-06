<?php


namespace App\Http\Services;

use App\Http\Repositories\PostsRepository;
use App\Models\Posts;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\PostCreateRequest;


class PostsService extends CoreService
{
    private PostsRepository $repository;

    public function __construct()
    {
        $this->repository = new PostsRepository();
    }

    public function getAllPostGrid()
    {
       return $this->repository->getAllPostGridTable();
    }

    public function getAllPostsPagination($search):LengthAwarePaginator
    {
       return $this->repository->getAllPostsPagination($search);
    }

    /**
     * @param int $id_post
     */
    public function getPostAndCommentsById(int $id_post)
    {
        return $this->repository->getAllPostsAndComments($id_post);
    }

    public function softDelete(int $id)
    {
        try {
            $res_delete = $this->repository->softDeleteRecords($id);
        } catch (\Exception $e) {
            $this->error(0,$e->getMessage());
        }
    }
    /**@param PostCreateRequest $data * */
    public function savePost(PostCreateRequest $data):array
    {
        try {
           $result =  $this->repository->createNewRecords($data);
           return ['id'=> $result];
        } catch (\Exception $e){
            $this->error(1);
        }

    }

    /**
     * @param int $id_post
     * @return Posts|null
    **/
    public function edit(int $id_post):Posts|null
    {
        return $this->repository->getModelById($id_post);
    }

    /**
     * @param int $post_id
     * @param PostCreateRequest $data
     */
    public function update(int $post_id, PostCreateRequest $data)
    {

        try {
            $result = $this->repository->updatePost($post_id,$data);
            return ['id'=> $result];
        } catch (\Exception $e){
            $this->error(1);
        }

    }



    /**
     * @inheritDoc
     */
    protected function errors(): array
    {
        return [
            0 => ['code' => 400, 'message'=> 'Undefined error'],
            1 => ['code' => 400, 'message'=> 'Error save'],
        ];
    }
}
