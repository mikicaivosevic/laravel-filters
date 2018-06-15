<?php

namespace Abstractrs\Form\Request\Filters;

use Abstractrs\Form\Request\Filters\Contracts\Filter;

class DecryptFilter implements Filter
{

    public function filter($value)
    {
        try {
            return \Crypt::decrypt($value);
        }catch (\Exception $e) {
            return $value;
        }
    }
}
