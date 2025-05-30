@extends('adminHeader')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-6">
                <div class="title text-center">
                    <h4>Delete Admin</h4>
                </div>
                <hr>
                <form id="deleteForm" action="{{ route('adminDelete', ['id' => $admin->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="details">
                        <img src="{{ $admin->image }}" alt="{{ $admin->name }}"
                            style="width: 150px; display: block; margin: 0 auto;">
                        <div class="form-group">
                            <label for="productName">Name:</label>
                            <input type="text" class="form-control" id="productName" value="{{ $admin->name }}"
                                readonly>
                            <br>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Email Address:</label>
                            <input type="text" name="email" id="email" class="form-control"
                                value="{{ $admin->email }}" readonly>
                        </div>
                        <div class="text-right mt-2">
                            <button type="button" class="btn btn-primary align-right" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Delete
                            </button>
                        </div>
                    </div>
                </form>
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
                        Are you sure want to delete this admin?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="deleteButton" class="btn btn-primary">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteForm = document.getElementById('deleteForm');
            var deleteButton = document.getElementById('deleteButton');

            deleteForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                $('#confirmationModal').modal('show'); // Show the confirmation modal
            });

            deleteButton.addEventListener('click', function() {
                // This click event will be triggered when the modal "Yes" button is clicked
                deleteForm.submit(); // Submit the form
            });
        });
    </script>
@endsection
