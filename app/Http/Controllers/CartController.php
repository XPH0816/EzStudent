<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth('customer')->check()) {
            return redirect()->route('login')->with('info', 'You must log in to access the cart');
        }

        $cartItems = auth('customer')->user()->carts;
        return view('cart', compact('cartItems'));
    }

    public function updateCartQuantity(Request $request)
    {
        $cartItemId = $request->input('cartItemId');
        $newQuantity = $request->input('newQuantity');

        $cartItem = Cart::find($cartItemId);

        if ($cartItem) {
            // Calculate new total amount based on the updated quantity
            $product = $cartItem->product;
            $newTotalAmount = $newQuantity * $product->price;

            // Update quantity and totalAmount in the database
            $cartItem->update([
                'qty' => $newQuantity,
                'totalAmount' => $newTotalAmount,
            ]);

            // Calculate subtotal
            $subtotal = auth('customer')->user()->carts->sum('totalAmount');

            return response()->json(['success' => true, 'message' => 'Quantity updated successfully', 'newTotalAmount' => $newTotalAmount, 'subtotal' => $subtotal]);
        }

        return response()->json(['success' => false, 'message' => 'Cart item not found']);
    }

    public function deleteCartItem(Request $request)
    {
        $cartItemId = $request->input('cartItemId');

        $cartItem = Cart::find($cartItemId);

        if ($cartItem) {
            // Delete the item from the database
            $cartItem->delete();

            // Calculate subtotal after deletion
            $subtotal = auth('customer')->user()->carts->sum('totalAmount');

            return response()->json(['success' => true, 'message' => 'Item deleted successfully', 'subtotal' => $subtotal]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found']);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        $request->validated();

        $product = Product::find($request->input('product_id'));
        $quantity = 1;
        $totalAmount = $quantity * $product->price;

        // Store cart item in the database with customer ID
        Cart::create([
            'product_id' => $product->id,
            'customer_id' => auth('customer')->user()->id,
            'qty' => $quantity,
            'size' => $request->input('size'),
            'totalAmount' => $totalAmount,
        ]);

        return redirect()->route('addCart.success')->with('info', 'Item added to cart successfully');
    }

    public function showCart()
    {
        $cartItems = auth('customer')->user()->carts;
        return view('addCartSuccess', compact('cartItems'));
    }

    public function showCheckOut()
    {
        $customerId = auth('customer')->user()->id;
        $customer = Customer::find($customerId); // Fetch customer details from the database based on ID

        $cartItems = auth('customer')->user()->carts;

        return view('checkOut', compact('cartItems', 'customer'));
    }

    /**
     * Display the specified resource.
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
