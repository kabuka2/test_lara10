<?php


namespace App\Http\Services;

use App\Http\Repositories\ProfileRepository;
use App\Models\User;
use Illuminate\Cache\Repository;

class ProfileService extends CoreService
{
    private ProfileRepository $repository;

    public function __construct()
    {
        $this->repository = new ProfileRepository;
    }

    /**
     * @param int $user_id
     * @return User
    **/
    public function getProfileUserById(int $user_id):User
    {

        $user = $this->repository->getProfileUserById($user_id);
        return $user;
    }

    protected function errors(): array
    {
       return [];
    }
}
