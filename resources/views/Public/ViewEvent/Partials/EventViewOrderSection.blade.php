<style>
    /*@todo This is temp - move to styles*/
    h3 {
        border: none !important;
        font-size: 30px;
        text-align: center;
        margin: 0 0 30px;
        letter-spacing: .2em;
        font-weight: 200;
    }

    .order_header {
        text-align: center
    }

    .order_header .massive-icon {
        display: block;
        width: 120px;
        height: 120px;
        font-size: 100px;
        margin: 0 auto;
        color: #63C05E;
    }

    .order_header h1 {
        margin-top: 20px;
        text-transform: uppercase;
    }

    .order_header h2 {
        margin-top: 5px;
        font-size: 20px;
    }

    .order_details.well, .offline_payment_instructions {
        margin-top: 25px;
        background-color: #FCFCFC;
        line-height: 30px;
        text-shadow: 0 1px 0 rgba(255,255,255,.9);
        color: #656565;
        overflow: hidden;
    }

    .ticket_download_link {
        border-bottom: 3px solid;
    }
</style>
<style>
    .donate-img {
        height: 500px;
        width: 100%;
        display: flex;
        justify-content: end;
        background-size: cover;
        background-position: center 
    }
    .help-text {
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 10px;
        margin-top: 50px;
    }
    
    .donate-btn-container {
        display: flex;
        justify-content: center;
        flex-direction: column;
        gap: 1.5rem;
        text-align: center;
        margin-right: 3rem;
    }
    .donate-btn-container a {
        background: #fc2222;
        padding-inline: 5.25rem;
        padding-block: 1.25rem;
        text-decoration: none;
        border-radius: 5px;
        color: #fff;
    }

    @media screen and (max-width: 768px) {
        .donate-img {
            justify-content: center;
        }

        .donate-btn-container {
            margin-top: 330px;
        }
    }
