@extends('Emails.Layouts.Master')

@section('message_content')

@lang("basic.hello") {{ $attendee->first_name }},<br><br>

{{ @trans("Order_Emails.tickets_attached") }} <a href="{{route('showOrderDetails', ['order_reference' => $attendee->order->order_reference])}}">{{route('showOrderDetails', ['order_reference' => $attendee->order->order_reference])}}</a>.
<div style="display: flex; justify-content: center">
    <a href="{{ route('showOrderTickets', ['order_reference' => $attendee->order->order_reference] ).'?download=1' }}" 
        style="background: #fc2222; padding-inline: 100px; padding-block: 10px; color: #fff; border-radius: 5px; margin-block: 10px; text-decoration: none">
        Download Your Ticket
    </a>
</div>
<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; margin-top: 10px;">
    <span>To register yourself on this website, please click the button below.</span>
    <a style="padding-inline: 15px; padding-block: 10px; background: #fc2222; color:#fff; text-decoration: none; border-radius: 4px; margin-top: 5px" href="{{ route('client-login.show') }}">
        Register
    </a>
</div>
@stop
