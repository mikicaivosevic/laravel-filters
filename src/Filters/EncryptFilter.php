<?php

namespace Abstractrs\Form\Request\Filters;

use Abstractrs\Form\Request\Filters\Contracts\Filter;

class EncryptFilter implements Filter
{

    public function filter($value)
    {
        try {
            return \Crypt::encrypt($value);
        }catch (\Exception $e) {
            return $value;
        }
    }
}
