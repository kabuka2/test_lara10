<?php


namespace App\Http\Repositories;
use App\Models\Comments as Model;

class CommentsRepository extends CoreRepository
{
    public function getModelClass(): string
    {
       return Model::class;
    }
}
