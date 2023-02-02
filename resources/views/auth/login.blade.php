@extends('layouts.authLayout')
@viteReactRefresh
@vite('resources/js/components/PasswordForgot.jsx')
@section('content')
    <div class="wrapper-page account-page-full">

        <div class="card">
            <div class="card-body">

                <div class="text-center">
                    <a href="/" class="logo">
                        <img src="{{ asset('assets/images/logo-light.png') }}" height="22" alt="logo">
                    </a>
                </div>

                <div class="p-3">
                    <h4 class="font-18 m-b-5 text-center">Welcome Back {{ authenticate_user_ip()?->fullname }}!</h4>
                    <p class="text-muted text-center">Sign in to continue to {{ config('app.name') }}.</p>

                    <form class="form-horizontal m-t-30" action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="username">Email</label>
                            <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="username"
                                   placeholder="Enter email">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="userpassword">Password</label>
                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="userpassword"
                                   placeholder="Enter password">
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox">
                                    <input name="remember" type="checkbox" class="custom-control-input" id="customControlInline" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customControlInline">Remember me</label>
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>

                        <div class="form-group m-t-10 mb-0 row">
                            <div class="col-12 m-t-20">
                                <div id="forgot-password"></div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="m-t-40 text-center">
            <p>© 2023 {{ config('app.name') }}. Crafted with <i class="mdi mdi-heart text-danger"></i> by eaglespire</p>
        </div>

    </div>
@endsection
