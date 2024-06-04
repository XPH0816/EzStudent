@extends('adminHeader')

@section('content')
    <h1 class="d-flex justify-content-center mt-2">Add Admin</h1>
    <hr>
    <div class="container mt-5">
        @if (session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-6">
                <div class="details">
                    <form id="addAdminForm" method="POST" action="{{ route('admin.register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="image">Admin Image:</label>
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="file" class="form-control" id="image" name="image" /><br>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Email Address:</label>
                            <input type="text" name="email" id="email" class="form-control"
                                value="{{ old('email') }}">
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
                        <div class="form-group my-3">
                            <label for="password_confirmation">Confirm Password:</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" value="">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3 text-right">
                            <button type="button" class="btn btn-primary align-right" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Add Admin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to add this admin?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="addButton" class="btn btn-primary">Add Admin</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#addButton').on('click', function() {
                // Trigger the form submission when the "Update" button in the modal is clicked
                $('#addAdminForm').submit();
            });
        });
    </script>
@endsection
