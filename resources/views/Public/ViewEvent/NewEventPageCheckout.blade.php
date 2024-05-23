<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order Form</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('assets/stylesheet/frontend.css') }}">

    <style>
        ::-webkit-input-placeholder {
            /* WebKit browsers */
            color: #ccc !important;
        }

        :-moz-placeholder {
            /* Mozilla Firefox 4 to 18 */
            color: #ccc !important;
            opacity: 1;
        }

        ::-moz-placeholder {
            /* Mozilla Firefox 19+ */
            color: #ccc !important;
            opacity: 1;
        }

        :-ms-input-placeholder {
            /* Internet Explorer 10+ */
            color: #ccc !important;
        }

        input,
        select {
            color: #999 !important;
        }

        .btn {
            color: #fff !important;
        }
    </style>

    <style>
        @font-face {
            font-family: 'American captain';
            src: url('https://uploads-ssl.webflow.com/62a4ae1a77029b4f2e631a4e/6467af776ff8c8010f263c48_American%20Captain.otf') format('opentype');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }

        body {
            background-image: url(https://assets-global.website-files.com/62a4ae1a77029b4f2e631a4e/649096276c987f8deefd0a57_eat.png), url(https://assets-global.website-files.com/62a4ae1a77029b4f2e631a4e/646ef4d502eaff757e319436_Layer%2049%20\(1\).png);
            background-position: 100% 30px, 0 30px;
            background-repeat: no-repeat, no-repeat, no-repeat;
            background-size: auto, auto, auto;
        }

        #event_page_wrap {
            background: none;
        }

        h1 {
            font-family: 'American captain';
            font-size: 70px;
            letter-spacing: 5px;
            color: #fc2222;
        }

        .btn-event-link {
            background-color: #fc2222 !important;
        }

        #organiserHead,
        #footer {
            background: #fc2222 !important;
        }
    </style>

</head>

