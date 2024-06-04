@extends('header')

@section('content')
    <div class="container border login-border mt-5 centerIt">
        <h2>Payment History</h2>
        @if ($orders->isEmpty())
            <table>
                <tr>
                    <td>
                        <p class="text-center">No record found</p>
                    </td>
                </tr>
            </table>
        @else
            <table class="table table-striped testing">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Size</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        @foreach ($order->products as $product)
                            <tr>
                                <td><img src="{{ $product->image }}" alt="{{ $product->name }}" style="width: 150px"></td>
                                <td>{{ $product->name }}</td>
                                <td>RM {{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->pivot->qty }}</td>
                                <td>{{ $product->size }}</td>
                                <td>RM {{ number_format($product->price * $product->pivot->qty, 2) }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
