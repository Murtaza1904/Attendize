<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionTaxRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'region' => ['required', 'string', 'max:255'],
            'tax' => ['required', 'numeric', 'digits_between:1,8'],
        ];
    }
}