<body class="attendize">
    <div id="event_page_wrap" vocab="http://schema.org/" typeof="Event">
        @if (!$event->is_live)
            <section id="goLiveBar">
                <div class="container">
                    @if (!$event->is_live)
                        {{ @trans('ManageEvent.event_not_live') }}
                        {!! Form::open([
                            'url' => route('MakeEventLive', ['event_id' => $event->id]),
                            'id' => 'make-event-live-form',
                            'style' => 'display:inline-block;',
                        ]) !!}
                        {!! Form::submit(trans('ManageEvent.publish_it'), ['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
            </section>
        @endif
        <section id="organiserHead" class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div onclick="window.location='#organiser'" class="event_organizer">
                            <b>{{ $event->organiser->name }}</b> @lang('Public_ViewEvent.presents')
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="intro" class="container">
            <div class="row">
                <div class="col-md-12" style="color: black">
                    <h1 property="name">{{ $event->title }}</h1>
                    <div class="event_venue">
                        <span property="startDate" content="{{ $event->start_date->toIso8601String() }}">
                            {{ $event->startDateFormatted() }}
                        </span>
                        -
                        <span property="endDate" content="{{ $event->end_date->toIso8601String() }}">
                            @if ($event->start_date->diffInDays($event->end_date) == 0)
                                {{ $event->end_date->format('H:i') }}
                            @else
                                {{ $event->endDateFormatted() }}
                            @endif
                        </span>
                        @lang('Public_ViewEvent.at')
                        <span property="location" typeof="Place">
                            <b property="name">{{ $event->venue_name }}</b>
                            <meta property="address" content="{{ urldecode($event->venue_name) }}">
                        </span>
                    </div>
                    <style>
                        .h-black:hover,
                        .btn-black {
                            background: #000 !important;
                            color: #fc2222 !important;
                        }
                    </style>
                    {{-- <div class="event_buttons">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <a class="btn btn-event-link btn-lg h-black" href="#tickets">@lang('Public_ViewEvent.TICKETS')</a>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <a class="btn btn-event-link btn-lg h-black" href="#details">@lang('Public_ViewEvent.DETAILS')</a>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <a class="btn btn-event-link btn-lg h-black" href="#location">@lang('Public_ViewEvent.LOCATION')</a>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
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
                                <tr>
                                    <td class="pl0">{{{$ticket['ticket']['title']}}} X <b>{{$ticket['qty']}}</b></td>
                                    <td style="text-align: right;">
                                        @isFree($ticket['full_price'])
                                            @lang("Public_ViewEvent.free")
                                        @else
                                        {{ money($ticket['full_price'], $event->currency) }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        @if($order_total > 0)
                        <div class="panel-footer">
                            <h5>
                                @lang("Public_ViewEvent.total"): <span style="float: right;"><b>{{ $orderService->getOrderTotalWithBookingFee(true) }}</b></span>
                            </h5>
                            @if($event->organiser->charge_tax)
                            <h5>
                                {{ $event->organiser->tax_name }} ({{ $event->organiser->tax_value }}%):
                                <span style="float: right;"><b>{{ $orderService->getTaxAmount(true) }}</b></span>
                            </h5>
                            <h5>
                                <strong>@lang("Public_ViewEvent.grand_total")</strong>
                                <span style="float: right;"><b>{{  $orderService->getGrandTotal(true) }}</b></span>
                            </h5>
                            @endif
                        </div>
                        @endif
        
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
                                    {!! Form::text("order_first_name", null, ['required' => 'required', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    {!! Form::label("order_last_name", trans("Public_ViewEvent.last_name")) !!}
                                    {!! Form::text("order_last_name", null, ['required' => 'required', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label("order_email", trans("Public_ViewEvent.email")) !!}
                                    {!! Form::text("order_email", null, ['required' => 'required', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row"><div class="col-md-12">&nbsp;</div></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="custom-checkbox">
                                        {!! Form::checkbox('is_business', 1, null, ['data-toggle' => 'toggle', 'id' => 'is_business']) !!}
                                        {!! Form::label('is_business', trans("Public_ViewEvent.is_business"), ['class' => 'control-label']) !!}
                                    </div>
                                </div>
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
                            <a href="javascript:void(0);" class="btn btn-event-link btn-xs" id="mirror_buyer_info">
                                @lang("Public_ViewEvent.copy_buyer")
                            </a>
                        </div>
        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ticket_holders_details" >
                                    <h3>@lang("Public_ViewEvent.ticket_holder_information")</h3>
                                    <?php
                                        $total_attendee_increment = 0;
                                    ?>
                                    @foreach($tickets as $ticket)
                                        @for($i=0; $i<=$ticket['qty']-1; $i++)
                                        <div class="panel panel-primary">
        
                                            <div class="panel-heading" style="background: red; border: none">
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
        
                       {!! Form::hidden('is_embedded', $is_embedded) !!}
                       {!! Form::submit(trans("Public_ViewEvent.checkout_order"), ['class' => 'btn btn-lg btn-event-link card-submit', 'style' => 'width:100%;']) !!}
                       {!! Form::close() !!}
        
                    </div>
                </div>
            </div>
            <img src="https://cdn.attendize.com/lg.png" />
        </section>
        @if(session()->get('message'))
            <script>showMessage('{{session()->get('message')}}');</script>
        @endif        
        <script>var OrderExpires = {{strtotime($expires)}};</script>
        <footer id="footer" class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @if (Utils::userOwns($event))
                            &bull;
                            <a class="adminLink "
                                href="{{ route('showEventDashboard', ['event_id' => $event->id]) }}">@lang('Public_ViewEvent.event_dashboard')</a>
                            &bull;
                            <a class="adminLink "
                                href="{{ route('showOrganiserDashboard', ['organiser_id' => $event->organiser->id]) }}">@lang('Public_ViewEvent.organiser_dashboard')</a>
                        @endif
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
