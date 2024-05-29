<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
    <title>Client Login OTP</title>
    <style>
        /* Events */
        @import url('https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap');

        @font-face {
            font-family: 'American captain';
            src: url('https://uploads-ssl.webflow.com/62a4ae1a77029b4f2e631a4e/6467af776ff8c8010f263c48_American%20Captain.otf') format('opentype');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }

        html {
            height: 100vh;
        }

        body {
            height: 100vh;
            position: relative;
            margin: 0;
        }

        .sec_north-america {
            background-image: url(https://assets-global.website-files.com/62a4ae1a77029b4f2e631a4e/649096276c987f8deefd0a57_eat.png), url(https://assets-global.website-files.com/62a4ae1a77029b4f2e631a4e/646ef4d502eaff757e319436_Layer%2049%20\(1\).png);
            background-position: 100% 30px, 0 30px;
            background-repeat: no-repeat, no-repeat, no-repeat;
            background-size: auto, auto, auto;
            padding-top: 100px;
            padding-bottom: 68px;
        }

        .hr_container {
            display: flex;
            flex-flow: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 1380px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 20px;
            padding-right: 20px;
            font-size: 16px;
            position: relative;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
            font-family: 'American captain';
            font-size: 52px;
            color: #fc2222;
        }

        .card {
            background-image: url(https://assets-global.website-files.com/62a4ae1a77029b4f2e631a4e/662fa85a743c2322855153f6_virgnia.jpg);
            color: #fff;
            padding-block: 40px;
            width: 400px;
            padding-bottom: 0;
        }

        .btn-red {
            background-color: #fc2222;
            color: #fff;
        }

        #footer {
            bottom: 0;
        }
    </style>
</head>

<body>
    <div class="sec_north-america">
        <div class="hr_container">
            <div class="card">
                <div class="card-body">
                    <div class="logo">
                        {{ config('app.name') }}
                    </div>
                    <form action="{{ route('client-login.otp.verify') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="otp" class="form-label">OTP Code <sup class="text-danger">*</sup></label>
                            <input type="otp" name="otp" id="otp" class="form-control"
                                placeholder="Enter otp code" title="OTP" />
                            @error('otp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-red form-control mt-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('Public.ViewEvent.Partials.EventFooterSection')
</body>

</html>
