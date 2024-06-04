<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contact');
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
    public function store(StoreContactRequest $request)
    {
        // Retrieve the authenticated user's ID, name, and email
        $customer_id = auth()->id();
        $name = auth()->user()->name;
        $email = auth()->user()->email;

        // Create a new Contact instance with the form data
        $contact = new Contact([
            'customer_id' => $customer_id,
            'name' => $name,
            'email' => $email,
            'topic' => $request->input('topic'),
            'feedback' => $request->input('feedback'),
        ]);

        // Save the contact record to the database
        $contact->save();

        // Redirect to a success page or route
        return redirect()->route('contact.index')->with("info", "Submit Successful");
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
