@extends('adminHeader')

@section('content')
    <h1 class="d-flex justify-content-center mt-2">Add Stock</h1>
    <hr>
    <div class="container mt-5">
        @if (session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-6">
                <div class="details">
                    <form id="addStockForm" method="POST" action="{{ route('adminAddStock') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="productName">Name:</label>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control" id="name" name="name"><br>

                        </div>
                        <div class="form-group">
                            <label for="productType">Type:</label>
                            @error('type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control" id="type" name="type"><br>
                        </div>
                        <div class="form-group">
                            <label for="productDescription">Description:</label>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control" id="description" name="description"><br>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="productImage">Product Image:</label>
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="file" class="form-control" id="image" name="image" /><br>
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Price (RM):</label>
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control" id="price" name="price"><br>
                        </div>
                        <div class="form-group">
                            <label for="productCategory">Category:</label>
                            @error('category')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <select class="form-control" id="category" name="category">
                                <option value="Men">Men</option>
                                <option value="Women">Women</option>
                            </select><br>

                        </div>
                        <div class="form-group">
                            <label for="productQuantity">Quantity:</label>
                            @error('quantity')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control" id="quantity" name="quantity"><br>
                        </div>
                        <div class="form-group">
                            <label for="productType">Size:</label>
                            @error('size')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control" id="size" name="size"><br>
                        </div>

                        {{-- <div class="text-right mt-2">
                            <input type="submit" value="Add Product" class="btn btn-primary align-right">
                        </div> --}}
                        <div class="form-group mb-3 text-right">
                            <button type="button" class="btn btn-primary align-right" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Add Product
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
                    Are you sure want to add this product to stock?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="addButton" class="btn btn-primary">Add Product</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#addButton').on('click', function() {
                // Trigger the form submission when the "Update" button in the modal is clicked
                $('#addStockForm').submit();
            });
        });
    </script>
@endsection
