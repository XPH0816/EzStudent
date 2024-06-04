@extends('adminHeader')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-6">
                @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif
                <div class="title text-center">
                    <h4>Edit Product</h4>
                </div>
                <hr>
                <div class="details">
                    <form id="updateStockForm" action="{{ route('update-product', ['id' => $product->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 200px"
                                height="200px">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $product->name }}"> <br>
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" name="type" id="type" class="form-control"
                                value="{{ $product->type }}"><br>
                        </div>

                        <div class="form-group">
                            <label for="type">Description</label>
                            <input type="text" name="description" id="description" class="form-control"
                                value="{{ $product->description }}"><br>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="productImage">Product Image:</label>
                            <input type="file" class="form-control" id="image" name="image" />
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" id="price" class="form-control"
                                value="{{ $product->price }}"><br>
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" name="category" id="category" class="form-control"
                                value="{{ $product->category }}"><br>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control"
                                value="{{ $product->quantity }}"><br>
                        </div>

                        <div class="form-group">
                            <label for="category">Size</label>
                            <input type="text" name="size" id="size" class="form-control"
                                value="{{ $product->size }}"><br>
                        </div>

                        <!-- Add form fields for other product attributes as needed -->
                        <div class="form-group mb-3 text-right">
                            <button type="button" class="btn btn-primary align-right" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Update Product
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
                    Are you sure want to update this stock?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="updateButton" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#updateButton').on('click', function() {
                // Trigger the form submission when the "Update" button in the modal is clicked
                $('#updateStockForm').submit();
            });
        });
    </script>
@endsection
