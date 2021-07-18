<?php

namespace App\Filters;

use App\Filters\Spam\FilterInterface;

class LinkFilter implements FilterInterface
{
    public function passes(string $string)
    {
        return false;
    }
}