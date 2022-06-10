<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SameSizeRule implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct(protected string $field_name)
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $other_field_value = request()->get($this->field_name);

        return is_array($other_field_value) && count($value) == count($other_field_value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Both fields :attribute1 and :attribute2 must have same length';
    }
}
