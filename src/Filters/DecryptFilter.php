<?php

namespace Abstractrs\Form\Request\Filters;

use Abstractrs\Form\Request\Filters\Contracts\Filter;
use Illuminate\Support\Facades\Crypt;

class DecryptFilter implements Filter
{
    public function filter($value, $name, $filtersArr, $filterName = '')
    {
        return Crypt::decrypt($value);
    }
}
