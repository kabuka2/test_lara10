<?php

namespace App\Traits;

use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
trait Filterable
{

    public function scopeFilter(Builder $builder,  $filter)
    {

        $filter->apply($builder);
    }
}
