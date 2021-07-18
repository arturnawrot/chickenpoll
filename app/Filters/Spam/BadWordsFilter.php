<?php

namespace App\Filters;

use App\Filters\Spam\FilterInterface;

class BadWordsFilter implements FilterInterface
{
    public function passes(string $string)
    {
        return true;
    }
}