<?php

namespace Fateme\User\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class validPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{6,}$/", $value)) {
            $fail('فرمت پسورد نامعتبر است');
        }
    }

}

