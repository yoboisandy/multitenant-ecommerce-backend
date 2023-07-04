<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Base64Image implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // check either value is base64 or url if itsn't both then fail

        if (!preg_match('/^data:image\/(\w+);base64,/', $value) && !filter_var($value, FILTER_VALIDATE_URL)) {
            $fail("The $attribute must be a base64 image. Or a valid url.");
        }
    }
}
