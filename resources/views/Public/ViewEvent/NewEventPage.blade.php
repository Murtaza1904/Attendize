<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/new-events.css') }}">
    <title>Events</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-KBQ8RTT');
    </script>
</head>

<body>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KBQ8RTT" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <div class="hr_nav-container">
        <a href="/" aria-current="page" class="hr-logo w-nav-brand w--current" aria-label="home">
            <img src="https://cdn.prod.website-files.com/62a4ae1a77029b4f2e631a4e/6478ba3d1b4f2642c524267b_HRF%20TOUR%20LOGO%20White-01.svg"
                loading="lazy" alt="" class="image-145">
        </a>
        <nav role="navigation" class="nav-menu-5 w-nav-menu">
            @if (auth()->guard('client')->user())
            <a href="{{ route('client.my-orders.index') }}" class="hr_nav-link w-nav-link">My Tickets</a>
            <a href="{{ route('client.profile.index') }}" class="hr_nav-link w-nav-link">
                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512" fill="#fff" height="15">
                    <path
                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                </svg>
                <span style="margin-left: 4px">My Profile</span>
            </a>
            <form action="{{ route('client.logout') }}" method="POST" style="float: right; display: inline;">
                @csrf
                <button type="submit" class="btn"
                    style="background: #fc2222; padding-inline: 10px; padding-block: 5px">
                    Logout
                </button>
            </form>
            @endif
        </nav>
    </div>
    {{-- @if (auth()->guard('client')->user())
        <div style="position: absolute;z-index: 999; right: 0; margin: 20px">
            <a href="{{ route('client.profile.index') }}" style="color: #fff">{{ auth()->guard('client')->user()->email }}</a>
        </div>
    @else
        <div style="position: absolute;z-index: 999; right: 0; margin: 20px; margin-top:30px;">
            <a href="{{ route('client-login.show') }}" style="color: #fff; background: #fc2222; text-decoration: none; padding-inline: 24px; padding-block: 15px; border-radius;text-align: center;">Login</a>
        </div>
    @endif --}}
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
                </div>
            </div>
        </div>
        <div class="html-embed-6">
            <div data-poster-url="{{ asset('assets/images/events/black-background.jpg') }}"
                data-video-urls="{{ asset('assets/videos/events/hero.mp4') }}" data-autoplay="true" data-loop="true"
                data-wf-ignore="true" class="background-video-5">
                <video id="6e7d8527-4ffe-48b3-2b9e-90251a4d7023-video" autoplay="" loop=""
                    style="background-image:url(&quot;{{ asset('assets/images/events/black-background.jpg') }}&quot;)"
                    muted="" playsinline="" data-wf-ignore="true" data-object-fit="cover">
                    <source src="{{ asset('assets/videos/events/hero.mp4') }}" data-wf-ignore="true">
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
                <div class="regular-text" style="color: black !important">The Halal Ribfest 2024 Tour lineup will be
                    featured in many cities across
                    the&nbsp;US&nbsp;and&nbsp;Canada!</div>
            </div>
            <div class="north-america-cards">
                @forelse ($events as $event)
                    <a href="{{ route('showEventPage', [$event->id, Str::slug($event->title)]) }}"
                        data-w-id="fdec3628-e13c-ee0b-7b79-716a88359aaa" class="north-card-wrapper">
                        <div id="w-node-_6b0c7410-5259-2007-602a-88929d5bdb2c-56a96a26" class="res-city-card city"
                            style="background-image: linear-gradient(rgba(0, 0, 0, .3), rgba(0, 0, 0, .3)), url({{ $event->card_bg_image ? Storage::url($event->card_bg_image) : 'https://assets-global.website-files.com/62a4ae1a77029b4f2e631a4e/662fa85a743c2322855153f6_virgnia.jpg' }});">
                            <div id="w-node-_6b0c7410-5259-2007-602a-88929d5bdb2d-56a96a26" class="res-card-content">
                                <div class="title-res">{{ $event->title }}</div>
                                <div class="month-res">{{ date('F', strtotime($event->start_date)) }}</div>
                                <div class="date-res">
                                    {{ date('d', strtotime($event->start_date)) . ' - ' . date('d', strtotime($event->end_date)) }}
                                </div>
                                <div class="venue-res">{{ $event->venue_name }}</div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="text-danger">No event exists!</div>
                @endforelse
            </div>
        </div>
    </div>
    @include('Public.ViewEvent.Partials.EventFooterSection')
</body>

</html>
