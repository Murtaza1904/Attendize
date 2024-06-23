<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AttendeeCheckInQrcodeRequest;
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

        if($attendee->ticket->number_of_person > 1) {
            if ($request->number_of_attendees > $attendee->ticket->number_of_person) {
                return response()->json([
                    'errors' => 'The number of attendees must not be greater than '. $request->number_of_attendees,
                ], 422);
            }
            if (empty($request->number_of_attendees)) {
                return response()->json([
                    'errors' => 'The number of attendees field is required.',
                ], 422);
            }
        }
        // if ((($checking == 'in') && ($attendee->has_arrived == 1)) || (($checking == 'out') && ($attendee->has_arrived == 0))) {
        //     return response()->json([
        //         'message' => 'Attendee Already Checked ' . (($checking == 'in') ? 'In (at ' . $attendee->arrival_time->format('H:i A, F j') . ')' : 'Out') . '!',
        //     ], 422);
        // }

        // $attendee->has_arrived = ($checking == 'in') ? 1 : 0;
        // $attendee->arrival_time = Carbon::now();

        // $attendee->has_arrived = 1;
        // $attendee->arrival_time = $attendee->arrival_time ?? Carbon::now();
        // $attendee->number_of_attendees = $request->number_of_attendees;
        // $attendee->number_of_children = $request->number_of_children;
        // $attendee->note = $request->note;
        // $attendee->save();

        $checking = $attendee->ticket->number_of_days == 1 ? 'in' : $checking;

        $attendee->has_arrived = $checking == 'in' ? 1 : 0;
        $attendee->arrival_time = $checking == 'out' ? null : ($attendee->arrival_time ?? Carbon::now());
        $attendee->number_of_attendees = $attendee->ticket->number_of_person > 1 ? $request->number_of_attendees : null;
        $attendee->number_of_children = $request->number_of_children;
        $attendee->note = $request->note;
        $attendee->save();

        return response()->json([
            'message' =>  (($checking == 'in') ? 'Attendee successfully checked in' : 'attendee successfully checked out'),
        ]);
    }

    public function updateUsingQrcode($event_id, AttendeeCheckInQrcodeRequest $request)
    {
        $event = Event::scope()->findOrFail($event_id);

        $qrcodeToken = $request->get('attendee_reference');
        $attendee = Attendee::scope()->withoutCancelled()
            ->join('tickets', 'tickets.id', '=', 'attendees.ticket_id')
            ->where(function ($query) use ($event, $qrcodeToken) {
                $query->where('attendees.event_id', $event->id)
                    ->where('attendees.private_reference_number', $qrcodeToken);
            })->select([
                'attendees.id',
                'attendees.order_id',
                'attendees.first_name',
                'attendees.last_name',
                'attendees.email',
                'attendees.reference_index',
                'attendees.arrival_time',
                'attendees.has_arrived',
                'tickets.title as ticket',
            ])->first();

        if (is_null($attendee)) {
            return response()->json([
                'message' => 'Invalid Ticket! Please try again',
            ], 422);
        }

        if ($attendee->has_arrived) {
            return response()->json([
                'message' => 'Attendee already checked in at '. $attendee->arrival_time->format(config("attendize.default_datetime_format")),
                'attendee_id' => $attendee->id,
            ], 422);
        }

        Attendee::find($attendee->id)->update(['has_arrived' => true, 'arrival_time' => Carbon::now()]);

        return response()->json([
            'message' =>  'Attendee successfully checked in',
            'attendee_id' => $attendee->id,
        ]);
    }
}
