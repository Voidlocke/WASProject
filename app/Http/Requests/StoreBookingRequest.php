<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // controller/policy already protects booking creation
    }

    public function rules(): array
    {
        return [
            'room_id' => ['required', 'string', 'max:8', 'exists:rooms,room_id'],
        ];
    }
}
