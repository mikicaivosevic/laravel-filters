<?php

namespace Abstractrs\Form\Request\Filters;

use Illuminate\Support\Facades\Hash;
use Abstractrs\Form\Request\Filters\Contracts\Filter;

class ArrayFilter implements Filter
{
    public function filter($value, $filterName = '')
    {
        $subFilters = explode(",", explode(":", $filterName)[1]);
        foreach ($subFilters as $filter) {
            $filterClass = config('filters.aliases.' . $filter);
            $filterInstance = app($filterClass);
            $value = $filterInstance->filter($value, $filter);
        }
        return $value;
    }
}
