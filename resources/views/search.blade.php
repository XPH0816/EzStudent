@extends('header')

@section('content')
    <div class="container mt-4">
        <h2>Search Results</h2>

        @if ($products->isEmpty())
            <p>No products found.</p>
        @else
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">Price: RM {{ $product->price }}</p>
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">View Product</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
