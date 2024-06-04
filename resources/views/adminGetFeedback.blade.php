@extends('adminHeader')
@section('content')
    <table id="example" class="table table-striped mt-3" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Topic</th>
                <th>Feedback</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->topic }}</td>
                    <td>{{ $contact->feedback }}</td>
                </tr>
            @endforeach
    </table>

    <script>
        new DataTable('#example');
    </script>
@endsection
