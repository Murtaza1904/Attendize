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
            <a href="{{ route('client.my-orders.index') }}" class="hr_nav-link w-nav-link">My orders</a>
            <a href="{{ route('client.profile.index') }}" class="hr_nav-link w-nav-link">Profile</a>
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
