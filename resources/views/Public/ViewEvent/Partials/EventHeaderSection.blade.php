<style>
    #organiserHead
    {
        background-color: #000 !important;
        opacity: 1 !important;
    }

    .btn-black {
        background-color: #000 !important;
    }

    .text-black {
        color: #000;
    }
</style>
@if(!$event->is_live)
<section id="goLiveBar">
    <div class="container">
        @if(!$event->is_live)
            {{ @trans("ManageEvent.event_not_live") }}
            {!! Form::open(['url' => route('MakeEventLive', ['event_id' => $event->id]), 'id' => 'make-event-live-form', 'style' => 'display:inline-block;']) !!}
                {!! Form::submit(trans('ManageEvent.publish_it'), ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
        @endif
    </div>
</section>
@endif
<section id="organiserHead" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div onclick="window.location='{{$event->event_url}}#organiser'" class="event_organizer">
                    <b>{{$event->organiser->name}}</b> @lang("Public_ViewEvent.presents")
                </div>
            </div>
        </div>
    </div>
</section>
<section id="intro" class="container">
    <div class="row">
        <div class="col-md-12 text-black">
            <h1 property="name">{{$event->title}}</h1>
            <div class="event_venue" style="color: #000">
                <span property="startDate" content="{{ $event->start_date->toIso8601String() }}">
                    {{ $event->start_date->format('l F d h:i A') }}
                </span>
                -
                <span property="endDate" content="{{ $event->end_date->toIso8601String() }}">
                     @if($event->start_date->diffInDays($event->end_date) == 0)
                        {{ $event->end_date->format('H:i') }}
                     @else
                        {{ $event->end_date->format('l F d h:i A')}}
                     @endif
                </span>
                @lang("Public_ViewEvent.at")
                <span property="location" typeof="Place">
                    <b property="name">{{$event->venue_name}}</b>
                    <meta property="address" content="{{ urldecode($event->venue_name) }}">
                </span>
            </div>

            <div class="event_buttons">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-event-link btn-black btn-lg" href="{{{$event->event_url}}}#tickets">@lang("Public_ViewEvent.TICKETS")</a>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-event-link btn-black btn-lg" href="{{{$event->event_url}}}#details">@lang("Public_ViewEvent.DETAILS")</a>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <a class="btn btn-event-link btn-black btn-lg" href="{{{$event->event_url}}}#location">@lang("Public_ViewEvent.LOCATION")</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
