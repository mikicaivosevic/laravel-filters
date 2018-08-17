<?php

namespace Abstractrs\Form\Request\Filters;

use Abstractrs\Form\Request\Filters\Contracts\Filter;

class ToNullFilter implements Filter
{
    public function filter($value, $filterName = '')
    {
        return null;
    }
}