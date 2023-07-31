<?php


namespace App\Http\Services;
use App\Http\Repositories\UsersRepository;

class UsersService extends CoreService
{
    private UsersRepository $repository;

    public function __construct()
    {
        $this->repository = new UsersRepository();
    }

    /**
     * @param $request
    **/
    public function getGridTableUsers()
    {
        $dataProvider = $this->repository->getGridTable();
        return $dataProvider;
    }


    protected function errors(): array
    {
        return [];
    }
}
