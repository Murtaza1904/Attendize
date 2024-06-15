<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventTicketsController extends MyBaseController
{
    public function showTickets(Request $request, $event_id): View
    {
        $allowed_sorts = [
            'created_at'    => trans("Controllers.sort.created_at"),
            'title'         => trans("Controllers.sort.title"),
            'quantity_sold' => trans("Controllers.sort.quantity_sold"),
            'sales_volume'  => trans("Controllers.sort.sales_volume"),
            'sort_order'  => trans("Controllers.sort.sort_order"),
        ];

        $q = $request->get('q', '');
        $sort_by = $request->get('sort_by');
        if (isset($allowed_sorts[$sort_by]) === false) {
            $sort_by = 'sort_order';
        }

        $event = Event::scope()->findOrFail($event_id);
        
        $tickets = empty($q) === false
            ? $event->tickets()->where('title', 'like', '%' . $q . '%')->orderBy($sort_by, 'asc')->paginate(100)
            : $event->tickets()->orderBy($sort_by, 'asc')->paginate(100);

        
        return view('ManageEvent.Tickets', compact('event', 'tickets', 'sort_by', 'q', 'allowed_sorts'));
    }

    public function showCreateTicket($event_id): View
    {
        return view('ManageEvent.Modals.CreateTicket', [
            'event' => Event::scope()->find($event_id),
        ]);
    }

    public function showEditTicket($event_id, $ticket_id): View
    {
        return view('ManageEvent.Modals.EditTicket', [
            'event'  => Event::scope()->find($event_id),
            'ticket' => Ticket::scope()->find($ticket_id),
        ]);
    }

    public function postCreateTicket(Request $request, $event_id): JsonResponse
    {
        for ($i = 1; $i <= $request->get('number_of_ticket'); $i++) {
            $ticket = Ticket::createNew();
    
            if (!$ticket->validate($request->all())) {
                return response()->json([
                    'status'   => 'error',
                    'messages' => $ticket->errors(),
                ]);
            }
    
            $ticket->event_id = $event_id;
            $ticket->title = $request->get('title');
            $ticket->quantity_available = !$request->get('quantity_available') ? null : $request->get('quantity_available');
            $ticket->start_sale_date = $request->get('start_sale_date');
            $ticket->end_sale_date = $request->get('end_sale_date');
            $ticket->price = $request->get('price');
            $ticket->min_per_person = $request->get('min_per_person');
            $ticket->max_per_person = $request->get('max_per_person');
            $ticket->number_of_person = $request->get('number_of_person');
            $ticket->position = $request->get('position');
            $ticket->description = prepare_markdown($request->get('description'));
            $ticket->is_hidden = $request->get('is_hidden') ? 1 : 0;
            $ticket->show_quantity = $request->get('show_quantity') ? 1 : 0;
    
            $ticket->save();
        }

        session()->flash('message', 'Successfully Created Ticket');

        return response()->json([
            'status'      => 'success',
            'id'          => $ticket->id,
            'message'     => trans("Controllers.refreshing"),
            'redirectUrl' => route('showEventTickets', [
                'event_id' => $event_id,
            ]),
        ]);
    }

    public function postPauseTicket(Request $request)
    {
        $ticket_id = $request->get('ticket_id');

        $ticket = Ticket::scope()->find($ticket_id);

        $ticket->is_paused = ($ticket->is_paused == 1) ? 0 : 1;

        if ($ticket->save()) {
            return response()->json([
                'status'  => 'success',
                'message' => trans("Controllers.ticket_successfully_updated"),
                'id'      => $ticket->id,
            ]);
        }

        return response()->json([
            'status'  => 'error',
            'id'      => $ticket->id,
            'message' => trans("Controllers.whoops"),
        ]);
    }

    public function postDeleteTicket(Request $request)
    {
        $ticket_id = $request->get('ticket_id');

        $ticket = Ticket::scope()->find($ticket_id);

        if ($ticket->quantity_sold > 0) {
            return response()->json([
                'status'  => 'error',
                'message' => trans("Controllers.cant_delete_ticket_when_sold"),
                'id'      => $ticket->id,
            ]);
        }

        if ($ticket->delete()) {
            return response()->json([
                'status'  => 'success',
                'message' => trans("Controllers.ticket_successfully_deleted"),
                'id'      => $ticket->id,
            ]);
        }

        return response()->json([
            'status'  => 'error',
            'id'      => $ticket->id,
            'message' => trans("Controllers.whoops"),
        ]);
    }

    public function postEditTicket(Request $request, $event_id, $ticket_id): JsonResponse
    {
        $ticket = Ticket::scope()->findOrFail($ticket_id);

        $validation_messages['quantity_available.min'] = trans("Controllers.quantity_min_error");
        $ticket->messages = $validation_messages + $ticket->messages;

        if (!$ticket->validate($request->all())) {
            return response()->json([
                'status'   => 'error',
                'messages' => $ticket->errors(),
            ]);
        }

        $ticket->title = $request->get('title');
        $ticket->quantity_available = !$request->get('quantity_available') ? null : $request->get('quantity_available');
        $ticket->price = $request->get('price');
        $ticket->start_sale_date = $request->get('start_sale_date');
        $ticket->end_sale_date = $request->get('end_sale_date');
        $ticket->description = prepare_markdown($request->get('description'));
        $ticket->min_per_person = $request->get('min_per_person');
        $ticket->max_per_person = $request->get('max_per_person');
        $ticket->number_of_person = $request->get('number_of_person');
        $ticket->position = $request->get('position');
        $ticket->is_hidden = $request->get('is_hidden') ? 1 : 0;
        $ticket->show_quantity = $request->get('show_quantity') ? 1 : 0;
        $ticket->save();

        return response()->json([
            'status'      => 'success',
            'id'          => $ticket->id,
            'message'     => trans("Controllers.refreshing"),
            'redirectUrl' => route('showEventTickets', [
                'event_id' => $event_id,
            ]),
        ]);
    }

    public function postUpdateTicketsOrder(Request $request)
    {
        $ticket_ids = $request->get('ticket_ids');
        $sort = 1;

        foreach ($ticket_ids as $ticket_id) {
            $ticket = Ticket::scope()->find($ticket_id);
            $ticket->sort_order = $sort;
            $ticket->save();
            $sort++;
        }

        return response()->json([
            'status'  => 'success',
            'message' => trans("Controllers.ticket_order_successfully_updated"),
        ]);
    }
}
