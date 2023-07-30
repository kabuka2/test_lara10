<?php


namespace App\Http\Repositories;
use App\Models\Comments;
use App\Models\Posts as Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PostsRepository extends CoreRepository
{
    public function getModelClass(): string
    {
        return Model::class;
    }

    public function getAllPostsPagination():LengthAwarePaginator
    {
        $posts = Model::where('status', Model::STATUS_POST_ACTIVE)
            ->select(['id','user_id','name','image','body','created_at','updated_at'])
            ->withCount('comments')
            ->with(['user'=> function($query){
                $query->select(['name','id']);
            }])
            ->paginate(Model::NUMBER_RECORDS_ONE_PAGE);
        return $posts;
    }


    /**
     * @param $post_id
     * @return LengthAwarePaginator
    **/
    public function getAllPostsAndComments(int $post_id):LengthAwarePaginator
    {
        $posts = Model::where('status', Model::STATUS_POST_ACTIVE)
            ->select([
                'posts.id',
                'posts.user_id',
                'posts.name',
                'posts.image',
                'posts.body',
                'posts.created_at',
                'posts.updated_at'
            ])
            ->where(['posts.id' => $post_id])
            ->with(['comments' => function ($query) {
                $query->with(['user'=>function($query){
                    $query->select(['name','id']);
                }]);
            }])
            ->with(['user'=> function($query){
                $query->select(['name','id']);
            }])->limit(1)->get();


        $posts->transform(function ($post) {
            $post->comments = $this->buildCommentTree($post->comments);
            return $post;
        });
        echo '<pre>';

        dd($posts->toArray());

        echo '</pre>';
        exit();


        return $posts;
    }

    private function buildCommentTree($comments, $parentId = null)
    {
        $branch = [];

        foreach ($comments as $key_comment => $comment_value) {
            if ($comment_value->parent_id === $parentId) {

                $comment_value->children = $this->buildCommentTree($comments, $comment_value->id);
                $branch[] = $comment_value;

            }

        }

        return $branch;
    }






}
