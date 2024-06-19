<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AttendeeCheckInQrcodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'attendee_reference' => ['required', 'string', 'exists:attendees,private_reference_number'],
        ];
    }
}
