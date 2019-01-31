<?php

namespace Abstractrs\Form\Request\Filters;

use Illuminate\Support\Facades\Hash;
use Abstractrs\Form\Request\Filters\Contracts\Filter;

class HashFilter implements Filter
{
    public function filter($value, $name, $filtersArr, $filterName = '')
    {
        if (empty($value)) return '';
        return Hash::make($value);
    }
}
