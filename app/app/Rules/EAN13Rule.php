<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EAN13Rule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {
        if (strlen($value) !== 13) {
            return false;
        }
        $checkreal = null;
        $sum = 0;
        for ($i = 0; $i < 13; $i++) {
            if ($i == 12) {
                $checkreal = $value[$i];
            } else {
                $sum += (int)$value[$i] * ($i % 2 === 0 ? 1 : 3);
            }
        }
        $checksum = (10 - ($sum % 10)) % 10;

        if (is_null($checkreal) || $checksum != $checkreal) return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message() {
        return "The :attribute must have the EAN-13 format.";
    }
}
