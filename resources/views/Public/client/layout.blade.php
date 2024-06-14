<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('assets/stylesheet/frontend.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>

<body class="attendize">
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
            @else
                <a href="{{ route('client-login.show') }}"  class="btn"
                    style="background: #fc2222; padding-inline: 10px; padding-block: 5px; text-decoration: none; border-radius: 5px">
                    LOGIN
                </a>
            @endif
        </nav>
    </div>
    <main>
        @yield('content')
        @include('Public.ViewEvent.Partials.EventFooterSection')
    </main>
    <a href="#intro" style="display:none;" class="totop">
        <i class="ico-angle-up"></i>
        <span style="font-size:11px;">TOP</span>
    </a>
    <script src="{{ asset('assets/javascript/backend.js') }}"></script>
</body>

</html>
