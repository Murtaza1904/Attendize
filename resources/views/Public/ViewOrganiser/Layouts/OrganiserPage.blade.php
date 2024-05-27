<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{{$organiser->name}}} - {{ config('app.name') }}</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
        <meta property="og:title" content="{{{$organiser->name}}}" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="{{ route('home') }}" />
        <meta property="og:image" content="{{URL::to($organiser->full_logo_path)}}" />
        <meta property="og:description" content="{{{md_to_html($organiser->description, 20)}}}" />
        <meta property="og:site_name" content="{{ config('app.name') }}" />
       {!!Html::style('assets/stylesheet/frontend.css')!!}
        @yield('head')
    </head>
    <body class="attendize">
        @include('Shared.Partials.FacebookSdk')
        <div id="organiser_page_wrap">
            @yield('content')
        </div>

        <a href="#intro" style="display:none;" class="totop"><i class="ico-angle-up"></i>
            <span style="font-size:11px;">@lang("basic.TOP")</span></a>

        @include("Shared.Partials.LangScript")
        {!!Html::script('assets/javascript/frontend.js')!!}

        @include('Shared.Partials.GlobalFooterJS')
        @yield('foot')
</body>
</html>
