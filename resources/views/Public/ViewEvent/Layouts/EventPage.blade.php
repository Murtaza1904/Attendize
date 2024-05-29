<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{{$event->title}}} - {{ config('app.name') }}</title>
        <link href="{{ asset('assets/images/favicon.png') }}" rel="shortcut icon" type="image/x-icon"/>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
        <link rel="canonical" href="{{ route('home') }}" />
        <meta property="og:title" content="{{{$event->title}}}" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="{{ route('home') }}?utm_source=fb" />
        @if($event->images->count())
        <meta property="og:image" content="{{config('attendize.cdn_url_user_assets').'/'.$event->images->first()['image_path']}}" />
        @endif
        <meta property="og:description" content="{{{Str::words(md_to_str($event->description), 20)}}}" />
        <meta property="og:site_name" content="Attendize.com" />
        @yield('head')
       {!!Html::style(config('attendize.cdn_url_static_assets').'/assets/stylesheet/frontend.css')!!}
        <style>
            ::-webkit-input-placeholder {
                color:    #ccc !important;
            }
            :-moz-placeholder {
                color:    #ccc !important;
                opacity:  1;
            }
            ::-moz-placeholder {
                color:    #ccc !important;
                opacity:  1;
            }
            :-ms-input-placeholder {
                color:    #ccc !important;
            }

            input, select {
                color: #999 !important;
            }

            .btn {
                color: #fff !important;
            }

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

            .btn-event-link, .btn-success {
                background-color: #fc2222 !important;
                border: none;
            }
            .btn-event-link:hover, .btn-success:hover {
                background-color: #000 !important;
            }
        </style>
    </head>
    <body class="attendize">
        <div id="event_page_wrap" vocab="http://schema.org/" typeof="Event">
            @yield('content')

            {{-- Push for sticky footer--}}
            @stack('footer')
        </div>
        @yield('footer')

        @include("Shared.Partials.LangScript")
        {!!Html::script(config('attendize.cdn_url_static_assets').'/assets/javascript/frontend.js')!!}


        @if(isset($secondsToExpire))
        <script>if($('#countdown')) {setCountdown($('#countdown'), {{$secondsToExpire}});}</script>
        @endif

        @include('Shared.Partials.GlobalFooterJS')
    </body>
</html>
