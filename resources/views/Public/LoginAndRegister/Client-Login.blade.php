<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Client Login</title>
</head>
<body>
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
    </style>
    <div class="sec_north-america">
        <div class="hr_container">
            <div class="card">
                <div class="card-body">
                    <div class="logo">
                        Halal Rib Fest
                    </div>
                    @if (Session::has('failed'))
                        <h4 class="text-danger mt0">@lang('basic.whoops')! </h4>
                        <ul class="list-group">
                            <li class="list-group-item">@lang('User.login_fail_msg')</li>
                        </ul>
                    @endif
                    <form action="{{ route('client-login.check') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <sup class="text-danger">*</sup></label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter email address" title="Email Address" />
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password <sup class="text-danger">*</sup></label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter password" title="Password" />
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-red form-control mt-4">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
