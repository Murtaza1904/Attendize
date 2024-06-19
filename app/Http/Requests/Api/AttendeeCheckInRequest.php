<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AttendeeCheckInRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'attendee_id' => ['required', 'numeric', 'exists:attendees,id'],
            'checking' => ['required', 'string', 'in:in,out'],
        ];
    }
}
