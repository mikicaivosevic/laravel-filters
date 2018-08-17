<?php

namespace Abstractrs\Form\Request\Filters;

use Abstractrs\Form\Request\Filters\Contracts\Filter;

class ToBooleanFilter implements Filter
{
    public function filter($value, $filterName = '')
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}