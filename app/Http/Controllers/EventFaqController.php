<?php

namespace App\Http\Controllers;

use App\EventFaq;
use App\Models\Event;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EventFaqController extends MyBaseController
{
    public function show($event_id): View
    {
        return view('ManageEvent.Faq', [
            'event' => Event::scope()->findOrFail($event_id),
        ]);
    }

    public function showCreate($event_id): View
    {
        return view('ManageEvent.Modals.CreateFaq', [
            'event' => Event::scope()->find($event_id),
        ]);
    }

    public function postCreate(Request $request, $event_id): JsonResponse
    {
        $eventFaq = new EventFaq();

        if (!$eventFaq->validate($request->all())) {
            return response()->json([
                'status' => 'error',
                'messages' => $eventFaq->errors(),
            ]);
        }

        $eventFaq->event_id = $event_id;
        $eventFaq->question = $request->question;
        $eventFaq->answer = $request->answer;
        $eventFaq->save();

        session()->flash('message', 'FAQ CREATED!');

        return response()->json([
            'status' => 'success',
            'id' => $eventFaq->id,
            'message' => trans("Controllers.refreshing"),
            'redirectUrl' => route('showEventFaq', [ 'event_id' => $event_id ]),
        ]);
    }

    public function showEdit($event_id, $faq_id): View
    {
        return view('ManageEvent.Modals.EditFaq', [
            'event' => Event::scope()->find($event_id),
            'faq'   => EventFaq::findOrFail($faq_id),
        ]);
    }

    public function postEdit(Request $request, $event_id, $faq_id): JsonResponse
    {
        $eventFaq = EventFaq::find($faq_id);

        if (!$eventFaq->validate($request->all())) {
            return response()->json([
                'status' => 'error',
                'messages' => $eventFaq->errors(),
            ]);
        }

        $eventFaq->event_id = $event_id;
        $eventFaq->question = $request->question;
        $eventFaq->answer = $request->answer;
        $eventFaq->save();

        session()->flash('message', 'FAQ UPDATED!');

        return response()->json([
            'status' => 'success',
            'id' => $eventFaq->id,
            'message' => trans("Controllers.refreshing"),
            'redirectUrl' => route('showEventFaq', [ 'event_id' => $event_id ]),
        ]);
    }

    public function postDelete($event_id, $faq_id): JsonResponse
    {
        EventFaq::find($faq_id)->delete();

        session()->flash('message', 'FAQ DELETED!');

        return response()->json([
            'status' => 'success',
            'message' => trans("Controllers.refreshing"),
            'redirectUrl' => route('showEventFaq', [ 'event_id' => $event_id ]),
        ]);
    }
}
