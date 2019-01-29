<?php

namespace Abstractrs\Form\Request\Filters;

use Abstractrs\Form\Request\Filters\Contracts\Filter;

class StringToUpperFilter implements Filter
{
    public function filter($value, $name, $filterName = '')
    {
        return mb_strtoupper($value);
    }
}
