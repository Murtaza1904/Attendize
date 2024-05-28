@extends('en.Emails.Layouts.Master')

@section('message_content')
    Hello {{ $client->first_name ?? 'User' }},<br><br>

    Your login OTP is <b>{{ $client->otp }}</b>.
    <br />
    Regards
@endsection
