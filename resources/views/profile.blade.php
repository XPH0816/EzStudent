@extends('header')
@section('content')
    <div class="container mt-5">
        <div class="row">

            {{-- <!-- Left Container -->
            <div class="col-lg-4 col-xl-3">
                <div class="border p-3 text-center">
                    <form method="post" enctype="multipart/form-data" id="fileUpdateForm">
                        <div class="mb-3">
                            <label for="file" class="form-label">Choose File</label>
                            <input name="file" id="file" type="file" class="btn form-control">
                            <div id="msgImage"></div>
                        </div>
                    </form>
                </div>
            </div> --}}

            <!-- Right Container -->
            <div class="col-lg-12 col-xl-12">
                <div class="border p-3">
                    <form method="POST" action="{{ route('update.profile', auth('customer')->user()) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <h5>Edit Your Personal Setting</h5>
                        <p>Please fill in all the information correctly </p>

                        <div class="row mt-3">
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input id="name" type="text" class="form-control required"
                                        value="{{ auth('customer')->user()->name }}" name="name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control required"
                                        value="{{ auth('customer')->user()->phoneNo }}" name="phoneNo">
                                    @error('phoneNo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ auth('customer')->user()->email }}" disabled>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Matric Number</label>
                                    <input type="text" class="form-control" name="matric"
                                        value="{{ auth('customer')->user()->matric }}">
                                    @error('matric')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="mb-3">
                                    <div class="d-grid gap-2 col-lg-2 mt-4 float-lg-end">
                                        <button type="submit" class="btn btn-primary profile-button">Save & Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
