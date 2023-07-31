<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'posts';

    const NUMBER_RECORDS_ONE_PAGE = 15;

    public function comments()
    {
        return $this->hasMany(Comments::class, 'post_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getDeletedAtColumn()
    {
        return 'deleted_at';
    }

    public function getStatusColumn()
    {
        return 'status';
    }

}
