<?php

namespace App\Filters;

interface FilterInterface
{
    public function getName() : string;

    public function getDescription() : string;

    /**
     * @param string $string
     * @return bool True if clean, false if spam detected
     */
    public function passes() : bool;

    public function getErrorMessage() : string;
}