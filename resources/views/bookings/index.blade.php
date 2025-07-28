@extends('layouts.app')

@section('content')

    @include('layouts.breadcrumb')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger text-center">
            <strong>{{ session('error') }}</strong>
        </div>
    @endif

    <!-- Appointment Start -->
    <div class="container-fluid my-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                    <h1 class="display-6 mb-5">
                        Book a Consultation and Elevate Your Strategy
                    </h1>
                    <p class="mb-5">
                        Discover opportunities, clarify your vision, and gain actionable steps for growth. Our
                        consultations are designed to give you real value from the very first conversation.
                    </p>

                    @if (count($errors) > 0)
                        <div class="alert alert-danger col-md-8 offset-md-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="bg-light rounded p-3">
                        <div class="d-flex align-items-center bg-white rounded p-3">
                            <img class="flex-shrink-0 rounded-circle me-3" src="img/logo.png" alt="" />
                            <h5 class=" mb-0">Call Us: +254 759 573 406</h5>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-light rounded p-5">
                        <form method="POST" action="{{ route('bookings.store') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="date" name="date" required>
                                        <label for="date">Booking Date</label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="time" class="form-control" id="start_time" name="start_time"
                                            required>
                                        <label for="start_time">Start Time</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select" id="service" name="service" required>
                                            <option selected disabled>Select Service</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="service">Service Type</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" style="height: 80px"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            placeholder="e.g. 07XXXXXXXX" required>
                                        <label for="phone">M-pesa Phone Number For Payment</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-dark py-3 px-5">
                                        Get Appointment
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->
@endsection
