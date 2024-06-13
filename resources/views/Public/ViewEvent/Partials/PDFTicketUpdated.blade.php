<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{ url('/') }}">
    <link href="{{ asset('assets/images/favicon.png') }}" rel="shortcut icon" type="image/x-icon">
    <title>Ticket(s)</title>
    <style>
        .ticket {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 16px;
            width: 200px;
            text-align: center;
            background-color: #f1f1f1;
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body style="background-color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; color: #000 !important;">
    <div class="container" style="width: 100%">
        @foreach ($attendees as $attendee)
            @if (!$attendee->is_cancelled)
                <div class="ticket">
                    <div class='logo'>
                        <img alt="{{ $event->organiser->full_logo_path }}"
                            src="data:image/png;base64, {{ $image }}" />
                        @if (isset($images) && count($images) > 0)
                            @foreach ($images as $img)
                                <BR><img src="data:image/png;base64, {{ $img }}" />
                            @endforeach
                        @endif
                    </div>
                    <div class="layout_even" style="display: flex">
                        <div class="event_details" style="color: #000 !important;">
                            <h4 style="color: #000 !important;">@lang('Ticket.event')</h4>
                            {{ $event->title }}
                            <h4 style="color: #000 !important;">@lang('Ticket.organiser')</h4>
                            {{ $event->organiser->name }}
                            <h4 style="color: #000 !important;">@lang('Ticket.venue')</h4>
                            {{ $event->venue_name }}
                            <h4 style="color: #000 !important;">@lang('Ticket.start_date_time')</h4>
                            {{ $event->startDateFormatted() }}
                            <h4 style="color: #000 !important;">@lang('Ticket.end_date_time')</h4>
                            {{ $event->endDateFormatted() }}
                        </div>

                        <div class="attendee_details">
                            <h4 style="color: #000 !important;">@lang('Ticket.name')</h4>
                            {{ $attendee->first_name . ' ' . $attendee->last_name }}
                            <h4 style="color: #000 !important;">@lang('Ticket.ticket_type')</h4>
                            {{ $attendee->ticket->title }}
                            <h4 style="color: #000 !important;">@lang('Ticket.order_ref')</h4>
                            {{ $order->order_reference }}
                            <h4 style="color: #000 !important;">@lang('Ticket.attendee_ref')</h4>
                            {{ $attendee->reference }}
                            <h4 style="color: #000 !important;">@lang('Ticket.price')</h4>
                            @php
                                // Calculating grand total including tax
                                $grand_total = $attendee->ticket->total_price;
                                $tax_amt = ($grand_total * $event->organiser->tax_value) / 100;
                                $grand_total = $tax_amt + $grand_total;
                            @endphp
                            {{ money($grand_total, $order->event->currency) }} @if ($attendee->ticket->total_booking_fee)
                                (inc. {{ money($attendee->ticket->total_booking_fee, $order->event->currency) }}
                                @lang('Public_ViewEvent.inc_fees'))
                                @endif @if ($event->organiser->tax_name)
                                    (inc. {{ money($tax_amt, $order->event->currency) }}
                                    {{ $event->organiser->tax_name }})
                                    <br><br>{{ $event->organiser->tax_name }} ID: {{ $event->organiser->tax_id }}
                                @endif
                        </div>
                    </div>
                    <div class="barcode">
                        {!! DNS2D::getBarcodeSVG($attendee->private_reference_number, 'QRCODE', 6, 6) !!}
                    </div>
                    @if ($event->is_1d_barcode_enabled)
                        <div class="barcode_vertical">
                            {!! DNS1D::getBarcodeSVG($attendee->private_reference_number, 'C39+', 1, 50) !!}
                        </div>
                    @endif
                </div>
            @endif
        @endforeach

        <!--
            <div class="bottom_info">
                {{-- Attendize is provided free of charge on the condition the below hyperlink is left in place. --}}
                {{-- See https://www.attendize.com/license.html for more information. --}}
                @include('Shared.Partials.PoweredBy')
            </div> -->
    </div>
</body>

</html>
