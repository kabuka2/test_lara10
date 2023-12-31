<?php


namespace App\Http\Repositories;

use App\Models\Comments as Model;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Itstructure\GridView\DataProviders\EloquentDataProvider;

class CommentRepository extends CoreRepository
{

    public function getModelClass(): string
    {
        return Model::class;
    }

    public function getAllCommentsGridTable():EloquentDataProvider
    {
        $query = $this->startCondition()::select([
            'id',
            'user_id',
            'post_id',
            'content',
            'created_at',
            'updated_at',
        ])
        ->where(['user_id'=>Auth::user()->id]);
//        ->with(['posts' => function ($query) {
//              return $query->select(['name','id']);
//        }]);
        return new EloquentDataProvider($query);
    }

    /**
     * @param int $id_comments *
     * @return Model|null
     */
    public function getModelById(int $id_comments):Model|null
    {
        return $this->startCondition()::find($id_comments);
    }

    public function updateById($data)
    {
        $model = $this->getModelById($data->id);
        if (empty($model)){
            throw new \Exception('Undefined comment');
        }

        $model->content = $data->content;
        $model->save();
    }

    /**
     * @param int $post_id
     * @param string $message
     * @param int $parent_comment_id
     * @return array | Exception
    **/
    public function createComment(int $post_id, string $message, int $parent_comment_id = 0):array|Exception
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $model = $this->startCondition();
            $model->parent_id = !empty($parent_comment_id) ? $parent_comment_id : null;
            $model->user_id = $user->id;
            $model->post_id = $post_id;
            $model->content = $message;
            $model->save();

            DB::commit();
            return [
                'comment_id'=> $model->id,
                'post_id'=>$post_id,
                'parent_id'=>$parent_comment_id,
                'message'=>$message
            ];
        } catch (QueryException $e){
            DB::rollback();
            throw new \Exception($e->getMessage(), 1);
        }
    }

}
