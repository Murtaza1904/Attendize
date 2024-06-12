@extends('Emails.Layouts.Master')

@section('message_content')

@lang("basic.hello") {{ $attendee->first_name }},<br><br>

{{ @trans("Order_Emails.tickets_attached") }} <a href="{{route('showOrderDetails', ['order_reference' => $attendee->order->order_reference])}}">{{route('showOrderDetails', ['order_reference' => $attendee->order->order_reference])}}</a>.

<span>
    Click on the button to view your orders history
    <a style="padding-inline: 15px; padding-block: 10px; background: #fc2222; text-decoration: none" href="{{ route('client-login.show') }}">
        Button
    </a>
</span>
@stop
