<?php

namespace Abstractrs\Form\Request\Filters\Contracts;

interface Filter
{
    public function filter($value, $name, $filtersArr, $filterName);
}
