@extends('header')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-8 d-flex flex-column justify-content-center align-items-center text-left">
                <h1 class="text-center">UnderShirts</h1>
                <div class="p3">
                    <h1>Your Stealth</h1>
                    <h1>FIGHTER</h1>
                    <h1>AGAINST POOR</h1>
                    <h1>STYLE</h1>
                </div>
            </div>
            <div class="col-4">
                <img src="{{ $randomProducts->first()->image }}" class="card-img-top" alt="">
            </div>
        </div>
        <hr>
        <div>
            <h1 class="text-center">Most Popular</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 testing">
                @foreach ($randomProducts as $product)
                    @if ($loop->index == 3)
                    @break
                @endif
                <div class="col">
                    <div class="card">
                        <img src="{{ $product->image }}" class="card-img-top" alt="...">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
