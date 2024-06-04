@extends('adminHeader')

@section('content')
    <div class="col-lg-12 col-xl-12 mt-5">
        <div class="border p-3">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span> {{ session('error') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('request') || session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span><b>{{ session('message') }}</b> {{ session('request') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="form-group mt-3">
                <img src="{{ $admin->image }}" alt="{{ $admin->name }}"
                    style="width: 100px; display: block; margin: 0 auto;">
            </div>
            <div class="form-group mt-3">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $admin->name }}"
                    readonly>
            </div>
            <div class="form-group mt-3">
                <label for="name">Email Address:</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ $admin->email }}"
                    readonly>
            </div>
            <form action="{{ route('admin.changePassword') }}" method="post">
                @csrf
                <div class="form-group mt-3">
                    <label for="old_password">Old Password:</label>
                    <input type="password" name="old_password" id="old_password" class="form-control" value="">
                    @error('old_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="password">New Password:</label>
                    <input type="password" name="password" id="password" class="form-control" value="">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                        value="">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <button type="submit" class="ms-auto d-block btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
