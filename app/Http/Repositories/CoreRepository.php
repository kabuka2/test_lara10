<?php


namespace App\Http\Repositories;
use Illuminate\Database\Eloquent\Model;

abstract class CoreRepository
{
    private $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    public abstract function getModelClass():string;

    protected function startCondition()
    {
        return clone $this->model;
    }

}