</style>
<section id="order_form" class="container">
    <div class="row">
        <div class="col-md-12 order_header">
            <span class="massive-icon">
                <i class="ico ico-checkmark-circle"></i>
            </span>
            <h1>{{ @trans("Public_ViewEvent.thank_you_for_your_order") }}</h1>
            <div style="display: flex; justify-content: center">
                <a href="{{ route('showOrderTickets', ['order_reference' => $order->order_reference] ).'?download=1' }}" 
                    style="background: #fc2222; padding-inline: 100px; padding-block: 10px; color: #fff; border-radius: 5px">
                    Download Ticket
                </a>
            </div>
            <h2>
                {{ @trans("Public_ViewEvent.your") }}
                <a class="ticket_download_link"
                   href="{{ route('showOrderTickets', ['order_reference' => $order->order_reference] ).'?download=1' }}">
                    {{ @trans("Public_ViewEvent.tickets") }}</a> {{ @trans("Public_ViewEvent.confirmation_email") }}
            </h2>
        </div>
        <div class="col-md-12">
            <div class="help-text">
                Help Palestine: Your Donation Can Save Lives!
            </div>
        </div>
    </div>
    <div class="donate-img" style="background-image: url({{ asset('assets/images/donate.jpg') }})">
            <div class="donate-btn-container">
                <a href="https://hrf.events/palestine-tickets-5" target="__blank">Donate $5</a>
                <a href="https://hrf.events/palestine-tickets-10" target="__blank">Donate $10</a>
                <a href="https://hrf.events/palestine-tickets-15" target="__blank">Donate $15</a>
            </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="content event_view_order">

                @if($event->post_order_display_message)
                <div class="alert alert-dismissable alert-info">
                    {{ nl2br($event->post_order_display_message) }}
                </div>
                @endif

                <div class="order_details well">
                    <div class="row">
                        <div class="col-sm-4 col-xs-6">
                            <b>@lang("Public_ViewEvent.first_name")</b><br> {{$order->first_name}}
                        </div>

                        <div class="col-sm-4 col-xs-6">
                            <b>@lang("Public_ViewEvent.last_name")</b><br> {{$order->last_name}}
                        </div>

                        <div class="col-sm-4 col-xs-6">
                            <b>@lang("Public_ViewEvent.amount")</b><br> {{$order->event->currency_symbol}}{{number_format($order->total_amount, 2)}}
                            @if($event->organiser->charge_tax)
                            <small>{{ $orderService->getVatFormattedInBrackets() }}</small>
                            @endif
                        </div>

                        <div class="col-sm-4 col-xs-6">
                            <b>@lang("Public_ViewEvent.reference")</b><br> {{$order->order_reference}}
                        </div>

                        <div class="col-sm-4 col-xs-6">
                            <b>@lang("Public_ViewEvent.date")</b><br> {{$order->created_at->format(config('attendize.default_datetime_format'))}}
                        </div>

                        <div class="col-sm-4 col-xs-6">
                            <b>@lang("Public_ViewEvent.email")</b><br> {{$order->email}}
                        </div>
                        @if ($order->is_business)
                            <div class="col-sm-4 col-xs-6">
                                <b>@lang("Public_ViewEvent.business_name")</b><br> {{$order->business_name}}
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <b>@lang("Public_ViewEvent.business_tax_number")</b><br> {{$order->business_tax_number}}
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <b>@lang("Public_ViewEvent.business_address")</b><br />
                                @if ($order->business_address_line_one)
                                {{$order->business_address_line_one}},
                                @endif
                                @if ($order->business_address_line_two)
                                {{$order->business_address_line_two}},
                                @endif
                                @if ($order->business_address_state_province)
                                {{$order->business_address_state_province}},
                                @endif
                                @if ($order->business_address_city)
                                {{$order->business_address_city}},
                                @endif
                                @if ($order->business_address_code)
                                {{$order->business_address_code}}
                                @endif
                            </div>
                        @endif
                    </div>
                </div>


                    @if(!$order->is_payment_received)
                        <h3>
                            @lang("Public_ViewEvent.payment_instructions")
                        </h3>
                    <div class="alert alert-info">
                        @lang("Public_ViewEvent.order_awaiting_payment")
                    </div>
                    <div class="offline_payment_instructions well">
                        {!! md_to_html($event->offline_payment_instructions) !!}
                    </div>

                    @endif

                <h3>
                    @lang("Public_ViewEvent.order_items")
                </h3>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="background-color: #fc2222 !important; border: none !important">
                                    @lang("Public_ViewEvent.ticket")
                                </th>
                                <th style="background-color: #fc2222 !important; border: none !important">
                                    @lang("Public_ViewEvent.quantity_full")
                                </th>
                                <th style="background-color: #fc2222 !important; border: none !important">
                                    @lang("Public_ViewEvent.price")
                                </th>
                                <th style="background-color: #fc2222 !important; border: none !important">
                                    @lang("Public_ViewEvent.booking_fee")
                                </th>
                                <th style="background-color: #fc2222 !important; border: none !important">
                                    @lang("Public_ViewEvent.total")
                                </th>
                                <th style="background-color: #fc2222 !important; border: none !important">
                                    Discount
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $order_item)
                                {{-- @dd($order_item) --}}
                                @php
                                    // $ticket = App\Models\Ticket::where('title', $order_item->title)->where('price', $order_item->unit_price)->first();
                                    $ticket = $order->attendees->first()->ticket;
                                @endphp
                                <input type="hidden" name="tickets[]" value="{{ $ticket->id }}">
                                <tr>
                                    <td>
                                        {{$order_item->title}}
                                        <input type="hidden" name="ticket_title_{{ $ticket->id }}" value="{{ $order_item->title }}">
                                    </td>
                                    <td>
                                        {{$order_item->quantity}}
                                        <input type="hidden" name="ticket_quantity_{{ $ticket->id }}" value="{{ $order_item->quantity }}">
                                    </td>
                                    <td>
                                        @isFree($order_item->unit_price)
                                            @lang("Public_ViewEvent.free")
                                        @else
                                            {{money($order_item->unit_price, $order->event->currency)}}
                                            <input type="hidden" name="ticket_price_{{ $ticket->id }}" value="{{ $order_item->unit_price }}">
                                        @endif
                                    </td>
                                    <td>
                                        @requiresPayment($order_item->unit_booking_fee)
                                            @requiresPayment($order_item->unit_price)
                                                {{money($order_item->unit_booking_fee, $order->event->currency)}}
                                            @else
                                                -
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @isFree($order_item->unit_price)
                                            @lang("Public_ViewEvent.free")
                                        @else
                                            {{money(($order_item->unit_price + $order_item->unit_booking_fee) * ($order_item->quantity), $order->event->currency)}}
                                        @endif

                                    </td>
                                    <td>
                                        {{ money($order_item->discount, $order->event->currency) }}
                                        <input type="hidden" name="ticket_discount_{{ $ticket->id }}" value="{{ $order_item->discount }}">
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <b>@lang("Public_ViewEvent.sub_total")</b>
                                </td>
                                <td colspan="2">
                                    {{ $orderService->getOrderTotalWithBookingFee(true) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <b>Tax</b>
                                </td>
                                <td colspan="2">
                                    {{ $orderService->getTaxAmount(true) }}
                                </td>
                            </tr>
                            @if($event->organiser->charge_tax)
                            <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <strong>{{$event->organiser->tax_name}}</strong><em>({{$order->event->organiser->tax_value}}%)</em>
                                </td>
                                <td colspan="2">
                                    {{ $orderService->getTaxAmount(true) }}
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <b>Total</b>
                                </td>
                                <td colspan="2">
                                   {{ $orderService->getGrandTotal(true) }}
                                </td>
                            </tr>
                            @if($order->is_refunded || $order->is_partially_refunded)
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <b>@lang("Public_ViewEvent.refunded_amount")</b>
                                    </td>
                                    <td colspan="2">
                                        {{money($order->amount_refunded, $order->event->currency)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <b>@lang("Public_ViewEvent.total")</b>
                                    </td>
                                    <td colspan="2">
                                        {{money($order->total_amount - $order->amount_refunded, $order->event->currency)}}
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>

                <h3>
                    @lang("Public_ViewEvent.order_attendees")
                </h3>

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <tbody>
                            @foreach($order->attendees as $attendee)
                            <tr>
                                <td>
                                    {{$attendee->first_name}}
                                    {{$attendee->last_name}}
                                    (<a href="mailto:{{$attendee->email}}">{{$attendee->email}}</a>)
                                </td>
                                <td>
                                    {{{$attendee->ticket->title}}}
                                </td>
                                <td>
                                    @if($attendee->is_cancelled)
                                        @lang("Public_ViewEvent.attendee_cancelled")
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div style="display: flex; justify-content: center">
                            <a href="{{ route('home') }}" style="color:#fc2222;">
                                <ico class="ico-arrow-left"></ico>
                                Back To Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function googleStore() {
        var items = [];

        $.each($("input[name='tickets[]']"), function (key, value) { 
            var ticketId = $(value).val();
            var ticketQuantity = $("input[name='ticket_quantity_" + ticketId + "']").val();
            
            if (ticketQuantity > 0) {
                var item = {
                    item_id: ticketId,
                    item_name: $("input[name='ticket_title_" + ticketId + "']").val(), 
                    affiliation: "Google Merchandise Store",
                    coupon: "",
                    discount: $("input[name='ticket_title_" + ticketId + "']").val(),
                    price: $("input[name='ticket_price_" + ticketId + "']").val(), 
                    quantity: ticketQuantity
                };
                items.push(item);
            }
        });
        console.log(items);
        dataLayer.push({ ecommerce: null });
        dataLayer.push({
        event: "purchase",
        ecommerce: {
            transaction_id: "{{ $order->transaction_id }}",
            value: "{{ $order->amount }}",
            tax: "{{ $order->taxamt }}",
            currency: "{{ $order->event->currency->code }}",
            items: items,
        }
        });
    }
    $(document).ready(function () {
        googleStore();
    });
</script>

