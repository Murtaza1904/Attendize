<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AttendeeCheckInRequest;
use App\Http\Resources\AttendeeResource;

class AttendeeController extends Controller
{
    public function index(Event $event): JsonResponse
    {
        return response()->json([
            'attendees' => AttendeeResource::collection($event->attendees()->orderBy('first_name')->get()),
        ]);
    }

    public function update(AttendeeCheckInRequest $request): JsonResponse
    {
        $attendee_id = $request->get('attendee_id');
        $checking = $request->get('checking');

        $attendee = Attendee::scope()->find($attendee_id);

        if ((($checking == 'in') && ($attendee->has_arrived == 1)) || (($checking == 'out') && ($attendee->has_arrived == 0))) {
            return response()->json([
                'message' => 'Attendee Already Checked ' . (($checking == 'in') ? 'In (at ' . $attendee->arrival_time->format('H:i A, F j') . ')' : 'Out') . '!',
            ], 422);
        }

        $attendee->has_arrived = ($checking == 'in') ? 1 : 0;
        $attendee->arrival_time = Carbon::now();
        $attendee->save();

        return response()->json([
            'message' =>  (($checking == 'in') ? 'Attendee successfully checked in' : 'attendee successfully checked out'),
        ]);
    }
}
