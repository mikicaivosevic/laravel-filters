<?php

namespace Abstractrs\Form\Request\Filters;

use Abstractrs\Form\Request\Filters\Contracts\Filter;

class ToArrayFilter implements Filter
{
    public function filter($value)
    {
        if ($value == null) return [];
        if (is_array($value)) return $value;

        return [$value];
    }
}