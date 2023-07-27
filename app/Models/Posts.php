<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';

    const STATUS_POST_ACTIVE = 1;
    const STATUS_POST_DEACTIVATED = 1;
    const NUMBER_RECORDS_ONE_PAGE = 15;

    public function comments()
    {
        return $this->hasMany(Comments::class, 'post_id', 'id');
    }

}
