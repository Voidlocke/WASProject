<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'card_name'   => ['required', 'string', 'max:50'],
            'card_number' => ['required', 'digits_between:13,19'],
            'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'ccv'         => ['required', 'digits:3'],
        ];
    }
}
