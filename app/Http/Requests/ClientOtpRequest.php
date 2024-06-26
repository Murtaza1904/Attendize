<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientOtpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'otp' => ['required', 'string', 'max:6', 'exists:clients,otp'],
        ];
    }

    public function attributes()
    {
        return [
            'opt' => 'verification code',
        ];
    }
}
