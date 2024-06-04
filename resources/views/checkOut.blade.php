@extends('header')
@section('content')
    <div class="container border login-border mt-5 centerIt">
        <b>
            <p>Order Summary</p>
        </b>

        <hr>
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
                @foreach ($cartItems as $cartItem)
                    <tr>
                        <th scope="row"><img src="{{ $cartItem->product->image }}" alt="" style="width: 150px">
                        </th>
                        <td>{{ $cartItem->product->name }}</td>
                        <td>RM {{ number_format($cartItem->product->price, 2) }}</td>
                        <td>{{ $cartItem->qty }}</td>
                        <td>{{ $cartItem->size }}</td>
                        <td>RM {{ number_format($cartItem->totalAmount, 2) }}</td>
                    </tr>
                @endforeach
                @php
                    $subtotal = 0;
                @endphp

                @foreach ($cartItems as $cartItem)
                    @php
                        $subtotal += $cartItem->totalAmount;
                    @endphp
                @endforeach
                <tr>
                    <td colspan="1"></td>
                    <td colspan="4"><strong>Subtotal</strong></td>
                    <td><strong>RM {{ number_format($subtotal, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container border login-border mt-2 centerIt">
        <form action="{{ route('payment') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <h3>Billing Address</h3>
                                <label for="fname"><i class="bi bi-person-fill"></i> Name</label>
                                <p>{{ $customer->name }}</p>
                                <label for="email"><i class="bi bi-envelope-open-fill"></i> Email</label>
                                <p>{{ $customer->email }}</p>
                                <label for="address"><i class="bi bi-person-video2"></i> Address</label><br>
                                <p>{{ $customer->address }}</p>
                            </div>

                            <div class="col-6">
                                <h3>Payment</h3>
                                <p>Please Select Your Payment Method</p>
                                <div class="input-group mb-3">
                                    <select class="custom-select" id="inputGroupSelect01" name="payment_method_types[]">
                                        <option value="card">Credit/Debit Card</option>
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary cart-button checkOut-button">Check
                                        Out</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
