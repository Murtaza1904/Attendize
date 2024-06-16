@component('mail::message')
    # New Exception occurred


    ## From : {{ request()->url() }}


    ## Message : {!! $exception[0] !!}


    ## File Location : {!! $exception[1] !!}


    Thanks,
    {{ config('app.name') }}
@endcomponent
