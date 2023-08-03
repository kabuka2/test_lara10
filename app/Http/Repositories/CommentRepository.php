<?php


namespace App\Http\Repositories;

use App\Models\Comments as Model;

class CommentRepository extends CoreRepository
{

    public function getModelClass(): string
    {
        return Model::class;
    }

    public function getAllCommentsGridTable():EloquentDataProvider
    {
        return new EloquentDataProvider($this->startCondition()::query());
    }
}
