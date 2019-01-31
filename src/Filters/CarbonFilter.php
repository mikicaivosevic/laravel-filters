<?php

namespace Abstractrs\Form\Request\Filters;

use Abstractrs\Form\Request\Filters\Contracts\Filter;
use Illuminate\Support\Carbon;

class CarbonFilter implements Filter
{

    public function filter($value, $name, $filtersArr, $filterName = '')
    {
        $parsedValue = explode(',', $value, 2);
        $dateFormat = isset($parsedValue[1]) ? $parsedValue[1] : config('filters.date_format');
        $date = $parsedValue[0];
        return Carbon::createFromFormat($dateFormat, $date);
    }
}