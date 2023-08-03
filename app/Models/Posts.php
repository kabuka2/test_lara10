<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Filterable;

class Posts extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $table = 'posts';

    const NUMBER_RECORDS_ONE_PAGE = 10;

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
