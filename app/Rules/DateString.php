<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DateString implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(){}

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return strtotime($value) >= strtotime('14-06-1928');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La fecha tiene que ser posterior al 14 de junio de 1928';
    }
}
