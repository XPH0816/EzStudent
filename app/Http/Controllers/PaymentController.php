<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {

        $user = auth('customer')->user();
        $subtotal = $user->carts->sum('totalAmount'); // Calculate subtotal

        return view('payment', [
            'subtotal' => $subtotal,
            'intent' => $user->createSetupIntent(['payment_method_types' => $request->input('payment_method_types')]),
        ]);
    }

    public function singleCharge(Request $request)
    {
        $paymentMethod = $request->payment_method;

        $user = auth('customer')->user();
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        $amount = (int) ($user->carts->sum('totalAmount') * 100);
        $user->charge($amount, $paymentMethod);

        $order = Order::create([
            'customer_id' => $user->id,
            'orderDate' => now(),
            'totalAmount' => $amount / 100,
            'address' => $user->address,
            'status' => 'Paid',
        ]);

        $user->orders()->save($order);

        foreach ($user->carts as $cart) {
            $order->products()->attach(
                $cart->product_id,
                ['qty' => $cart->qty]
            );
            $cart->product->quantity -= $cart->qty;
            $cart->product->save();
        }

        $user->carts()->delete();

        return redirect()->route('history')->with('info', 'Thank You For Your Purchase.');;
    }
}
