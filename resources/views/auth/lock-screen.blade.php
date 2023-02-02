<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ $title }} {{ $titleContent }}</title>
    <meta content="{{ $description }}" name="description"/>
    <meta content="Andrew Ohwofasa" name="author"/>
    <meta name="keywords" content="{{ $keywords }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    @stack('styles')
    @livewireStyles
</head>

<body>


<div class="home-btn d-none d-sm-block">
    <a href="index.html" class="text-white"><i class="fas fa-home h2"></i></a>
</div>

<div class="wrapper-page">

    <div class="card overflow-hidden account-card mx-3">

        <div class="bg-primary p-4 text-white text-center position-relative">
            <h4 class="font-20 m-b-5">Locked</h4>
            <p class="text-white-50 mb-4">Hello {{ ucwords(authenticate_user_ip()?->fullname) }}, enter your password to unlock the screen!</p>
            <a href="/" class="logo logo-admin">
                <img src="/assets/images/logo-sm.png" height="24" alt="logo">
            </a>
        </div>
        <div class="account-card-content">

            <form method="post" class="form-horizontal m-t-30" action="{{ route('unlock-screen') }}">
                @csrf
                <div class="user-thumb text-center m-b-30">
                    <img src="@if(authenticate_user_ip()?->photo !== null) {{ asset('storage/users/'.authenticate_user_ip()?->photo) }} @else {{ asset('storage/users/user.jpg') }} @endif" class="rounded-circle img-thumbnail" alt="thumbnail">
                    <h6>{{ ucwords(authenticate_user_ip()?->fullname) }}</h6>
                </div>

                <div class="form-group">
                    <label for="userpassword">Password</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="userpassword"
                           placeholder="Enter  password">
                       @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                </div>

                <div class="form-group row m-t-20 mb-0">
                    <div class="col-12 text-right">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Unlock</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="m-t-40 text-center">
        <form class="d-none" action="{{ route('back-to-login') }}" method="post" id="not-you">
            @csrf
        </form>
        <p>Not you ? return
            <a onclick="event.preventDefault(); document.getElementById('not-you').submit();"
               href="{{ route('back-to-login') }}" class="font-500 text-primary">
            Sign In
            </a>
        </p>
        <p>© 2023 {{ config('app.name') }}. Crafted with <i class="mdi mdi-heart text-danger"></i> by eaglespire</p>
    </div>

</div>
<!-- end wrapper-page -->

<!-- jQuery  -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/js/waves.min.js') }}"></script>

@yield('scripts')
<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

@include('sweetalert::alert')

@livewireScripts
@stack('scripts')

</body>
</html>
