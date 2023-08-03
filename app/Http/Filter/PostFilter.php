<?php

namespace App\Http\Filter;

use Illuminate\Database\Eloquent\Builder;

class PostFilter extends Filter
{

    /**
     * @param string $name
    **/
    public function name(string $name = ''):Builder|null
    {
        if (!empty($name)) {
            return $this->builder->where('name', 'REGEXP', $name);
        }
        return $this->builder;
    }


}
