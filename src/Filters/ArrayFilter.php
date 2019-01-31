<?php

namespace Abstractrs\Form\Request\Filters;

use Illuminate\Support\Facades\Hash;
use Abstractrs\Form\Request\Filters\Contracts\Filter;

class ArrayFilter implements Filter
{
    public function filter($value, $name, $filtersArr, $filterName = '')
    {
        if ($value == null) return [];
        if (!is_array($value)) $value = [$value];
        $subFilters = explode(",", explode(":", $filterName)[1]);
        foreach ($value as $k => $v) {
            foreach ($subFilters as $filter) {
                $filterClass = config('filters.aliases.' . $filter);
                $filterInstance = app($filterClass);
                $value[$k] = $filterInstance->filter($v, $filter);
            }
        }
        return $value;
    }
}
