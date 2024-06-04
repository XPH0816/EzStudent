@extends('header')
@section('content')
    <div class="container border login-border mt-5">
        <div class="mt-5">
            @if ($errors->any())
                <div class="col-12">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>

        <div class="row-12 mt-4 d-block">
            <div class="col">
                <div class="description-container">
                    <div class="title d-flex justify-content-center">
                        <h4>Reset your new password</h4>
                    </div>
                    <p class="notification mb-3 d-flex justify-content-center ">We will send a link to your email, use that
                        link to reset password</p>
                </div>
            </div>
        </div>
        <style>
            .header-area {
                display: none;
            }
        </style>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 mt-3">
                <div class="update-container">
                    <form action="{{ route('reset.password.post') }}" method="POST">
                        @csrf
                        <input type="text" name="token" hidden value="{{ $token }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Email address</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Enter new password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="password_confirmation">Confirm password</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary btn-lg btn-block float-end update-button mb-3"
                                    id="update-btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
