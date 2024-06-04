@extends('header')

@section('content')
    <div class="container border login-border mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 mb-5 mt-5">
                <div class="form-container">
                    <form method="post" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="topic">Topic</label>
                            <select class="form-control" id="topic" name="topic" required>
                                <option value="">Select Topic</option>
                                <option value="Delivery Problems">Delivery Problems</option>
                                <option value="Refunds">Refunds</option>
                                <option value="Items Issues (Damaged)">Items Issues (Damaged)</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="feedback">Feedback</label>
                            <textarea class="form-control" id="feedback" name="feedback" rows="3" required></textarea>
                        </div>

                        <!-- Add hidden fields for customer_id, name, and email if needed -->
                        <input type="hidden" name="customer_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">

                        <div class="d-grid gap-2 col-4 col-lg-3 mx-auto mt-2 float-lg-end">
                            <button class="btn button-style" type="submit" id="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
