@extends('header')
@section('content')
    <div class="container border login-border mt-5 centerIt">
        <table class="table table-striped testing">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Size</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $cartItem)
                    <tr>
                        <th scope="row">
                            <img src="{{ $cartItem->product->image }}" alt="" style="width: 150px">
                        </th>
                        <td>{{ $cartItem->product->name }}</td>
                        <td>RM {{ $cartItem->product->price }}</td>
                        <td>
                            <section class="quantity-container">
                                <div class="product-quantity">
                                    <input data-min="1" data-max="0" type="number" name="quantity"
                                        class="quantity-input" value="{{ $cartItem->qty }}" readonly="true"
                                        style="max-width: 8vw;" data-cart-item-id="{{ $cartItem->id }}">
                                    <div class="quantity-selectors-container">
                                        <div class="quantity-selectors">
                                            <button type="button" class="increment-quantity" aria-label="Add one"
                                                data-direction="1" data-cart-item-id="{{ $cartItem->id }}"
                                                data-available-quantity="{{ $cartItem->product->quantity }}">
                                                <span>&#43;</span>
                                            </button>
                                            <button type="button" class="decrement-quantity" aria-label="Subtract one"
                                                data-direction="-1" data-cart-item-id="{{ $cartItem->id }}"
                                                {{ $cartItem->qty <= 1 ? 'disabled' : '' }}><span>&#8722;</span></button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </td>
                        <td>{{ $cartItem->size }}</td>
                        <td class="total-amount" data-cart-item-id="{{ $cartItem->id }}">RM {{ $cartItem->totalAmount }}
                        </td>
                        <td><i class="bi bi-x-lg delete-item" data-cart-item-id="{{ $cartItem->id }}"></i></td>
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
                    <td colspan="6"><strong>Subtotal</strong></td>
                    <td id="subtotal"><strong>RM {{ number_format($subtotal, 2) }}</strong></td>
                </tr>

                <tr>
                    <td colspan="7">
                        <a href="{{ route('productIndex') }}" role="button" class="btn btn-primary cart-button">Continue
                            Shopping</a>
                        <a href="{{ route('checkout', ['customerId' => auth('customer')->user()->id]) }}"
                            class="btn btn-success cart-button" role="button">Proceed to
                            Checkout</a>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

    <script>
        $(document).ready(function() {
            // Increment quantity
            $(".increment-quantity").on("click", function() {
                var cartItemId = $(this).data("cart-item-id");
                var currentQtyInput = $(this).closest('tr').find('input[name="quantity"]');
                var currentQty = parseInt(currentQtyInput.val());

                // Assuming you have a data attribute on the button containing the product's available quantity
                var availableQuantity = parseInt($(this).data('available-quantity'));

                // Check if adding one more won't exceed the available quantity
                if (currentQty < availableQuantity) {
                    currentQtyInput.val(currentQty + 1);
                    updateCartItemQuantity(cartItemId, currentQty + 1);
                    location.reload();
                } else {
                    alert("Cannot add more items. Quantity exceeds available stock.");
                }
            });

            // Decrement quantity
            $(".decrement-quantity").on("click", function() {
                var cartItemId = $(this).data("cart-item-id");
                var currentQtyInput = $(this).closest('tr').find('input[name="quantity"]');
                var currentQty = parseInt(currentQtyInput.val());
                if (currentQty > 1) {
                    currentQtyInput.val(currentQty - 1);
                    updateCartItemQuantity(cartItemId, currentQty - 1);
                }
                location.reload();
            });

            // Input quantity manually
            $(".quantity-input").on("input", function() {
                var cartItemId = $(this).data("cart-item-id");
                var newQuantity = parseInt($(this).val());
                if (newQuantity >= 1) {
                    updateCartItemQuantity(cartItemId, newQuantity);
                } else {
                    alert("Quantity must be at least 1.");
                    $(this).val(1);
                }
            });

            // Delete item from cart
            $(".delete-item").on("click", function() {
                var cartItemId = $(this).data("cart-item-id");
                // Cache the current table row for later removal
                var rowToRemove = $(`tr[data-cart-item-id="${cartItemId}"]`);

                $.ajax({
                    type: "POST",
                    url: "{{ route('delete.cart.item') }}",
                    data: {
                        cartItemId: cartItemId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response.message);
                        if (response.success) {
                            // Remove the table row from the page immediately
                            rowToRemove.remove();

                            // Update subtotal
                            $('#subtotal').text('RM ' + parseFloat(response.subtotal).toFixed(
                                2));
                            location.reload();
                        }
                    },
                    error: function(error) {
                        console.error("Error deleting item: " + error.responseText);
                    }
                });
            });

            function updateCartItemQuantity(cartItemId, newQuantity) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('update.cart.quantity') }}",
                    data: {
                        cartItemId: cartItemId,
                        newQuantity: newQuantity,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response.message);
                        if (response.success) {
                            var newTotal = parseFloat(response.newTotalAmount).toFixed(2);
                            $(`td[data-cart-item-id="${cartItemId}"].total-amount`).text('RM ' +
                                newTotal);
                            $('#subtotal').text('RM ' + parseFloat(response.subtotal).toFixed(2));
                        }
                    },
                    error: function(error) {
                        console.error("Error updating quantity: " + error.responseText);
                    }
                });
            }
        });
    </script>
@endsection
