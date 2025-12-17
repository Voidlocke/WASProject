<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'card_name' => strtoupper((string) $this->card_name),
            'card_number' => preg_replace('/\D/', '', (string) $this->card_number),
            'expiry_date' => trim((string) $this->expiry_date),
        ]);
    }


    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'card_name'   => ['required', "regex:/^[A-Za-z\s'\-]+$/"],
            'card_number' => ['required', 'digits:16'],
            'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'ccv'         => ['required', 'digits:3'],
        ];
    }
}
