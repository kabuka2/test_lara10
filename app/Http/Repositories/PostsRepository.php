<?php


namespace App\Http\Repositories;
use App\Models\Posts as Model;

class PostsRepository extends CoreRepository
{
    public function getModelClass(): string
    {
        return Model::class;
    }




}
