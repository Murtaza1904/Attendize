<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tickets</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('assets/stylesheet/frontend.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KBQ8RTT');</script>
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
        .rrssb-buttons li a{
            background-color: #000 !important;
            margin-block: 10px;
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

        #organiserHead, #footer {
            background: #000 !important;
        }
    </style>
    <style>
        @font-face { 
        font-family:webflow-icons;
        src:url(data:application/x-font-ttf;charset=utf-8;base64,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)format("truetype");
        font-weight:400;
        font-style:normal;
        } 
        @import url('https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap'); 
        body {  
            color:#333;
            font-family:sans-serif;
            font-size:16px;
            line-height:20px;
        }  
        * { 
            box-sizing: border-box;
        } 

        body { 
            margin: 0;
        } 

        body { 
            color: #333; 
            background-color: #fff; 
            min-height: 100%; 
            margin: 0; 
            font-family: Arial,sans-serif; 
            font-size: 14px; 
            line-height: 20px;
        } 

        body { 
            color: #333; 
            font-family: Montserrat,sans-serif; 
            font-size: 16px; 
            line-height: 20px;
        } 

        body { 
            top: 0px !important;
        } 

        html { 
            -webkit-text-size-adjust: 100%; 
            -ms-text-size-adjust: 100%; 
            font-family: sans-serif;
        } 

        html { 
            height: 100%;
        } 

        :root { 
            --red: #fc2222; 
            --black: black; 
        } 

        .w-container { 
            max-width: 940px; 
            margin-left: auto; 
            margin-right: auto;
        } 

        .faq-container { 
            border: 0 solid transparent; 
            border-radius: 14px; 
            padding-bottom: 20px; 
            padding-left: 20px; 
            padding-right: 20px;
        } 

        .w-container:before,.w-container:after { 
            content: " "; 
            grid-area: 1/1/2/2; 
            display: table;
        } 

        .w-container:after { 
            clear: both;
        } 

        h1 { 
            margin: .67em 0; 
            font-size: 2em;
        } 

        h1 { 
            margin-bottom: 10px; 
            font-weight: 700;
        } 

        h1 { 
            margin-top: 20px; 
            font-size: 38px; 
            line-height: 44px;
        } 

        h1 { 
            margin-top: 20px; 
            margin-bottom: 10px; 
            font-size: 38px; 
            line-height: 44px;
        } 

        .faqheading-108 { 
            color: var(--black); 
            text-align: center; 
            margin-bottom: 30px; 
            font-family: Montserrat,sans-serif; 
            font-size: 38px;
        } 

        .w-dropdown { 
            text-align: left; 
            z-index: 900; 
            margin-left: auto; 
            margin-right: auto; 
            display: inline-block; 
            position: relative;
        } 

        .accordion-item { 
            float: none; 
            text-align: left; 
            width: 100%; 
            margin: 0 0 30px; 
            overflow: hidden;
        } 

        .w-dropdown-toggle { 
            vertical-align: top; 
            color: #222; 
            text-align: left; 
            white-space: nowrap; 
            margin-left: auto; 
            margin-right: auto; 
            padding: 20px; 
            text-decoration: none; 
            position: relative;
        } 

        .w-dropdown-toggle { 
            -webkit-user-select: none; 
            -ms-user-select: none; 
            user-select: none; 
            cursor: pointer; 
            padding-right: 40px; 
            display: inline-block;
        } 

        .accordion-toggle-2 { 
            background-color: var(--red); 
            border-radius: 0; 
            height: 70px; 
            padding-top: 10px; 
            padding-bottom: 10px; 
            display: flex;
        } 

        nav { 
            display: block;
        } 

        .w-dropdown-list { 
            background: #ddd; 
            min-width: 100%; 
            display: none; 
            position: absolute;
        }

        .dropdown-list-3 { 
            background-color: #fff; 
            height: auto; 
            padding: 20px 0; 
            display: block; 
            position: static;
        } 

        [class*=" w-icon-"] { 
            speak: none; 
            font-variant: normal; 
            text-transform: none; 
            -webkit-font-smoothing: antialiased; 
            -moz-osx-font-smoothing: grayscale; 
            font-style: normal; 
            font-weight: 400; 
            line-height: 1; 
            font-family: webflow-icons!important;
        } 

        .w-icon-dropdown-toggle { 
            width: 1em; 
            height: 1em; 
            margin: auto 20px auto auto; 
            position: absolute; 
            top: 0; 
            bottom: 0; 
            right: 0;
        } 

        .accordion-icon { 
            color: #fff; 
            background-color: transparent; 
            font-size: 18px;
        } 

        .w-icon-arrow-down:before,.w-icon-dropdown-toggle:before { 
            content: "";
        } 

        .text-block-24 { 
            color: #fff; 
            align-self: center; 
            width: 100%; 
            height: auto; 
            font-size: 20px; 
            font-weight: 600;
        } 

        a { 
            background-color: transparent;
        } 

        a { 
            color: var(--red); 
            font-weight: 500; 
            text-decoration: underline;
        } 

        .w-dropdown-link { 
            vertical-align: top; 
            color: #222; 
            text-align: left; 
            white-space: nowrap; 
            margin-left: auto; 
            margin-right: auto; 
            padding: 20px; 
            text-decoration: none; 
            position: relative;
        } 

        .w-dropdown-link { 
            color: #222; 
            padding: 10px 20px; 
            display: block;
        } 

        .dropdown-link-4 { 
            color: #000; 
            white-space: break-spaces; 
            cursor: default; 
            align-items: stretch; 
            width: 100%; 
            height: auto; 
            margin: auto; 
            padding: 10px 20px; 
            font-family: Montserrat,sans-serif; 
            font-size: 18px; 
            font-weight: 500; 
            line-height: 25px; 
            display: block;
        } 

        a:active,a:hover { 
            outline: 0;
        } 

        [class^="w-icon-"], [class*=" w-icon-"] { 
            speak: none; 
            font-variant: normal; 
            text-transform: none; 
            -webkit-font-smoothing: antialiased; 
            -moz-osx-font-smoothing: grayscale; 
            font-style: normal; 
            font-weight: 400; 
            line-height: 1; 
            font-family: webflow-icons!important;
        } 

        strong { 
            font-weight: 700;
        } 

        strong { 
            color: var(--red); 
            font-size: 70px; 
            font-weight: 500;
        } 

        .faq-bold-text { 
            color: #fff; 
            font-size: 22px;
        } 

        .text-span-52 { 
            color: var(--red); 
            cursor: pointer; 
            font-weight: 700;
        } 


        /* These were inline style tags. Uses id+class to override almost everything */
        #style-aPEiH.style-aPEiH {  
        height: 70px;  
        }

        .show {
            width: 100%;
            z-index: 901;
        }

        #style-ohEWj.style-ohEWj {  
        height: 70px;  
        }  
        #style-XrOy4.style-XrOy4 {  
        height: 70px;  
        }  
        #style-OdSj6.style-OdSj6 {  
        height: 70px;  
        }  
        #style-V3oIU.style-V3oIU {  
        height: 70px;  
        }  
        #style-ZOQee.style-ZOQee {  
        height: 70px;  
        }  
        #style-tOnGG.style-tOnGG {  
        height: 70px;  
        }  
        #style-rNZe1.style-rNZe1 {  
        height: 70px;  
        }  
        #style-MTIz7.style-MTIz7 {  
        height: 70px;  
        }  
        #style-1bW1Y.style-1bW1Y {  
        height: 70px;  
        }  
        #style-N53TH.style-N53TH {  
        height: 70px;  
        }  
        .ticket_name{
            width: 85%;
        }
        .ticket_select{
            width: 15%;
            position: absolute;
        }
        .label_discount{
            width: 170px;
        }
        /* CSS rules for devices with a viewport width of 768px or less */
        @media (max-width: 768px) {
            body{
                background-position: 133% 30px, -13px 30px;
            }
            .content{
                padding: 0px !important;
            }
            .ticket_name{
            width: 100% !important;
            }
             .ticket_select{
            width: 30% !important;
            }
            .cards_image{
                display: none !important;
            }
            .label_discount{
            width: 100%;
        }
        
        .faq-bold-text{
            font-size: 16px;
        }
        }
            </style>
