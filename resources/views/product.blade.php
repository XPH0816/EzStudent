@extends('header')
@section('content')
    <div class="container border login-border mt-5">
        <div class="row product-container">
            <div class="col-5">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width: 100%">
            </div>

            <div class="col-7">
                <b>
                    <p style="font-size: 25px;font-weight: bold">{{ $product->name }}</p>
                </b>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item detail-button" role="presentation">
                        <button class="nav-link active " id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Detail</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link description-button" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Specification</button>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="detail-container">
                            </br>
                            <h4><b>Category</b></h3>
                                <p>{{ $product->category }}</p>
                                <h4><b>Price</b></h3>
                                    <p>RM {{ $product->price }}</p>
                                    </br>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="specification-container">
                            @if(!Str::contains($product->description, "-"))
                            <ul>
                                <li class="style">{{ $product->description }}</li>
                            </ul>
                            @else
                            {!! Str::markdown(Str::replace('-', Str::of("")->newLine(). ' - ', $product->description,))  !!}
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('addToCart') }}" method="POST" class="text-center center">
                        @csrf
                        <div class="radio">
                            <label class="mb-2" for="size">Please Select Size:</label>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <br>
                                <div class="size-button">
                                    <label class="btn btn-secondary button-test">
                                        <input type="radio" name="size" value="S" checked>S
                                    </label>
                                    <label class="btn btn-secondary button-test">
                                        <input type="radio" name="size" value="M">M
                                    </label>
                                    <label class="btn btn-secondary button-test">
                                        <input type="radio" name="size" value="L">L
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button class="btn btn-primary mt-3 addCart-button" type="submit" name="addCart" id="addCart">Add
                            Cart</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
