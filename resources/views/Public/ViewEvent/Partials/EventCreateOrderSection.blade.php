<section id='order_form' class="container">
    <div class="row">
        <h1 class="section_head">
            @lang("Public_ViewEvent.order_details")
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            @lang("Public_ViewEvent.below_order_details_header")
        </div>
        <div class="col-md-4 col-md-push-8">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="ico-cart mr5"></i>
                        @lang("Public_ViewEvent.order_summary")
                    </h3>
                </div>

                <div class="panel-body pt0">
                    <table class="table mb0 table-condensed">
                        @foreach($tickets as $ticket)
                        <input type="hidden" name="tickets[]" value="{{ $ticket['ticket']['id'] }}">
                        <tr style="padding: 0">
                            <td style="border: none; padding: 0">
                                <b>{{ $ticket['ticket']['title'] }}</b> X {{ $ticket['qty'] }}
                                <input type="hidden" name="ticket_title_{{ $ticket['ticket']['id'] }}" value="{{ $ticket['ticket']['title'] }}">
                                <input type="hidden" name="ticket_quantity_{{ $ticket['ticket']['id'] }}" value="{{ $ticket['qty'] }}">
                                <input type="hidden" name="ticket_discount_{{ $ticket['ticket']['id'] }}" value="{{ $ticket['discount'] }}">
                            </td>
                        </tr>
                        <tr style="padding: 0">
                            <td style="border: none; padding: 0">Ticket Fee</td>
                            <td style="text-align: right; border: none; padding: 0">
                                {{ money($ticket['price'], $event->currency) }}
                            </td>
                        </tr>
                        <tr style="padding: 0">
                            <td style="border: none; padding: 0">Booking Fee</td>
                            <td style="text-align: right; border: none; padding: 0">
                                {{ money($ticket['organiser_booking_fee'], $event->currency) }}
                            </td>
                        </tr>
                        <tr style="padding: 0">
                            <td style="border: none; padding: 0">Discount</td>
                            <td style="text-align: right; border: none; padding: 0">
                                {{ money($ticket['discount'], $event->currency) }}
                            </td>
                        </tr>
                        <tr style="border-bottom: 2px solid black; padding: 0">
                            <td style="border: none; padding: 0; font-weight: bolder">Sub Total : </td>
                            <td style="text-align: right; border: none; padding: 0; font-weight: bolder">
                                {{ money($ticket['full_price'], $event->currency) }}
                                <input type="hidden" name="ticket_price_{{ $ticket['ticket']['id'] }}" value="{{ $ticket['full_price'] }}">
                            </td>
                        </tr>
                        <tr style="padding: 5px">
                            <td></td>
                            <td></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                {{-- @if($order_total > 0) --}}
                <div class="panel-footer">
                    <h5>
                        @lang("Public_ViewEvent.total"): <span style="float: right;"><b>{{ $orderService->getOrderTotalWithBookingFee(true) }}</b></span>
                    </h5>
                    {{-- @if($event->organiser->charge_tax) --}}
                    @php
                        $discount = $discount['fix_amount'] ?? $discount['percentage'] ?? 0;
                    @endphp
                    <h5>
                        Tax :
                        <span style="float: right;"><b>{{ $orderService->getTaxAmount(true) }}</b></span>
                    </h5>
                    <h5>
                        <strong>@lang("Public_ViewEvent.grand_total")</strong>
                        <span style="float: right;"><b>{{  money($orderService->getGrandTotal(false) , $event->currency) }}</b></span>
                    </h5>
                    {{-- @endif --}}
                </div>
                {{-- @endif --}}

            </div>
            <div class="help-block">
                {!! @trans("Public_ViewEvent.time", ["time"=>"<span id='countdown'></span>"]) !!}
            </div>
        </div>
        <div class="col-md-8 col-md-pull-4">
            <div class="event_order_form">
                {!! Form::open(['url' => route('postValidateOrder', ['event_id' => $event->id ]), 'class' => 'ajax payment-form']) !!}

                {!! Form::hidden('event_id', $event->id) !!}

                <h3> @lang("Public_ViewEvent.your_information")</h3>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            {!! Form::label("order_first_name", trans("Public_ViewEvent.first_name")) !!}
                            {!! Form::text("order_first_name", $user->first_name ?? null, ['required' => 'required', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            {!! Form::label("order_last_name", trans("Public_ViewEvent.last_name")) !!}
                            {!! Form::text("order_last_name", $user->last_name ?? null, ['required' => 'required', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label("order_email", trans("Public_ViewEvent.email")) !!}
                            {!! Form::text("order_email", $user->email ?? null, ['required' => 'required', 'class' => 'form-control']) !!}
                            <div id="email-required" class="text-danger"></div>
                        </div>
                    </div>
                    {{-- <div class="col-md-4">
                        <button type="button" class="btn btn-black" style="margin-top: 25px" onclick="sendOTP()">Send OTP</button>
                        <div class="text-success" id="success-message"></div>
                    </div> --}}
                </div>
                {{-- <div class="row">
                    <div class="col-md-4">
                        <div class="form-group" id="otp-field"></div>
                    </div>
                </div> --}}
                <div class="row"><div class="col-md-12">&nbsp;</div></div>
                <div class="row">
                    <div class="col-md-12">
                        {{-- <div class="form-group">
                            <div class="custom-checkbox">
                                {!! Form::checkbox('is_business', 1, null, ['data-toggle' => 'toggle', 'id' => 'is_business']) !!}
                                {!! Form::label('is_business', trans("Public_ViewEvent.is_business"), ['class' => 'control-label']) !!}
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="row"><div class="col-md-12">&nbsp;</div></div>
                <div class="row hidden" id="business_details">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {!! Form::label("business_name", trans("Public_ViewEvent.business_name")) !!}
                                        {!! Form::text("business_name", null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {!! Form::label("business_tax_number", trans("Public_ViewEvent.business_tax_number")) !!}
                                        {!! Form::text("business_tax_number", null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {!! Form::label("business_address_line1", trans("Public_ViewEvent.business_address_line1")) !!}
                                        {!! Form::text("business_address_line1", null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {!! Form::label("business_address_line2", trans("Public_ViewEvent.business_address_line2")) !!}
                                        {!! Form::text("business_address_line2", null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        {!! Form::label("business_address_state", trans("Public_ViewEvent.business_address_state_province")) !!}
                                        {!! Form::text("business_address_state", null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        {!! Form::label("business_address_city", trans("Public_ViewEvent.business_address_city")) !!}
                                        {!! Form::text("business_address_city", null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        {!! Form::label("business_address_code", trans("Public_ViewEvent.business_address_code")) !!}
                                        {!! Form::text("business_address_code", null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row"><div class="col-md-12">&nbsp;</div></div>
                <div class="p20 pl0">
                    <a href="javascript:void(0);" class="btn btn-primary btn-event-link btn-xs" id="mirror_buyer_info">
                        @lang("Public_ViewEvent.copy_buyer")
                    </a>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="ticket_holders_details">
                            <h3>@lang("Public_ViewEvent.ticket_holder_information")</h3>
                            <?php
                                $total_attendee_increment = 0;
                            ?>
                            @foreach($tickets as $ticket)
                                @for($i=0; $i<=$ticket['qty']-1; $i++)
                                <div class="panel panel-primary" >

                                    <div class="panel-heading" style="background: #fc2222; border: none">
                                        <h3 class="panel-title">
                                            <b>{{$ticket['ticket']['title']}}</b>: @lang("Public_ViewEvent.ticket_holder_n", ["n"=>$i+1])
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {!! Form::label("ticket_holder_first_name[{$i}][{$ticket['ticket']['id']}]", trans("Public_ViewEvent.first_name")) !!}
                                                    {!! Form::text("ticket_holder_first_name[{$i}][{$ticket['ticket']['id']}]", null, ['required' => 'required', 'class' => "ticket_holder_first_name.$i.{$ticket['ticket']['id']} ticket_holder_first_name form-control"]) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {!! Form::label("ticket_holder_last_name[{$i}][{$ticket['ticket']['id']}]", trans("Public_ViewEvent.last_name")) !!}
                                                    {!! Form::text("ticket_holder_last_name[{$i}][{$ticket['ticket']['id']}]", null, ['required' => 'required', 'class' => "ticket_holder_last_name.$i.{$ticket['ticket']['id']} ticket_holder_last_name form-control"]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {!! Form::label("ticket_holder_email[{$i}][{$ticket['ticket']['id']}]", trans("Public_ViewEvent.email_address")) !!}
                                                    {!! Form::text("ticket_holder_email[{$i}][{$ticket['ticket']['id']}]", null, ['required' => 'required', 'class' => "ticket_holder_email.$i.{$ticket['ticket']['id']} ticket_holder_email form-control"]) !!}
                                                </div>
                                            </div>
                                            @include('Public.ViewEvent.Partials.AttendeeQuestions', ['ticket' => $ticket['ticket'],'attendee_number' => $total_attendee_increment++])

                                        </div>
                                    </div>
                                </div>
                                @endfor
                            @endforeach
                        </div>
                    </div>
                </div>

                @if($event->pre_order_display_message)
                <div class="well well-small">
                    {!! nl2br(e($event->pre_order_display_message)) !!}
                </div>
                @endif
                <div>
                    @php
                        $refundPolicy = \App\RefundPolicy::first();
                    @endphp
                    <div class="form-group">
                        <input class="form-check-input" type="checkbox" value="1" id="first_checkbox"
                            required />
                        <label for="first_checkbox" style="display: inline">{!! $refundPolicy->first_checkbox_text !!}</label>
                    </div>
                    <div class="form-group">
                        <input class="form-check-input" type="checkbox" value="1" id="second_checkbox"
                            required />
                        <label for="second_checkbox"
                            style="display: inline">{{ $refundPolicy->second_checkbox_text }}</label>
                    </div>
                </div>
               {!! Form::hidden('is_embedded', $is_embedded) !!}
               {{-- {!! Form::submit(trans("Public_ViewEvent.checkout_order"), ['class' => 'btn btn-lg btn-event-link btn-success card-submit', 'style' => 'width:100%;']) !!} --}}
               <input class="btn btn-lg btn-event-link btn-success card-submit" style="width:100%;" onclick="googleStore()" type="submit" value="Continue to Payment">
               {!! Form::close() !!}

            </div>
        </div>
    </div>
    <img src="https://cdn.attendize.com/lg.png" />
</section>
<script>
    function sendOTP() {
        var email = $("input[name='order_email']").val();
        if (email) {
            $("#email-required").text('');
            $.ajax({
                type: "POST",
                url: "/client-login-check",
                data: {
                    _token: "{{ csrf_token() }}",
                    email: email,
                },
                dataType: "json",
            });
            $("#otp-field").html(`
                <label for="otp">OTP</label>
                <input required="required" class="form-control" name="otp" type="text" id="otp">
            `);
            $("#success-message").text(response.message);
        } else {
            $("#email-required").text('Please enter email address');
        }
    }
</script>
<script>
    function googleStore() {
        var items = [];
        var totalPrice = 0;
        var currency = "{{ $event->currency->code }}";

        $.each($("input[name='tickets[]']"), function (key, value) { 
            var ticketId = $(value).val();
            var ticketQuantity = $("input[name='ticket_quantity_" + ticketId + "']").val();
            
            if (ticketQuantity > 0) {
                var item = {
                    item_id: ticketId,
                    item_name: $("input[name='ticket_title_" + ticketId + "']").val(), 
                    price: $("input[name='ticket_price_" + ticketId + "']").val(), 
                    quantity: ticketQuantity,
                    discount: $("input[name='ticket_discount_" + ticketId + "']").val(),
                };
                items.push(item);
                totalPrice += parseFloat(item.price) * ticketQuantity;
            }
        });

        dataLayer.push({ ecommerce: null });
        dataLayer.push({
        event: "begin_checkout",
        ecommerce: {
            currency: currency,
            value: totalPrice,
            items: items,
        }
        });
    }
</script>
@if(session()->get('message'))
    <script>showMessage('{{session()->get('message')}}');</script>
@endif

