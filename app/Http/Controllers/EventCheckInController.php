<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\Ticket;
use Carbon\Carbon;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use JavaScript;
use Validator;

class EventCheckInController extends MyBaseController
{
    public function showCheckIn($event_id): View
    {
        $event = Event::scope()->findOrFail($event_id);

        $data = [
            'event'     => $event,
            'attendees' => $event->attendees
        ];

        JavaScript::put([
            'qrcodeCheckInRoute' => route('postQRCodeCheckInAttendee', ['event_id' => $event->id]),
            'checkInRoute'       => route('postCheckInAttendee', ['event_id' => $event->id]),
            'checkInSearchRoute' => route('postCheckInSearch', ['event_id' => $event->id]),
        ]);

        return view('ManageEvent.CheckIn', $data);
    }

    public function getAttendeeTicket(Request $request)
    {
        return response()->json([
            'attendee' => Attendee::with('ticket')->where('id', $request->attendee_id)->first(),
        ]);
    }

    public function showQRCodeModal(Request $request, $event_id): View
    {
        return view('ManageEvent.Modals.QrcodeCheckIn');
    }

    public function postCheckInSearch(Request $request, $event_id)
    {
        $searchQuery = $request->get('q');

        $attendees = Attendee::scope()->withoutCancelled()
            ->join('tickets', 'tickets.id', '=', 'attendees.ticket_id')
            ->join('orders', 'orders.id', '=', 'attendees.order_id')
            ->where(function ($query) use ($event_id) {
                $query->where('attendees.event_id', '=', $event_id);
            })->where(function ($query) use ($searchQuery) {
                $query->orWhere('attendees.first_name', 'like', $searchQuery . '%')
                    ->orWhere(
                        DB::raw("CONCAT_WS(' ', attendees.first_name, attendees.last_name)"),
                        'like',
                        $searchQuery . '%'
                    )
                    //->orWhere('attendees.email', 'like', $searchQuery . '%')
                    ->orWhere('orders.order_reference', 'like', $searchQuery . '%')
                    ->orWhere('attendees.private_reference_number', 'like', $searchQuery . '%')
                    ->orWhere('attendees.last_name', 'like', $searchQuery . '%');
            })
            ->select([
                'attendees.id',
                'attendees.first_name',
                'attendees.last_name',
                'attendees.email',
                'attendees.arrival_time',
                'attendees.reference_index',
                'attendees.has_arrived',
                'tickets.title as ticket',
                'orders.order_reference',
                'orders.is_payment_received'
            ])
            ->orderBy('attendees.first_name', 'ASC')
            ->get();

        return response()->json($attendees);
    }

    public function postCheckInAttendee(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'attendee_id' => ['required', 'numeric'],
            'checking' => ['required', 'string', 'in:in,out'],
            'number_of_attendees' => ['nullable', 'numeric', 'digits_between:0,3'],
            'number_of_children' => ['nullable', 'numeric', 'digits_between:0,3'],
            'note'  => ['nullable', 'string'],
        ]);

        $attendee_id = $request->get('attendee_id');
        $checking = $request->get('checking');
        $attendee = Attendee::scope()->find($attendee_id);

        $validator->after(function ($validator) use ($attendee, $request) {
            if ($attendee->ticket->number_of_person > 1) {
                if ($request->number_of_attendees > $attendee->ticket->number_of_person) {
                    $validator->errors()->add('number_of_attendees', 'The number of attendees must not be greater than ' . $attendee->ticket->number_of_person);
                }
                if (empty($request->number_of_attendees)) {
                    $validator->errors()->add('number_of_attendees', 'The number of attendees field is required.');
                }
            }
        });

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }


        // if ((($checking == 'in') && ($attendee->has_arrived == 1)) || (($checking == 'out') && ($attendee->has_arrived == 0))) {
        //     return response()->json([
        //         'status'  => 'error',
        //         'message' => 'Attendee Already Checked ' . (($checking == 'in') ? 'In (at ' . $attendee->arrival_time->format('H:i A, F j') . ')' : 'Out') . '!',
        //         'checked' => $checking,
        //         'id'      => $attendee->id,
        //     ]);
        // }

        // $attendee->has_arrived = ($checking == 'in') ? 1 : 0;
        $attendee->has_arrived = 1;
        $attendee->arrival_time = $attendee->arrival_time ?? Carbon::now();
        $attendee->number_of_attendees = $request->number_of_attendees;
        $attendee->number_of_children = $request->number_of_children;
        $attendee->note = $request->note;
        $attendee->save();

        return response()->json([
            'status'  => 'success',
            'checked' => $checking,
            'message' =>  (($checking == 'in') ? trans("Controllers.attendee_successfully_checked_in") : trans("Controllers.attendee_successfully_checked_out")),
            'id'      => $attendee->id,
        ]);
    }

    public function postCheckInAttendeeQr($event_id, Request $request)
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
                'attendees.private_reference_number',
                'attendees.arrival_time',
                'attendees.has_arrived',
                'tickets.title as ticket',
            ])->first();

        if (is_null($attendee)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid Ticket! Please try again.',
            ]);
        }

        // $relatedAttendesCount = Attendee::where('id', '!=', $attendee->id)
        //     ->where([
        //         'order_id'    => $attendee->order_id,
        //         'has_arrived' => false
        //     ])->count();

        // if ($attendee->has_arrived) {
        //     return response()->json([
        //         'status'  => 'error',
        //         'message' => trans("Controllers.attendee_already_checked_in", ["time"=> $attendee->arrival_time->format(config("attendize.default_datetime_format"))])
        //     ]);
        // }

        // Attendee::find($attendee->id)->update(['has_arrived' => true, 'arrival_time' => Carbon::now()]);

        // return response()->json([
        //     'status'  => 'success',
        //     'name' => $attendee->first_name." ".$attendee->last_name,
        //     'reference' => $attendee->reference,
        //     'ticket' => $attendee->ticket
        // ]);
        return response()->json([
            'status'  => 'success',
            'reference' => $attendee->private_reference_number,
        ]);
    }
}
