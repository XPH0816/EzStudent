@extends('header')

@section('content')
    <div class="container border login-border mt-5 centerIt">
        <h2>Order History</h2>
        @if ($orders->isEmpty())
            <p class="text-center">No orders found.</p>
        @else
            <table class="table table-striped testing">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Address</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>RM {{ number_format($order->totalAmount, 2) }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
