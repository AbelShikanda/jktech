@extends('layouts.app')

@section('content')
    <!-- Page Header Start -->
    @include('layouts.breadcrumb')
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Contact Form -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="display-6 mb-4">We’d Love to Hear From You</h1>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <p class="mb-4">
                        Whether you’re curious about features, need a demo, or just want to talk — we're here to help.
                        Feel free to leave a message and we’ll get back to you as soon as possible.
                    </p>
                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Your Name" required />
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Your Email" required />
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" name="subject"
                                        placeholder="Subject" required />
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" style="height: 100px"
                                        required></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary py-3 px-5" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Google Map -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 450px">
                    <div class="position-relative rounded overflow-hidden h-100">
                        <iframe class="position-relative w-100 h-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15955.269362518912!2d36.8048609!3d-1.2920659!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f10e8230e8c8d%3A0x665c32eabfa76d7b!2sNairobi%2C%20Kenya!5e0!3m2!1sen!2ske!4v1624893955143!5m2!1sen!2ske"
                            frameborder="0" style="min-height: 450px; border: 0" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
