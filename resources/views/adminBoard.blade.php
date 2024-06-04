@extends('adminHeader')
@section('content')
    <table id="example" class="table table-striped mt-3" style="width:100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td><img src="{{ $admin->image }}" alt="{{ $admin->name }}" style="width: 100px"></td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        <a href="{{ route('adminDelete', ['id' => $admin->id]) }}" class="btn btn-primary"
                            type="button">Delete</a>
                    </td>
                </tr>
            @endforeach
    </table>

    <script>
        new DataTable('#example');
    </script>
@endsection
