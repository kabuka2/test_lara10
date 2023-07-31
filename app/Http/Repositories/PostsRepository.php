<?php


namespace App\Http\Repositories;
use App\Models\Comments;
use App\Models\Posts as Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Itstructure\GridView\DataProviders\EloquentDataProvider;

class PostsRepository extends CoreRepository
{
    public function getModelClass(): string
    {
        return Model::class;
    }

    public function getAllPostsPagination():LengthAwarePaginator
    {
        $posts = Model::select(['id','user_id','name','image','body','created_at','updated_at'])
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
    public function getAllPostsAndComments(int $post_id):Collection
    {
        $posts = Model::select([
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
            $posts = $this->buildCommentTree($post->comments);
            $post->comments = array_filter($posts,function ($data){
                return is_null($data->patent_id);
            });
            return $post;
        });

        return $posts;
    }

    private function buildCommentTree($comments, $parentId = null)
    {
        $branch = [];

        foreach ($comments as $comment_value) {
            if ($comment_value->parent_id === $parentId) {

                $comment_value->children = $this->buildCommentTree($comments, $comment_value->id);
                $branch[] = $comment_value;

            }
        }

        return $branch;
    }

    public function getAllPostGridTable():EloquentDataProvider
    {
        return new EloquentDataProvider($this->startCondition()::query());
    }

    public function softDeleteRecords(int $id)
    {

       $post = $this->startCondition()::find($id);
       $post->comments()->delete();
       $post->delete();
    }






}
