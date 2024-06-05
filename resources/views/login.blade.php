@extends('header')

@section('head')
    {!! htmlScriptTagJsApi(['action' => 'login']) !!}
@endsection

@section('content')
    <div class="container border login-border mt-5">
        <div class="row-12 mt-5 mb-5 d-block">
            <div class="col">
                <div class="description-container">
                    <div class="title d-flex justify-content-center">
                        <h4>Login</h4>
                    </div>
                    <p class="nav-description d-flex justify-content-center">Enter login details to get access
                    </p>
                </div>
            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger" role="alert" id="error">
                <div id="countdown"></div>
            </div>
        @endif
        <div id="countdown"></div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="form-container">
                    <form method="POST" action="{{ route('login') }}" id="login">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Email') }}</label>
                                    <input type="email" class="form-control @error('Email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" autocomplete="Email" autofocus
                                        style="text-align: left">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Password') }}</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" autocomplete="current-password" style="text-align: left">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-12">
                                @error(recaptchaFieldName())
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-lg-12 text-lg-end">
                            <a href="{{ route('forget.password') }}" class="login">Forget Password?</a>
                        </div>


                        <div class="row mb-5 mt-3">
                            <div class="col-12 col-lg-6">
                                <div class="mt-4">
                                    <p>Don't have an account?<a href="{{ route('register') }}" class="login"> Sign
                                            Up</a>
                                        Here</p>

                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <div class="d-grid gap-2 col-4 col-lg-6 mx-auto mt-2 float-lg-end">
                                        <script>
                                            function onSubmit(token) {
                                                document.getElementById("login").submit();
                                            }
                                        </script>
                                        <button class="btn button-style g-recaptcha"
                                            data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-callback="onSubmit"
                                            data-action="login">Login</button>
                                        {{-- {!! htmlFormButton("Login", [
                                            'class' => 'btn btn-style',
                                        ]) !!} --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                </form>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var lockoutSeconds = {{ session('lockoutSeconds') ?? 0 }};
            var countdownElement = document.getElementById('countdown');
            var errorElement = document.getElementById('error');

            function updateCountdown() {
                if (lockoutSeconds > 0) {
                    var minutes = Math.floor(lockoutSeconds / 60);
                    var seconds = lockoutSeconds % 60;
                    countdownElement.innerText = 'Too many login attempts. Please try again in ' + seconds +
                        ' seconds.';
                    lockoutSeconds--;
                    setTimeout(updateCountdown, 1000); // Update every second
                } else {
                    countdownElement.innerText = ''; // Countdown finished, update or hide as needed
                    errorElement.remove(); // Remove the error message from the DOM
                }
            }

            updateCountdown(); // Start the countdown on page load
        });
    </script>
@endsection
