<?php

namespace App\Exceptions;

use Exception;

class FilterDoesNotExist extends Exception
{
    public function __construct($filterName)
    {
        parent::__construct(sprintf('"%s" does not exist.', $filterName));
    }
}
