<?php


namespace App\Http\Repositories;

use App\Models\User as Model;

class ProfileRepository extends CoreRepository
{

    public function getModelClass(): string
    {
       return Model::class;
    }
    /**
     * @param int $user_id *
     * @return Model
     */
    public function getProfileUserById(int $user_id):Model
    {
       $user = $this->startCondition()::find($user_id);
       return $user;
    }





}
