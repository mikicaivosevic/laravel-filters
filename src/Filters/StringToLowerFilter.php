<?php

namespace Abstractrs\Form\Request\Filters;

use Abstractrs\Form\Request\Filters\Contracts\Filter;

class StringToLowerFilter implements Filter
{
    public function filter($value, $filterName = '')
    {
        return mb_strtolower($value);
    }
}
