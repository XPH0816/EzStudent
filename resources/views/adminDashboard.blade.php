@extends('adminHeader')

@section('content')
    <table id="example" class="table table-striped mt-3" style="width:100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Available Quantity </th>
                <th>Type</th>
                <th>Category </th>
                <th>Price</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td><img src="{{ $product->image }}" alt="{{ $product->name }}" style="width: 100px"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->type }}</td>
                    <td>{{ $product->category }}</td>
                    <td>RM {{ $product->price }}</td>
                    <td>
                        <!-- <button class="btn btn-primary" type="button">Edit</button> -->
                        <a href="{{ route('edit-product', ['id' => $product->id]) }}" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                        <a href="{{ route('admin.deleteStockPage', ['id' => $product->id]) }}" class="btn btn-primary"
                            type="button">Delete</a>
                    </td>
                </tr>
            @endforeach
    </table>

    <script>
        new DataTable('#example');
    </script>
@endsection
