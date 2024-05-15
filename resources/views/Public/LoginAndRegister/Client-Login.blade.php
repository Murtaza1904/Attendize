@extends('Shared.Layouts.MasterWithoutMenus')

@section('title', 'Client Login')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel">
                <div class="panel-body">
                    <div class="logo">
                        <img src="assets/images/logo-dark.png" alt="Logo">
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
                        @include('Public.LoginAndRegister.Partials.CaptchaSection')
                        <button type="submit" class="btn btn-success">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
