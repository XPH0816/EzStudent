@extends('header')

@section('head')
    {!! htmlScriptTagJsApi() !!}
@endsection

@section('content')
    <div class="container border">
        <div class="row-12 mt-4 d-block">
            <div class="col">
                <div class="description-container">
                    <div class="title d-flex justify-content-center">
                        <h4>Sign Up</h4>
                    </div>
                    <p class="nav-description d-flex justify-content-center">Create your account to get full access
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="form-container">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        style="text-align: left">
                                    <span class="invalid-feedback" role="alert">
                                        @error('name')
                                            <strong> {{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                        style="text-align: left">
                                    <span class="invalid-feedback" role="alert">
                                        @error('email')
                                            <strong> {{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phoneNo" value="{{ old('phoneNo') }}"
                                        style="text-align: left">
                                    <span class="invalid-feedback" role="alert">
                                        @error('phoneNo')
                                            <strong> {{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Matric Number</label>
                                    <input type="text" class="form-control" name="matric" value="{{ old('matric') }}"
                                        style="text-align: left">
                                    <span class="invalid-feedback" role="alert">
                                        @error('matric')
                                            <strong> {{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            value="{{ old('password') }}" style="text-align: left">
                                        <span class="invalid-feedback" role="alert">
                                            @error('password')
                                                <strong> {{ $message }}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            style="text-align: left">
                                        <span class="invalid-feedback" role="alert">
                                            @error('password_confirmation')
                                                <strong> {{ $message }}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center align-content-center">
                            <div class="col-12 col-lg-5">
                                {{-- {!! htmlFormSnippet() !!} --}}
                                @error(recaptchaFieldName())
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="mt-4">
                                    <p>Already have an account?<a href="{{ route('login') }}" class="login"> Login</a>
                                        Here
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <div class="d-grid gap-2 col-4 col-lg-5 mx-auto mt-2 float-lg-end">
                                        <button class="btn button-style" type="submit" id="submit">Sign
                                            Up</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>

        </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    {{-- <script>
        // A $( document ).ready() block.
        $(document).ready(function() {
            $("form").validate({
                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    email: {
                        required: true,
                        // Specify that email should be validated
                        // by the built-in "email" rule
                        email: true
                    },
                    firstName: "required",
                    lastName: "required",
                    phoneNum: "required",
                    address: "required",
                    position: "required",
                    gender: "required",
                    joinDate: "required",
                    dateBirth: "required"
                },
                // Specify validation error messages
                messages: {
                    email: "Please fill up the email",
                    firstName: "Please fill up the firstName",
                    lastName: "Please fill up the lastName",
                    phoneNum: "Please fill up the phone number",
                    address: "Please fill up the address",
                    gender: "Please choose the gender",
                    position: "Please fill up the position",
                    joinDate: "Please fill up the join date",
                    dateBirth: "Please fill up date of birth",
                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function(form) {
                    var values = $("form").serialize();
                    console.log(values);
                    $.ajax({
                        url: "registerbackend.php", //{{ route('register') }}
                        type: "post",
                        data: values,
                        success: function(response) {

                            var result = $.parseJSON(response);
                            console.log(result);
                            if (result.register == "Register Success") {
                                window.location = "admin_dashboard.php";
                                alert("Register Success");
                            } else {
                                alert("Fail Register");
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                }
            });
        });
    </script> --}}
@endsection
