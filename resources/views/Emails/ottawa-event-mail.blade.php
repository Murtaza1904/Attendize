@extends('Emails.Layouts.Master')

@section('message_content')
Dear {{ $order->full_name }},<br><br>

We are pleased to inform you that your Halal Ribfest Ottawa event ticket provides complimentary access to OC Transpo buses and the O-Train on the event day.<br><br>

For more details on getting to the venue, please visit TD Place Getting Here <a href="https://www.tdplace.ca/getting-here-td-place">[https://www.tdplace.ca/getting-here-td-place]</a><br><br>

We look forward to seeing you at Halal Ribfest Ottawa!<br><br>

Best regards,<br>
The Halal Ribfest Team
@stop
