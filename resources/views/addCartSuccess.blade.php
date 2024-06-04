@extends('header')
@section('content')
    <div class="container border login-border mt-5 centerIt">
        <p style="color: #CD5C5C">{{ count($cartItems) }} new item(s) have been added to your cart</p>
        @foreach ($cartItems as $cartItem)
            <div class="container">
                <div class="row mb-5">
                    <div class="col-3">
                        <div class="img-container">
                            <img src="{{ $cartItem->product->image }}" alt="" style="width: 200px">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="content">
                            <b style="color: black">{{ $cartItem->product->name }}</b>
                            <p>Size: {{ $cartItem->size }}</p>
                            <p>Price: RM {{ $cartItem->product->price }}</p>
                            <p>Quantity: {{ $cartItem->qty }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="col-9 offset-3"> <!-- Use offset-3 to align with the col-3 above -->
                <a href="{{ route('productIndex') }}" class="btn btn-primary btn-lg active continue-btn custom-red-btn"
                    role="button" aria-pressed="true" style="background-color: red">Continue Shopping</a>
                <a href="{{ route('cart') }}" class="btn btn-secondary btn-lg active cart-btn custom-red-btn" role="button"
                    aria-pressed="true" style="background-color: #6C757D">View
                    Cart</a>
            </div>
        </div>
    </div>
@endsection
