<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('assets/stylesheet/frontend.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
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

        .rrssb-buttons li a {
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

        #organiserHead,
        #footer {
            background: #000 !important;
        }
    </style>

</head>

<body class="attendize">
    <div>
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('client.logout') }}" method="POST" style="float: right">
                        @csrf
                        <button type="submit" class="btn" style="background: #000">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            <div class="row">
                <h1 class='section_head'>
                    Profile
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('client.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h3> Your information</h3>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="first_name">First name</label>
                                    <input class="form-control" name="first_name" type="text" id="first_name"
                                        value="{{ $user->first_name }}">
                                    @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="last_name">Last name</label>
                                    <input class="form-control" name="last_name" type="text" id="last_name"
                                        value="{{ $user->last_name }}">
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" name="email" type="text" id="email"
                                        value="{{ $user->email }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <input class="form-control" name="avatar" type="file" id="avatar">
                                    @error('avatar')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <input class="btn btn-lg btn-event-link btn-success card-submit" style="width:100%;"
                            type="submit" value="Update">
                    </form>
                </div>
            </div>
            <div style="display: flex; justify-content: center; margin-top: 15px">
                <a href="{{ route('home') }}" style="color: #fc2222">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512" height="10">
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                    </svg>
                    Back To Home
                </a>
            </div>
        </section>
        @include('Public.ViewEvent.Partials.EventFooterSection')
    </div>
    <a href="#intro" style="display:none;" class="totop">
        <i class="ico-angle-up"></i>
        <span style="font-size:11px;">TOP</span>
    </a>
</body>

</html>
