@extends('header')
@section('content')
    <div class="container border login-border mt-5">
        <div class="row-12 mt-4 d-block">
            <div class="col">
                <div class="description-container">
                    <div class="title d-flex justify-content-center">
                        <h4>Update Password</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 mt-3">
                <div class="update-container">
                    <p class="change-password ">Change Password</p>
                    <div id="errorMessage"></div>
                    <form>
                        <div class="row">
                            <div class="col-12 ">
                                <div class="mb-3">
                                    <input id="currentPassword" type="password" class="form-control" name="currentPassword"
                                        placeholder="Current Password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <input type="password" class="form-control" name="NewPassword"
                                        placeholder="New Password">
                                </div>
                                <p class="notification mb-3 ">*Set a password of at least 8 characters with letters, numebr
                                    and
                                    special character</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 ">
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="ConfirmPassword"
                                        placeholder="Re-Enter New Password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-lg btn-block float-end update-button mb-3"
                                    id="update-btn">Change
                                    Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
