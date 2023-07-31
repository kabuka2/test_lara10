<?php


namespace App\Http\Repositories;
use App\Models\User as Model;
use Itstructure\GridView\DataProviders\EloquentDataProvider;

class UsersRepository extends CoreRepository
{

    public function getModelClass(): string
    {
       return Model::class;
    }

    public function getGridTable():EloquentDataProvider
    {
        return new EloquentDataProvider($this->startCondition()::query());
    }

}
