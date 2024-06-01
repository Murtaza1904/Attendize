@extends('Public.client.layout')

@section('content')
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
                    <input class="btn btn-lg btn-event-link btn-success card-submit" style="width:100%;" type="submit"
                        value="Update">
                </form>
            </div>
        </div>
        <div style="display: flex; justify-content: center; margin-top: 15px">
            <a href="{{ route('home') }}" style="color: #fc2222">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="10">
                    <path
                        d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                </svg>
                Back To Home
            </a>
        </div>
    </section>
@endsection
