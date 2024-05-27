<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{{$event->title}}} - {{ config('app.name') }}</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
        <link rel="canonical" href="{{ route('home') }}" />
        <meta property="og:title" content="{{{$event->title}}}" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="{{ route('home') }}?utm_source=fb" />
        @if($event->images->count())
        <meta property="og:image" content="{{URL::to($event->images->first()['image_path'])}}" />
        @endif
        <meta property="og:description" content="{{{Str::words(md_to_str($event->description), 20)}}}" />
        <meta property="og:site_name" content="{{ config('app.name') }}" />
        @yield('head')

       {!!Html::style('assets/stylesheet/frontend.css')!!}

        <!--Bootstrap placeholder fix-->
        <style>
            ::-webkit-input-placeholder { /* WebKit browsers */
                color:    #ccc !important;
            }
            :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
                color:    #ccc !important;
                opacity:  1;
            }
            ::-moz-placeholder { /* Mozilla Firefox 19+ */
                color:    #ccc !important;
                opacity:  1;
            }
            :-ms-input-placeholder { /* Internet Explorer 10+ */
                color:    #ccc !important;
            }

            input, select {
                color: #999 !important;
            }

            .btn {
                color: #fff !important;
            }
        </style>

        <style type="text/css">
            body {background:none !important;}
            body {background:none transparent !important;}
        </style>
    </head>
    <body class="attendize">
        @yield('content')

        @include("Shared.Partials.LangScript")
        {!!Html::script('assets/javascript/frontend.js')!!}

        @if(isset($secondsToExpire))
        <script>
            // TODO: hardcoded english phrases
            if ($('#countdown')) {setCountdown($('#countdown'), {{$secondsToExpire}}); }
        </script>
        @endif

        @include('Shared.Partials.GlobalFooterJS')
    </body>
</html>
