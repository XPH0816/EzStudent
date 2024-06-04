<?php

namespace App\Http\Controllers;

use App\Enums\AdminRoleEnum;
use App\Events\AdminCreated;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;

class adminController extends Controller
{
    public function index()
    {
        $admins = Admin::where('role_id', AdminRoleEnum::ADMIN)->get();
        return view('adminBoard', compact('admins'));
    }

    public function store(AdminRequest $request)
    {
        $request->validated();

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'image' => $request->file('image')->store('images'),
        ]);

        event(new AdminCreated($user));

        return redirect()->route('admin.register')->with('status', 'Admin created successfully.');
    }

    public function create()
    {
        return view('adminRegister');
    }

    public function showProfile($category = null)
    {
        // Assuming you expect only one admin, use first() instead of all()
        $admin = auth()->user();
        return view('adminProfile', compact('admin'));
    }

    public function viewMonthlyReport()
    {
        $orders = Order::with('customer')->get();

        return view('adminViewMonthlyReport', compact('orders'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $request->validated();
        auth()->user()->update([
            'password' => bcrypt($request->password)
        ]);

        $request->fulfill();

        return redirect()->route('adminProfile')->with('success', 'Password changed successfully.');
    }

    public function getFeedback()
    {
        $contacts = Contact::all(); // Assuming 'Contact' is your model for feedback
        return view('adminGetFeedback', compact('contacts'));
    }

    public function showOrderHistory()
    {
        // Fetch orders for the admin to manage
        $orders = Order::all(); // Fetch all orders (you might want to refine this query)

        return view('manageOrderHistory', ['orders' => $orders]);
    }

    public function markDelivered($id): RedirectResponse
    {
        // Find the order by ID
        $order = Order::findOrFail($id);

        // Update the order status to 'Delivered'
        $order->status = 'Delivered';
        $order->save();

        // Redirect back to the order history page with success message
        return redirect()->route('showOrderHistory')->with('success', 'Order marked as delivered successfully.');
    }

    public function markCancelled($id): RedirectResponse
    {
        // Find the order by ID
        $order = Order::findOrFail($id);

        // Update the order status to 'Cancelled'
        $order->status = 'Cancelled';
        $order->save();

        // Redirect back to the order history page with success message
        return redirect()->route('showOrderHistory')->with('success', 'Order marked as cancelled successfully.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        return view('adminDelete', compact('admin'));
    }

    public function delete($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.home')->with('success', 'Admin deleted successfully.');
    }
}
