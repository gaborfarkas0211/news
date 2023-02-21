<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxArrayCount implements ValidationRule
{
    private int $maxCount;

    public function __construct($maxCount)
    {
        $this->maxCount = $maxCount;
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (count($value) > $this->maxCount) {
            $fail("A maximum of {$this->maxCount} :attribute can be selected.");
        }
    }
}
