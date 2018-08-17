<?php

namespace Abstractrs\Form\Request\Filters;

use Abstractrs\Form\Request\Filters\Contracts\Filter;

class ToAbsFilter implements Filter
{
    public function filter($value)
    {
        return abs($value);
    }
}