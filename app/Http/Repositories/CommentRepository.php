<?php


namespace App\Http\Repositories;

use App\Models\Comments as Model;
use Illuminate\Support\Facades\Auth;
use Itstructure\GridView\DataProviders\EloquentDataProvider;

class CommentRepository extends CoreRepository
{

    public function getModelClass(): string
    {
        return Model::class;
    }

    public function getAllCommentsGridTable():EloquentDataProvider
    {
        $query = Model::select(['id','user_id','post_id','content','created_at','updated_at'])
            ->where(['user_id'=>Auth::user()->id])
            ->with(['posts' => function ($query) {
                  return $query->select(['name','id']);
            }]);
        return new EloquentDataProvider($query);
    }
}
