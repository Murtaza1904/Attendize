<div role="dialog" class="modal fade" style="display: none;">
    <style>
        .well.nopad {
            padding: 0px;
        }
    </style>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">
                    <i class="ico-cart"></i>
                    Order Details
                </h3>
            </div>
            <div class="modal-body">

                @if($order->is_refunded || $order->is_partially_refunded)
                    <div class="alert alert-info">
                        @lang("ManageEvent.order_refunded", ["money"=>money($order->amount_refunded, $order->event->currency)])
                    </div>
                @endif

                @if(!$order->is_payment_received)
                    <div class="alert alert-info">
                        @lang("ManageEvent.this_order_is_awaiting_payment")
                    </div>
                    <a data-id="{{ $order->id }}"
                       data-route="{{ route('postMarkPaymentReceived', ['order_id' => $order->id]) }}"
                       class="btn btn-primary btn-sm markPaymentReceived"
                       href="javascript:void(0);">@lang("ManageEvent.mark_payment_received")</a>
                @endif

                <h3>@lang("ManageEvent.order_overview")</h3>
                <style>
                    .order_overview b {
                        text-transform: uppercase;
                    }

                    .order_overview .col-sm-4 {
                        margin-bottom: 10px;
                    }
                </style>
                <div class="p0 well bgcolor-white order_overview">
                    <div class="row">
                        <div class="col-sm-6 col-xs-6">
                            <b>@lang("Attendee.first_name")</b><br> {{$order->first_name}}
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <b>@lang("Attendee.last_name")</b><br> {{$order->last_name}}
                        </div>

                        <div class="col-sm-6 col-xs-6">
                            @if($order->is_refunded)
                                <b>@lang("ManageEvent.refunded_amount")</b><br>
                                {{ $order->getRefundedAmountIncludingTax()->display() }}
                            @else
                                <b>@lang("ManageEvent.amount")</b><br>
                                {{ $order->getOrderAmount()->display() }}
                                @if ($order->is_partially_refunded)
                                    <em>({{ $order->getPartiallyRefundedAmount()->negate()->display() }})</em>
                                @endif
                            @endif
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <b>@lang("Order.date")</b><br> {{$order->created_at->format(config('attendize.default_datetime_format'))}}
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <b>@lang("Order.email")</b><br> {{$order->email}}
                        </div>
                    </div>
                </div>

                <h3>@lang('Order.order_items')</h3>
                <div class="well nopad bgcolor-white p0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <th style="background-color: #fc2222 !important; border: none !important">@lang("Order.ticket")</th>
                            <th style="background-color: #fc2222 !important; border: none !important">@lang("Order.quantity")</th>
                            <th style="background-color: #fc2222 !important; border: none !important">@lang("Order.price")</th>
                            <th style="background-color: #fc2222 !important; border: none !important">@lang("Order.booking_fee")</th>
                            <th style="background-color: #fc2222 !important; border: none !important">@lang("Order.total")</th>
                            </thead>
                            <tbody>
                            @foreach($order->orderItems as $order_item)
                                <tr>
                                    <td>{{$order_item->title}}</td>
                                    <td>{{$order_item->quantity}}</td>
                                    <td>
                                        @isFree($order_item->unit_price)
                                            @lang("Order.free")
                                        @else
                                            {{money($order_item->unit_price, $order->event->currency)}}
                                        @endif
                                    </td>
                                    <td>
                                        @isFree($order_item->unit_price)
                                            -
                                        @else
                                            {{money($order_item->unit_booking_fee, $order->event->currency)}}
                                        @endif
                                    </td>
                                    <td>
                                        @isFree($order_item->unit_price)
                                            @lang("Order.free")
                                        @else
                                            {{money(($order_item->unit_price + $order_item->unit_booking_fee) * ($order_item->quantity), $order->event->currency)}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"></td>
                                <td><b>@lang("Order.sub_total")</b></td>
                                <td colspan="2">{{money($order->total_amount, $order->event->currency)}}</td>
                            </tr>
                            @if($order->event->organiser->charge_tax)
                                <tr>
                                    <td colspan="3"></td>
                                    <td><strong>{{$order->event->organiser->tax_name}}</strong></td>
                                    <td colspan="2">{{ $order->getOrderTaxAmount()->format() }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="3"></td>
                                <td><strong>@lang("Order.total")</strong></td>
                                <td colspan="2">{{ $order->getOrderAmount()->add($order->getOrderTaxAmount())->format() }}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

                <h3>
                    @lang("Order.order_attendees")
                </h3>
                <div class="well nopad bgcolor-white p0">

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                            @foreach($order->attendees as $attendee)
                                <tr>
                                    <td>
                                        @if($attendee->is_cancelled)
                                            <span class="label label-warning">
                                            @lang("Order.attendee_cancelled")
                                        </span>
                                        @endif
                                        @if($attendee->is_refunded)
                                            <span class="label label-danger">
                                                @lang("Order.attendee_refunded")
                                            </span>
                                        @endif
                                        {{$attendee->first_name}}
                                        {{$attendee->last_name}}
                                    </td>
                                    <td>
                                        {{$attendee->email}}
                                    </td>
                                    <td>
                                        {{{$attendee->ticket->title}}}
                                        {{{$order->order_reference}}}-{{{$attendee->reference_index}}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- /end modal body-->

            <div class="modal-footer">
                {!! Form::button(trans("ManageEvent.close"), ['class'=>"btn modal-close btn-danger",'data-dismiss'=>'modal']) !!}
            </div>
        </div><!-- /end modal content-->
    </div>
</div>
