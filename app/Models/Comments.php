<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'comments';

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
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
