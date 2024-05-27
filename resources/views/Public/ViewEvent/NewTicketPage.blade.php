<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tickets</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('assets/stylesheet/frontend.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
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

        #organiserHead, #footer {
            background: #000 !important;
        }
    </style>

</head>

<body class="attendize">
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
        
                @if($tickets->count() > 0)
        
                    {!! Form::open(['url' => route('postValidateTickets', ['event_id' => $event->id]), 'class' => 'ajax']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="content">
                                <div class="tickets_table_wrap">
                                    <table class="table">
                                        <?php
                                        $is_free_event = true;
                                        ?>
                                        @foreach($tickets->where('is_hidden', false) as $ticket)
                                            <tr class="ticket" property="offers" typeof="Offer">
                                                <td>
                                        <span class="ticket-title semibold" property="name">
                                            {{$ticket->title}}
                                        </span>
                                                    <p class="ticket-descripton mb0 text-muted" property="description">
                                                        {{$ticket->description}}
                                                    </p>
                                                </td>
                                                <td style="width:200px; text-align: right;">
                                                    <div class="ticket-pricing" style="margin-right: 20px;">
                                                        @if($ticket->is_free)
                                                            @lang("Public_ViewEvent.free")
                                                            <meta property="price" content="0">
                                                        @else
                                                            <?php
                                                            $is_free_event = false;
                                                            ?>
                                                            {{-- <span title='{{money($ticket->price, $event->currency)}} @lang("Public_ViewEvent.ticket_price") + {{money($ticket->total_booking_fee, $event->currency)}} @lang("Public_ViewEvent.booking_fees")'>{{money($ticket->total_price, $event->currency)}} 
                                                            </span> --}}
                                                            <span title='{{money($ticket->price, $event->currency)}} @lang("Public_ViewEvent.ticket_price") + @lang("Public_ViewEvent.booking_fees")'>{{money($ticket->price, $event->currency)}} Ticket Price 
                                                            </span>
                                                            <div> + Booking Fees</div>
                                                            <span class="tax-amount text-muted text-smaller">{{ ($event->organiser->tax_name && $event->organiser->tax_value) ? '(+'.money(($ticket->total_price*($event->organiser->tax_value)/100), $event->currency).' '.$event->organiser->tax_name.')' : '' }}</span>
                                                            <meta property="priceCurrency"
                                                                  content="{{ $event->currency->code }}">
                                                            <meta property="price"
                                                                  content="{{ number_format($ticket->price, 2, '.', '') }}">
                                                        @endif
                                                    </div>
                                                </td>
                                                <td style="width:85px;">
                                                    @if($ticket->is_paused)
        
                                                        <span class="text-danger">
                                            @lang("Public_ViewEvent.currently_not_on_sale")
                                        </span>
        
                                                    @else
        
                                                        @if($ticket->sale_status === config('attendize.ticket_status_sold_out'))
                                                            <span class="text-danger" property="availability"
                                                                  content="http://schema.org/SoldOut">
                                            @lang("Public_ViewEvent.sold_out")
                                        </span>
                                                        @elseif($ticket->sale_status === config('attendize.ticket_status_before_sale_date'))
                                                            <span class="text-danger">
                                            @lang("Public_ViewEvent.sales_have_not_started")
                                        </span>
                                                        @elseif($ticket->sale_status === config('attendize.ticket_status_after_sale_date'))
                                                            <span class="text-danger">
                                            @lang("Public_ViewEvent.sales_have_ended")
                                        </span>
                                                        @else
                                                            {!! Form::hidden('tickets[]', $ticket->id) !!}
                                                            <meta property="availability" content="http://schema.org/InStock">
                                                            {{-- <select name="ticket_{{$ticket->id}}" class="form-control"
                                                                    style="text-align: center">
                                                                @if ($tickets->count() > 1)
                                                                    <option value="0">0</option>
                                                                @endif
                                                                @for($i=$ticket->min_per_person; $i<=$ticket->max_per_person; $i++)
                                                                    <option value="{{$i}}">{{$i}}</option>
                                                                @endfor
                                                            </select> --}}
                                                            <input type="number" name="ticket_{{$ticket->id}}" class="form-control" placeholder="Qty" value="0" required>
                                                        @endif
        
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($tickets->where('is_hidden', true)->count() > 0)
                                        <tr class="has-access-codes" data-url="{{route('postShowHiddenTickets', ['event_id' => $event->id])}}">
                                            <td colspan="3"  style="text-align: left">
                                                @lang("Public_ViewEvent.has_unlock_codes")
                                                <div class="form-group" style="display:inline-block;margin-bottom:0;margin-left:15px;">
                                                    {!!  Form::text('unlock_code', null, [
                                                    'class' => 'form-control',
                                                    'id' => 'unlock_code',
                                                    'style' => 'display:inline-block;width:65%;text-transform:uppercase;',
                                                    'placeholder' => 'ex: UNLOCKCODE01',
                                                ]) !!}
                                                    {!! Form::button(trans("basic.apply"), [
                                                        'class' => "btn btn-success",
                                                        'id' => 'apply_access_code',
                                                        'style' => 'display:inline-block;margin-top:-2px;',
                                                        'data-dismiss' => 'modal',
                                                    ]) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="3" style="text-align: center">
                                                @lang("Public_ViewEvent.below_tickets")
                                            </td>
                                        </tr>
                                        <tr class="checkout">
                                            <td colspan="3">
                                                @if(!$is_free_event)
                                                    <div class="hidden-xs pull-left">
                                                        <img class=""
                                                             src="{{asset('assets/images/public/EventPage/credit-card-logos.png')}}"/>
                                                        @if($event->enable_offline_payments)
        
                                                            <div class="help-block" style="font-size: 11px;">
                                                                @lang("Public_ViewEvent.offline_payment_methods_available")
                                                            </div>
                                                        @endif
                                                    </div>
        
                                                @endif
                                                {!!Form::submit('Add To Cart', ['class' => 'btn btn-lg btn-event-link pull-right h-black'])!!}
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
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{$event->event_url}}" class="popup">
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
                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{$event->event_url}}?title={{urlencode($event->title)}}&amp;summary={{{Str::words(md_to_str($event->description), 20)}}}" class="popup">
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
                                <a href="http://twitter.com/intent/tweet?text=Check out: {{$event->event_url}} {{{Str::words(md_to_str($event->description), 20)}}}" class="popup">
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
                            <a style="background-color: #43d854;" href="whatsapp://send?text={{urlencode($event->title . ' - ' . $event->event_url)}}" data-action="share/whatsapp/share">
                                    <span class="rrssb-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" viewBox="0 0 90 90"><path d="M90 43.84c0 24.214-19.78 43.842-44.182 43.842a44.256 44.256 0 0 1-21.357-5.455L0 90l7.975-23.522a43.38 43.38 0 0 1-6.34-22.637C1.635 19.63 21.415 0 45.818 0 70.223 0 90 19.628 90 43.84zM45.818 6.983c-20.484 0-37.146 16.535-37.146 36.86 0 8.064 2.63 15.533 7.076 21.61l-4.64 13.688 14.274-4.537A37.122 37.122 0 0 0 45.82 80.7c20.48 0 37.145-16.533 37.145-36.857S66.3 6.983 45.818 6.983zm22.31 46.956c-.272-.447-.993-.717-2.075-1.254-1.084-.537-6.41-3.138-7.4-3.495-.993-.36-1.717-.54-2.438.536-.72 1.076-2.797 3.495-3.43 4.212-.632.72-1.263.81-2.347.27-1.082-.536-4.57-1.672-8.708-5.332-3.22-2.848-5.393-6.364-6.025-7.44-.63-1.076-.066-1.657.475-2.192.488-.482 1.084-1.255 1.625-1.882.543-.628.723-1.075 1.082-1.793.363-.718.182-1.345-.09-1.884-.27-.537-2.438-5.825-3.34-7.977-.902-2.15-1.803-1.793-2.436-1.793-.63 0-1.353-.09-2.075-.09-.722 0-1.896.27-2.89 1.344-.99 1.077-3.788 3.677-3.788 8.964 0 5.288 3.88 10.397 4.422 11.113.54.716 7.49 11.92 18.5 16.223 11.01 4.3 11.01 2.866 12.996 2.686 1.984-.18 6.406-2.6 7.312-5.107.9-2.513.9-4.664.63-5.112z"/></svg>
                                    </span>
                                    <span class="rrssb-text">@lang("Public_ViewEvent.Whatsapp")</span>
                            </a>
                            </li>
                            @endif
                            @if($event->social_show_email)
                            <li class="rrssb-email">
                                <a href="mailto:?subject=Check This Out&body={{urlencode($event->event_url)}}">
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
                                <a property="sameAs" href="https://fb.com/{{$event->organiser->facebook}}" class="btn btn-facebook">
                                    <i class="ico-facebook"></i>&nbsp; @lang("Public_ViewEvent.Facebook")
                                </a>
                            @endif
                                @if($event->organiser->twitter)
                                    <a property="sameAs" href="https://twitter.com/{{$event->organiser->twitter}}" class="btn btn-twitter">
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

</body>

</html>
