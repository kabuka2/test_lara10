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
            $escapedName = preg_quote($name, '/');
            return $this->builder->where('name', 'REGEXP', $escapedName);
        }
        return $this->builder;
    }


}