</head>

<body class="attendize">
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KBQ8RTT"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <div id="event_page_wrap" vocab="http://schema.org/" typeof="Event">
        @include('Public.ViewEvent.Partials.EventHeaderSection')
        <section id="tickets" class="container">
            <div class="row">
                <h1 class='section_head'>
                    @lang("Public_ViewEvent.tickets")
                </h1>
            </div>
        
            @if($event->end_date->isPast())
                <div class="alert alert-boring">
                    @lang("Public_ViewEvent.event_already", ['started' => trans('Public_ViewEvent.event_already_ended')])
                </div>
            @else
        
                @if($tickets->where('is_hidden', false)->where('is_paused', false)->count() > 0)
        
                    {!! Form::open(['url' => route('postValidateTickets', ['event_id' => $event->id]), 'class' => 'ajax']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="content">
                                <div class="tickets_table_wrap">
                                    <table class="table">
                                        <?php
                                            $is_free_event = true;
                                        ?>
                                        @foreach($tickets->where('is_hidden', false)->where('is_paused', false) as $ticket)
                                            <tr class="ticket" property="offers" typeof="Offer" style="border: 1px solid lightgray; border-bottom: 0">
                                                <td class="ticket_name" style="border: none; padding-left: 10px">
                                                    <input type="hidden" name="ticket_title_{{ $ticket->id }}" value="{{ $ticket->title }}">
                                                    <span class="ticket-title semibold" property="name" id="ticket-title">
                                                        {{$ticket->title}}
                                                    </span>
                                                </td>
                                                <td class="ticket_select" style="border: none">
                                                    @if($ticket->sale_status === config('attendize.ticket_status_sold_out'))
                                                        <span class="text-danger" property="availability"
                                                                content="http://schema.org/SoldOut">
                                                            @lang("Public_ViewEvent.sold_out")
                                                        </span>
                                                    @elseif($ticket->sale_status === config('attendize.ticket_status_before_sale_date'))
                                                        <span class="text-danger">
                                                            Up Next
                                                        </span>
                                                    @elseif($ticket->sale_status === config('attendize.ticket_status_after_sale_date'))
                                                        <span class="text-danger">
                                                            @lang("Public_ViewEvent.sales_have_ended")
                                                        </span>
                                                    @else
                                                        {!! Form::hidden('tickets[]', $ticket->id) !!}
                                                        <meta property="availability" content="http://schema.org/InStock">
                                                        <input type="number" name="ticket_{{$ticket->id}}" id="digitInput" class="form-control" placeholder="Qty" value="0"
                                                        min="0" required>
                                                    @endif
                                                </td>
                                            </tr>
                                            @if (!$ticket->is_free)
                                                <tr style="border-inline: 1px solid lightgray">
                                                    <td style="border: none;padding: 0" colspan="3">
                                                        <div class="ticket-pricing" style="padding-inline: 10px">
                                                            @if($ticket->is_free)
                                                                @lang("Public_ViewEvent.free")
                                                                <meta property="price" content="0">
                                                            @else
                                                                <?php
                                                                $is_free_event = false;
                                                                ?>
                                                                <input type="hidden" name="ticket_price_{{ $ticket->id }}" value="{{ $ticket->total_price }}">
                                                                <span title='{{money($ticket->price, $event->currency)}} @lang("Public_ViewEvent.ticket_price") + @lang("Public_ViewEvent.booking_fees")'>{{money($ticket->price, $event->currency)}} Ticket Price + Booking Fees
                                                                </span>
                                                                <span class="tax-amount text-muted text-smaller">{{ ($event->organiser->tax_name && $event->organiser->tax_value) ? '(+'.money(($ticket->total_price*($event->organiser->tax_value)/100), $event->currency).' '.$event->organiser->tax_name.')' : '' }}</span>
                                                                <meta property="priceCurrency"
                                                                    content="{{ $event->currency->code }}">
                                                                <meta property="price"
                                                                    content="{{ number_format($ticket->price, 2, '.', '') }}">
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr style="border-inline: 1px solid lightgray; border-bottom: 1px solid lightgray">
                                                <td colspan="3" style="border: none; padding: 0">
                                                    <p class="ticket-descripton mb0 text-muted" style="padding-inline: 10px ; padding-bottom: 10px" property="description">
                                                        {{$ticket->description}}
                                                    </p>
                                                </td>
                                            </tr>
                                            @if ($ticket->sale_status !== config('attendize.ticket_status_sold_out') && $ticket->sale_status !== config('attendize.ticket_status_before_sale_date') && $ticket->sale_status !== config('attendize.ticket_status_after_sale_date'))
                                                @php
                                                    $remaining = $ticket->quantity_available - $ticket->quantity_sold;
                                                @endphp
                                                @if ($ticket->show_quantity)
                                                    <tr>
                                                        <td style="border-top: none"></td>
                                                        <td colspan="2" style="border-top: none; text-align: right; width: 285px;padding: 0">
                                                            <span style="padding-top: 5px; color: #fc2222">
                                                                {{ $remaining }} tickets are remaining
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                            <tr>
                                                <td style="border: none"></td>
                                            </tr>
                                        @endforeach
                                        @if ($tickets->where('is_hidden', false)->where('is_paused', false)->count() > 0)
                                            <tr>
                                                <td colspan="3" style="text-align: center">
                                                    @lang("Public_ViewEvent.below_tickets")
                                                </td>
                                            </tr>
                                        @endif
                                        <tr class="checkout">
                                            <td style="40%" class="cards_image">
                                                @if(!$is_free_event)
                                                    <div class="cards_image pull-left" style="margin-top: 20px">
                                                        <img class=""
                                                             src="{{asset('assets/images/public/EventPage/credit-card-logos.png')}}"/>
                                                        @if($event->enable_offline_payments)
                                                            <div class="help-block" style="font-size: 11px;">
                                                                @lang("Public_ViewEvent.offline_payment_methods_available")
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            </td>
                                            <td style="30%;">
                                                @if($tickets->where('is_hidden', false)->where('is_paused', false)->count() > 0)
                                                    @if ($event->discountCodes->isNotEmpty())
                                                        <label class="label_discount" for="">Have Discount Code?</label>
                                                        <input type="text" name="discount_code" id="discount_code" placeholder="Enter discount code" class="form-control" style="width: 85%">
                                                    @endif
                                                @endif
                                            </td>
                                            <td style="30%">
                                                @if($tickets->where('is_hidden', false)->where('is_paused', false)->count() > 0)
                                                    <input class="btn btn-lg btn-event-link pull-right h-black" style="margin-top: 20px" type="submit" value="Add To Cart" onclick="googleStore()">
                                                @endif
                                            </td>
                                        </tr>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::hidden('is_embedded', $is_embedded) !!}
                    {!! Form::close() !!}
        
                @else
        
                    <div class="alert alert-boring">
                        @lang("Public_ViewEvent.tickets_are_currently_unavailable")
                    </div>
        
                @endif
        
            @endif
        </section>        
        <section id="details" class="container">
            <div class="row">
                <h1 class="section_head">
                    @lang("Public_ViewEvent.event_details")
                </h1>
            </div>
            <div class="row">
                @php
                    $descriptionColSize =  $event->images->count()
                        && in_array($event->event_image_position, ['left', 'right'])
                        ? '7' : '12';
                @endphp
        
                @if ($event->images->count() && $event->event_image_position == 'left')
                    <div class="col-md-5">
                        <div class="content event_poster">
                            <img alt="{{$event->title}}" src="{{config('attendize.cdn_url_user_assets').'/'.$event->images->first()['image_path']}}" property="image">
                        </div>
                    </div>
                @endif
                @if ($event->images->count() && $event->event_image_position == 'before')
                    <div class="col-md-12" style="margin-bottom: 20px">
                        <div class="content event_poster">
                            <img alt="{{$event->title}}" src="{{config('attendize.cdn_url_user_assets').'/'.$event->images->first()['image_path']}}" property="image">
                        </div>
                    </div>
                @endif
                <div class="col-md-{{ $descriptionColSize }}">
                    <div class="content event_details" property="description">
                        {!! md_to_html($event->description) !!}
                    </div>
                </div>
                @if ($event->images->count() && $event->event_image_position == 'right')
                    <div class="col-md-5">
                        <div class="content event_poster">
                            <img alt="{{$event->title}}" src="{{config('attendize.cdn_url_user_assets').'/'.$event->images->first()['image_path']}}" property="image">
                        </div>
                    </div>
                @endif
                @if ($event->images->count() && $event->event_image_position == 'after')
                    <div class="col-md-12" style="margin-top: 20px">
                        <div class="content event_poster">
                            <img alt="{{$event->title}}" src="{{config('attendize.cdn_url_user_assets').'/'.$event->images->first()['image_path']}}" property="image">
                        </div>
                    </div>
                @endif
            </div>
        </section>        
        @if($event->social_show_facebook || $event->social_show_linkedin || $event->social_show_twitter || $event->social_show_whatsapp || $event->social_show_email)
            <section id="share" class="container">
                <div class="row">
                    <h1 class="section_head">
                        @lang("Public_ViewEvent.share_event")
                    </h1>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="rrssb-buttons clearfix">

                            @if($event->social_show_facebook)
                            <li class="rrssb-facebook">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{$event->event_url}}" class="popup" target="__blank">
                                    <span class="rrssb-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve">
                                            <path d="M27.825,4.783c0-2.427-2.182-4.608-4.608-4.608H4.783c-2.422,0-4.608,2.182-4.608,4.608v18.434
                                                c0,2.427,2.181,4.608,4.608,4.608H14V17.379h-3.379v-4.608H14v-1.795c0-3.089,2.335-5.885,5.192-5.885h3.718v4.608h-3.726
                                                c-0.408,0-0.884,0.492-0.884,1.236v1.836h4.609v4.608h-4.609v10.446h4.916c2.422,0,4.608-2.188,4.608-4.608V4.783z"/>
                                        </svg>
                                    </span>
                                    <span class="rrssb-text">facebook</span>
                                </a>
                            </li>
                            @endif
                            @if($event->social_show_linkedin)
                            <li class="rrssb-linkedin">
                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{$event->event_url}}?title={{urlencode($event->title)}}&amp;summary={{{Str::words(md_to_str($event->description), 20)}}}" class="popup" target="__blank">
                                    <span class="rrssb-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve">
                                            <path d="M25.424,15.887v8.447h-4.896v-7.882c0-1.979-0.709-3.331-2.48-3.331c-1.354,0-2.158,0.911-2.514,1.803
                                                c-0.129,0.315-0.162,0.753-0.162,1.194v8.216h-4.899c0,0,0.066-13.349,0-14.731h4.899v2.088c-0.01,0.016-0.023,0.032-0.033,0.048
                                                h0.033V11.69c0.65-1.002,1.812-2.435,4.414-2.435C23.008,9.254,25.424,11.361,25.424,15.887z M5.348,2.501
                                                c-1.676,0-2.772,1.092-2.772,2.539c0,1.421,1.066,2.538,2.717,2.546h0.032c1.709,0,2.771-1.132,2.771-2.546
                                                C8.054,3.593,7.019,2.501,5.343,2.501H5.348z M2.867,24.334h4.897V9.603H2.867V24.334z"/>
                                        </svg>
                                    </span>
                                    <span class="rrssb-text">linkedin</span>
                                </a>
                            </li>
                            @endif
                            @if($event->social_show_twitter)
                            <li class="rrssb-twitter">
                                <a href="http://twitter.com/intent/tweet?text=Check out: {{$event->event_url}} {{{Str::words(md_to_str($event->description), 20)}}}" class="popup" target="__blank">
                                    <span class="rrssb-icon">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve">
                                            <path d="M24.253,8.756C24.689,17.08,18.297,24.182,9.97,24.62c-3.122,0.162-6.219-0.646-8.861-2.32
                                                c2.703,0.179,5.376-0.648,7.508-2.321c-2.072-0.247-3.818-1.661-4.489-3.638c0.801,0.128,1.62,0.076,2.399-0.155
                                                C4.045,15.72,2.215,13.6,2.115,11.077c0.688,0.275,1.426,0.407,2.168,0.386c-2.135-1.65-2.729-4.621-1.394-6.965
                                                C5.575,7.816,9.54,9.84,13.803,10.071c-0.842-2.739,0.694-5.64,3.434-6.482c2.018-0.623,4.212,0.044,5.546,1.683
                                                c1.186-0.213,2.318-0.662,3.329-1.317c-0.385,1.256-1.247,2.312-2.399,2.942c1.048-0.106,2.069-0.394,3.019-0.851
                                                C26.275,7.229,25.39,8.196,24.253,8.756z"/>
                                        </svg>
                                    </span>
                                    <span class="rrssb-text">twitter</span>
                                </a>
                            </li>
                            @endif
                            @if($event->social_show_whatsapp)
                            <li class="rrssb-whatsapp">
                            <a style="background-color: #43d854;" href="whatsapp://send?text={{urlencode($event->title . ' - ' . $event->event_url)}}" data-action="share/whatsapp/share" target="__blank">
                                    <span class="rrssb-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" viewBox="0 0 90 90"><path d="M90 43.84c0 24.214-19.78 43.842-44.182 43.842a44.256 44.256 0 0 1-21.357-5.455L0 90l7.975-23.522a43.38 43.38 0 0 1-6.34-22.637C1.635 19.63 21.415 0 45.818 0 70.223 0 90 19.628 90 43.84zM45.818 6.983c-20.484 0-37.146 16.535-37.146 36.86 0 8.064 2.63 15.533 7.076 21.61l-4.64 13.688 14.274-4.537A37.122 37.122 0 0 0 45.82 80.7c20.48 0 37.145-16.533 37.145-36.857S66.3 6.983 45.818 6.983zm22.31 46.956c-.272-.447-.993-.717-2.075-1.254-1.084-.537-6.41-3.138-7.4-3.495-.993-.36-1.717-.54-2.438.536-.72 1.076-2.797 3.495-3.43 4.212-.632.72-1.263.81-2.347.27-1.082-.536-4.57-1.672-8.708-5.332-3.22-2.848-5.393-6.364-6.025-7.44-.63-1.076-.066-1.657.475-2.192.488-.482 1.084-1.255 1.625-1.882.543-.628.723-1.075 1.082-1.793.363-.718.182-1.345-.09-1.884-.27-.537-2.438-5.825-3.34-7.977-.902-2.15-1.803-1.793-2.436-1.793-.63 0-1.353-.09-2.075-.09-.722 0-1.896.27-2.89 1.344-.99 1.077-3.788 3.677-3.788 8.964 0 5.288 3.88 10.397 4.422 11.113.54.716 7.49 11.92 18.5 16.223 11.01 4.3 11.01 2.866 12.996 2.686 1.984-.18 6.406-2.6 7.312-5.107.9-2.513.9-4.664.63-5.112z"/></svg>
                                    </span>
                                    <span class="rrssb-text">@lang("Public_ViewEvent.Whatsapp")</span>
                            </a>
                            </li>
                            @endif
                            @if($event->social_show_email)
                            <li class="rrssb-email">
                                <a href="mailto:?subject=Check This Out&body={{urlencode($event->event_url)}}" target="__blank">
                                    <span class="rrssb-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve"><g><path d="M20.111 26.147c-2.336 1.051-4.361 1.401-7.125 1.401c-6.462 0-12.146-4.633-12.146-12.265 c0-7.94 5.762-14.833 14.561-14.833c6.853 0 11.8 4.7 11.8 11.252c0 5.684-3.194 9.265-7.399 9.3 c-1.829 0-3.153-0.934-3.347-2.997h-0.077c-1.208 1.986-2.96 2.997-5.023 2.997c-2.532 0-4.361-1.868-4.361-5.062 c0-4.749 3.504-9.071 9.111-9.071c1.713 0 3.7 0.4 4.6 0.973l-1.169 7.203c-0.388 2.298-0.116 3.3 1 3.4 c1.673 0 3.773-2.102 3.773-6.58c0-5.061-3.27-8.994-9.303-8.994c-5.957 0-11.175 4.673-11.175 12.1 c0 6.5 4.2 10.2 10 10.201c1.986 0 4.089-0.43 5.646-1.245L20.111 26.147z M16.646 10.1 c-0.311-0.078-0.701-0.155-1.207-0.155c-2.571 0-4.595 2.53-4.595 5.529c0 1.5 0.7 2.4 1.9 2.4 c1.441 0 2.959-1.828 3.311-4.087L16.646 10.068z"/></g></svg>
                                    </span>
                                    <span class="rrssb-text">@lang("Public_ViewEvent.email")</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </section>
        @endif
        <section id="location" class="container p0">
            <div class="row">
                <div class="col-md-12">
                    <div class="google-maps content">
                        <iframe frameborder="0" style="border:0;" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q={{$event->map_address}}&amp;aq=0&amp;oq={{$event->map_address}}&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq={{$event->map_address}}&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed"></iframe>
                    </div>
                </div>
            </div>
        </section>
        <script>
            function show(element) {
                var $element = $(element);
                if ($element.hasClass('style-aPEiH')) {
                    $element.removeClass('style-aPEiH').addClass('show');
                } else {
                    $element.addClass('style-aPEiH').removeClass('show');
                }
            }
        </script>
        <section id="faq">
            <div class="faq-container w-container">
                <h1 class="faqheading-108">Frequently Ask Questions</h1>
                @if(isset($faqs))
                @forelse ($faqs as $faq)
                    <div data-hover="false" class="accordion-item w-dropdown style-aPEiH" id="style-aPEiH" onclick="show(this)">
                        <div class="accordion-toggle-2 w-dropdown-toggle" id="w-dropdown-toggle-2" aria-controls="w-dropdown-list-2" aria-haspopup="menu" aria-expanded="false" role="button" tabindex="0">
                            <div class="accordion-icon w-icon-dropdown-toggle" aria-hidden="true"></div>
                            <div class="text-block-24"><strong class="faq-bold-text">{{ $faq->question }}</strong></div>
                        </div>
                        <nav class="dropdown-list-3 w-dropdown-list" id="w-dropdown-list-2" aria-labelledby="w-dropdown-toggle-2"><a href="#" class="dropdown-link-4 w-dropdown-link" tabindex="0">{{ $faq->answer }}</a></nav>
                    </div>
                @empty
                    <div style="color: #fc2222; text-align: center">No FAQ Exists</div>
                @endforelse
                @else
                    <div style="color: #fc2222; text-align: center">No FAQ Exists</div>
                @endif
            </div>
        </section>
        <section id="organiser" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="event_organiser_details" property="organizer" typeof="Organization">
                        <div class="logo">
                            <h1>Halal Ribfest</h1>
                        </div>
                            @if($event->organiser->enable_organiser_page)
                            <a href="{{route('showOrganiserHome', [$event->organiser->id, Str::slug($event->organiser->name)])}}" title="Organiser Page">
                                {{$event->organiser->name}}
                            </a>
                            @else
                                {{$event->organiser->name}}
                            @endif
                        </h3>
                        <div property="description">
                            {!! md_to_html($event->organiser->about) !!}
                        </div>
                        <p>
                            @if($event->organiser->facebook)
                                <a property="sameAs" href="https://fb.com/{{$event->organiser->facebook}}" class="btn btn-facebook" target="__blank">
                                    <i class="ico-facebook"></i>&nbsp; @lang("Public_ViewEvent.Facebook")
                                </a>
                            @endif
                                @if($event->organiser->twitter)
                                    <a property="sameAs" href="https://twitter.com/{{$event->organiser->twitter}}" class="btn btn-twitter" target="__blank">
                                        <i class="ico-twitter"></i>&nbsp; @lang("Public_ViewEvent.Twitter")
                                    </a>
                                @endif
                            <button onclick="$(function(){ $('.contact_form').slideToggle(); });" type="button" class="btn btn-event-link h-black">
                                <i class="ico-envelop"></i>&nbsp; @lang("Public_ViewEvent.Contact")
                            </button>
                        </p>
                        <div class="contact_form well well-sm">
                            {!! Form::open(['url' => route('postContactOrganiser', ['event_id' => $event->id]), 'class' => 'reset ajax', 'id' => 'contact-form']) !!}
                            <h3>@lang("Public_ViewEvent.Contact") <i>{{$event->organiser->name}}</i></h3>
                            <div class="form-group">
                                {!! Form::label(trans("Public_ViewEvent.your_name")) !!}
                                {!! Form::text('name', null,
                                    array('required',
                                          'class'=>'form-control',
                                          'placeholder'=>trans("Public_ViewEvent.your_name"))) !!}
                            </div>
        
                            <div class="form-group">
                                {!! Form::label(trans("Public_ViewEvent.your_email_address")) !!}
                                {!! Form::text('email', null,
                                    array('required',
                                          'class'=>'form-control',
                                          'placeholder'=>trans("Public_ViewEvent.your_email_address"))) !!}
                            </div>
        
                            <div class="form-group">
                                {!! Form::label(trans("Public_ViewEvent.your_message")) !!}
                                {!! Form::textarea('message', null,
                                    array('required',
                                          'class'=>'form-control',
                                          'placeholder'=>trans("Public_ViewEvent.your_message"))) !!}
                            </div>
        
                            @include('Public.LoginAndRegister.Partials.CaptchaSection')
        
                            <div class="form-group">
                                <p><input class="btn btn-primary" type="submit" value="@lang('Public_ViewEvent.send_message_submit')"></p>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
        @include('Public.ViewEvent.Partials.EventFooterSection')
    </div>

    <a href="#intro" style="display:none;" class="totop"><i class="ico-angle-up"></i>
        <span style="font-size:11px;">TOP</span></a>

    <script src="{{ asset('assets/javascript/frontend.js') }}"></script>
    <script>
        $('#digitInput').on('keydown', function(e) {
            // Allow: backspace, delete, tab, escape, enter, and period (if decimal is needed)
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
                // Allow: Ctrl/cmd+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: Ctrl/cmd+C
                (e.keyCode === 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: Ctrl/cmd+X
                (e.keyCode === 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    </script>
    <script>
        function googleStore() {
            var items = [];
            var totalPrice = 0;
            var currency = "{{ $event->currency->code }}";

            $.each($("input[name='tickets[]']"), function (key, value) { 
                var ticketId = $(value).val();
                var ticketQuantity = $("input[name='ticket_" + ticketId + "']").val();
                
                if (ticketQuantity > 0) {
                    var item = {
                        item_id: ticketId,
                        item_name: $("input[name='ticket_title_" + ticketId + "']").val(), 
                        price: $("input[name='ticket_price_" + ticketId + "']").val(), 
                        quantity: ticketQuantity
                    };
                    items.push(item);
                    totalPrice += parseFloat(item.price) * ticketQuantity;
                }
            });
            dataLayer.push({ ecommerce: null });
            dataLayer.push({
                event: "add_to_cart",
                ecommerce: {
                    currency: currency,
                    value: totalPrice,
                    items: items,
                }
            });
        }
    </script>
</body>

</html>
