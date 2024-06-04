@extends('adminHeader')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table id="example" class="table table-striped mt-3" style="width:100%">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Customer ID</th>
                <th>Total Amount</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>O00{{ $order->id }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>C{{ $order->customer->id }}</td>
                    <td>RM {{ number_format($order->totalAmount, 2) }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        @if ($order->status == 'Processing')
                            <a href="{{ route('admin.markDelivered', ['id' => $order->id]) }}"
                                class="btn btn-success">Delivered</a>
                            <a href="{{ route('admin.markCancelled', ['id' => $order->id]) }}"
                                class="btn btn-danger">Cancelled</a>
                        @elseif ($order->status == 'Pending')
                            <a href="{{ route('admin.markDelivered', ['id' => $order->id]) }}"
                                class="btn btn-success">Delivered</a>
                            <a href="{{ route('admin.markCancelled', ['id' => $order->id]) }}"
                                class="btn btn-danger">Cancelled</a>
                            <span>Pending Action</span>
                        @elseif ($order->status == 'Paid')
                            <a href="{{ route('admin.markDelivered', ['id' => $order->id]) }}"
                                class="btn btn-success">Delivered</a>
                            <a href="{{ route('admin.markCancelled', ['id' => $order->id]) }}"
                                class="btn btn-danger">Cancelled</a>
                        @else
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        new DataTable('#example');
    </script>
@endsection
