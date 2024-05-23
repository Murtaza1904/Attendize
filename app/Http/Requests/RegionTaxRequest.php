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
            'region' => ['required', 'string', 'max:191'],
            'tax_type' => ['required', 'string', 'in:fixed,percentage'],
            'tax' => ['required', 'numeric'],
            'payment_gateway' => ['required', 'string', 'in: stripe-ca,stripe-usa'],
        ];
    }
}
