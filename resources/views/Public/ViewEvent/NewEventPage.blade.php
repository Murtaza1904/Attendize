<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/new-events.css') }}">
    <title>Events</title>
</head>
<body>
    <div class="new-header">
        <div class="new-hero">
            <div class="hr_container">
                <div data-w-id="820fbb33-189e-2109-cb2f-83084afaa661"
                    style="opacity: 1; transform: translate3d(0px, 0px, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg); transform-style: preserve-3d;"
                    class="new-hero_heading-wrap">
                    <h1 class="new-hero_heading"><span class="hero-span">ribfest </span>season is back!</h1>
                </div>
                <div data-w-id="467137cc-d9cc-7e3c-9c90-6667c27a2278"
                    style="opacity: 1; transform: translate3d(0px, 0px, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg); transform-style: preserve-3d;"
                    class="new-hero_text-wrap">
                    <!-- <div class="regular-text">Sponsor &amp; Vendor Bookings for 2024 Open Now! Sign Up Here.</div> -->
                </div>
            </div>
        </div>
        <div class="html-embed-6">
            <div data-poster-url="{{ asset('assets/images/events/black-background.jpg') }}"
                data-video-urls="{{ asset('assets/videos/events/hero.mp4') }}"
                data-autoplay="true" data-loop="true" data-wf-ignore="true" class="background-video-5">
                <video id="6e7d8527-4ffe-48b3-2b9e-90251a4d7023-video" autoplay="" loop=""
                    style="background-image:url(&quot;{{ asset('assets/images/events/black-background.jpg') }}&quot;)"
                    muted="" playsinline="" data-wf-ignore="true" data-object-fit="cover">
                    <source
                        src="{{ asset('assets/videos/events/hero.mp4') }}"
                        data-wf-ignore="true">
                </video>
            </div>
        </div>
    </div>
    <!-- Events -->
    <div class="sec_north-america snipcss-3BCec">
        <div class="hr_container">
            <div class="north-america_heading-wrap">
                <h2 data-w-id="fdc4125d-1a01-2d17-fc10-6535c38f9dc5" class="north-america_heading style-5vqcn"
                    id="style-5vqcn">north america <span class="text-red">tour</span> 2024</h2>
            </div>
            <div data-w-id="32bb5536-5a8c-9683-0d9f-4916b4d75dce" class="north-america_text-wrap style-POpmn"
                id="style-POpmn">
                <div class="regular-text" style="color: black !important">The Halal Ribfest 2024 Tour lineup will be featured in many cities across
                    the&nbsp;US&nbsp;and&nbsp;Canada!</div>
            </div>
            <div class="north-america-cards">
                @forelse ($events as $event)
                    <a href="{{ route('events.tickets.index', $event->id) }}" data-w-id="fdec3628-e13c-ee0b-7b79-716a88359aaa" class="north-card-wrapper">
                        {{-- <div id="w-node-_6b0c7410-5259-2007-602a-88929d5bdb2c-56a96a26" class="res-city-card virginia-city"> --}}
                        <div id="w-node-_6b0c7410-5259-2007-602a-88929d5bdb2c-56a96a26" class="res-city-card" 
                        style="background-image: linear-gradient(rgba(0, 0, 0, .3), rgba(0, 0, 0, .3)), url({{ $event->card_bg_image ? Storage::url($event->card_bg_image) : 'https://assets-global.website-files.com/62a4ae1a77029b4f2e631a4e/662fa85a743c2322855153f6_virgnia.jpg' }});">
                            <div id="w-node-_6b0c7410-5259-2007-602a-88929d5bdb2d-56a96a26" class="res-card-content">
                                <div class="title-res">{{ $event->title }}</div>
                                <div class="month-res">{{ date('F',strtotime($event->start_date)) }}</div>
                                <div class="date-res">{{ date('d',strtotime($event->start_date)) .' - '.date('d',strtotime($event->end_date)) }}</div>
                                <div class="venue-res">{{ $event->venue_name }}</div>
                            </div>
                        </div>
                        <div data-w-id="7bcbc3d8-7fae-6155-0381-79504df12daa" class="north-form-button style-D6xjH"
                            id="style-D6xjH">
                            <div class="card-coming-soon">Join The Waitlist</div><a
                                data-w-id="2a42bc1c-14dd-fbee-5a93-75224d5648b1" href="#"
                                class="north-america-form-button w-button">Join The Waitlist</a>
                        </div>
                    </a>
                @empty
                    <div class="text-danger">No event exists!</div>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>
