<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Services\SpamDetector;

class ContentFilter implements Rule
{
    private $spamDetector;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(SpamDetector $spamDetector)
    {
        $this->spamDetector = $spamDetector;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !$this->spamDetector->detect($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}