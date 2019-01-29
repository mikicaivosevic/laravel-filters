<?php

namespace Abstractrs\Form\Request\Filters;

use Abstractrs\Form\Request\Filters\Contracts\Filter;

class ToIntFilter implements Filter
{
    public function filter($value, $name, $filterName = '')
    {
        if (! is_scalar($value)) {return $value;}
        $value = (string) $value;
        return (int) $value;
    }
}