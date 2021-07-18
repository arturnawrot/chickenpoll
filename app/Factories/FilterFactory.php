<?php

namespace App\Factories;

use App\Exceptions\FilterDoesNotExist;

class FilterFactory
{
    public function make(string $filterName)
    {
        $availableFilters = config('filters');

        foreach($availableFilters as $filter) {
            if($filetrName === $filter->getName()) {
                return $filter;
            }
        }

        throw new FilterDoesNotExist($filterName);
    }
}