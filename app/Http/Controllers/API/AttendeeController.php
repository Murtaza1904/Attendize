<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Models\Attendee;
use Illuminate\Http\JsonResponse;

class AttendeeController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'attendees' => AttendeeResource::collection(Attendee::orderBy('first_name')->get()),
        ]);
    }
}
