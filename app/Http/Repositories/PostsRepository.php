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
            ->with('comments')
            ->paginate(Model::NUMBER_RECORDS_ONE_PAGE);

//        $posts->getCollection()->transform(function ($post) {
//            $post->comments = $this->buildCommentTree($post->comments);
//            return $post;
//        });

        return $posts;
    }

    private function buildCommentTree($comments, $parentId = null)
    {
        $branch = [];

        foreach ($comments as $comment) {
            if ($comment->parent_id === $parentId) {
                $comment->children = $this->buildCommentTree($comments, $comment->id);
                $branch[] = $comment;
            }
        }

        return $branch;
    }






}
