<?php

namespace App\Http\Controllers;

use App\EventDiscountCode;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventDiscountCodesController extends MyBaseController
{
    public function show($event_id): View
    {
        return view('ManageEvent.DiscountCodes', [
            'event' => Event::scope()->findOrFail($event_id),
        ]);
    }

    public function showCreate($event_id): View
    {
        return view('ManageEvent.Modals.CreateDiscountCode', [
            'event' => Event::scope()->find($event_id),
        ]);
    }

    public function postCreate(Request $request, $event_id): JsonResponse
    {
        $eventDiscountCode = new EventDiscountCode();

        if (!$eventDiscountCode->validate($request->all())) {
            return response()->json([
                'status' => 'error',
                'messages' => $eventDiscountCode->errors(),
            ]);
        }

        if(EventDiscountCode::where('event_id', $event_id)->where('code', $request->code)->count() == 1) {
            return response()->json([
                'status' => 'error',
                'messages' => ['code' => 'The code has already been taken.'],
            ]);
        }

        $eventDiscountCode->event_id = $event_id;
        $eventDiscountCode->code = $request->code;
        $eventDiscountCode->discount_percentage = $request->discount_percentage;
        $eventDiscountCode->limit = $request->limit;
        $eventDiscountCode->expiry_date = date('Y-m-d',strtotime($request->expiry_date));
        $eventDiscountCode->save();

        session()->flash('message', 'DISCOUNT CODE CREATED!');

        return response()->json([
            'status' => 'success',
            'id' => $eventDiscountCode->id,
            'message' => trans("Controllers.refreshing"),
            'redirectUrl' => route('showEventDiscountCodes', [ 'event_id' => $event_id ]),
        ]);
    }

    public function postDelete($event_id, $discount_code_id): JsonResponse
    {
        $discountCode = EventDiscountCode::find($discount_code_id);
        if ($discountCode->usage > 0) {
            return response()->json([
                'status' => 'error',
                'message' => trans('AccessCodes.cannot_delete_used_code'),
            ]);
        }
        $discountCode->delete();

        session()->flash('message', 'DISCOUNT CODE DELETED!');

        return response()->json([
            'status' => 'success',
            'message' => trans("Controllers.refreshing"),
            'redirectUrl' => route('showEventDiscountCodes', [ 'event_id' => $event_id ]),
        ]);
    }
}
