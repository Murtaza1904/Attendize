<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefundPolicyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_checkbox_text' => ['required', 'string'],
            'second_checkbox_text' => ['required', 'string'],
        ];
    }
}
