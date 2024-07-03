<?php

namespace App\Exports;

use App\Models\Attendee;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Auth;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;

class AttendeesExport implements FromQuery, WithHeadings, WithEvents
{
    use Exportable;

    public function __construct(int $event_id)
    {
        $this->event_id = $event_id;
    }

    /**
    * @return \Illuminate\Support\Query
    */
    public function query()
    {
        $yes = strtoupper(trans("basic.yes"));
        $no = strtoupper(trans("basic.no"));
        $query = Attendee::query()->select([
            'attendees.first_name',
            'attendees.last_name',
            'attendees.email',
            'tickets.title',
            'order_items.unit_price',
            'order_items.unit_booking_fee',
            'orders.taxamt',
            'order_items.discount',
            'order_items.discount_code',
            'orders.created_at',
        ])->join('events', 'events.id', '=', 'attendees.event_id')
            ->join('orders', 'orders.id', '=', 'attendees.order_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('tickets', 'tickets.id', '=', 'attendees.ticket_id')
            ->where('attendees.event_id', $this->event_id)
            ->where('attendees.account_id', Auth::user()->account_id)
            ->where('attendees.is_cancelled', false);
        return $query;
    }

    public function headings(): array
    {
        return [
            trans("Attendee.first_name"),
            trans("Attendee.last_name"),
            trans("Attendee.email"),
            trans("Ticket.ticket_type"),
            'Ticket Fee',
            'Booking Fee',
            'Tax',
            'Discount',
            'Discount Code',
            trans("Order.order_date"),
        ];
    }

     /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            BeforeExport::class => function(BeforeExport $event) {
                $event->writer->getProperties()->setCreator(config('attendize.app_name'));
                $event->writer->getProperties()->setCompany(config('attendize.app_name'));
            },
        ];
    }
}
