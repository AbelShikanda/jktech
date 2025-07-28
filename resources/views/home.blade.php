@extends('layouts.app')

@section('content')
    @Include('layouts.carousel')
    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden rounded ps-5 pt-5 h-100" style="min-height: 400px">
                        <a href="https://www.linkedin.com/posts/abel-shikanda-4a68a582_how-to-use-ai-to-grow-your-business-in-kenya-activity-7297142820144844800-4QXL?utm_source=share&utm_medium=member_desktop&rcm=ACoAABGSzn4B-J_1M3FdCxPEv3Z_c9wuYyNDnpY"
                            target="_blank"><img class="position-absolute w-100 h-100"
                                src="https://media.licdn.com/dms/image/v2/D4D22AQHfRCIS0mOwbw/feedshare-shrink_800/B4DZUSormuHwAo-/0/1739774419886?e=1755734400&v=beta&t=CvEM5bf4SCT2DKJimipv0NBgzMbrA8eU6jYBlk7KsSU"
                                alt="" style="object-fit: cover" /></a>
                        <div class="position-absolute top-0 start-0 bg-white rounded pe-3 pb-3"
                            style="width: 200px; height: 200px">
                            <div class="d-flex flex-column justify-content-center text-center bg-dark rounded h-100 p-3">
                                <h1 class="text-white mb-0">Why</h1>
                                <h2 class="text-white">Digital</h2>
                                <h5 class="text-white mb-0">Migration</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h1 class="display-6 mb-5">
                            Essentials in today's business environment
                        </h1>
                        <p class="fs-5 text-primary mb-4">
                            Digital migration makes you competitive, efficient, and adaptable.
                            This transformation allows for real-time data access,
                            improved communication, and better collaboration across teams.
                            It also opens the door to automation, cloud services,
                            and digital tools that enhance productivity and customer experience.
                        </p>
                        <div class="row g-4 mb-4">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 me-3" src="img/icon/icon-04-primary.png" alt="" />
                                    <h5 class="mb-0">Tap Into Business Intelligence</h5>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 me-3" src="img/icon/icon-03-primary.png" alt="" />
                                    <h5 class="mb-0">Explore Your Data Analytics</h5>
                                </div>
                            </div>
                        </div>
                        <p class="mb-4">
                            Moreover, digital migration is foundational for leveraging business intelligence, data
                            analytics,
                            machine learning, and artificial intelligence, for smarter decision-making.
                            The migration isn’t just a technical upgrade—it’s a strategic
                            necessity for long-term sustainability and innovation.
                        </p>

                        <div class="bg-light rounded p-3">
                            <div class="d-flex align-items-center bg-white rounded p-3">
                                <img class="flex-shrink-0 rounded-circle me-3" src="img/logo.png" alt="" />
                                <h5 class="mb-0">Call Us: +254 759 537 406</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Appointment Start -->
    <div class="container-fluid appointment my-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                    <h1 class="display-6 text-white mb-5">
                        Book a Consultation and Elevate Your Strategy
                    </h1>
                    <p class="text-white mb-5">
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

                    <div class="bg-white rounded p-3">
                        <div class="d-flex align-items-center bg-primary rounded p-3">
                            <img class="flex-shrink-0 rounded-circle me-3" src="img/logo.png" alt="" />
                            <h5 class="text-white mb-0">Call Us: +254 759 573 406</h5>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-white rounded p-5">
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


    <!-- Features Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="display-6 mb-5">Reasons Why People Choose Me!</h1>
                    <p class="mb-4">
                        I am a part of the solution. While most experts can show you what’s happening. I build systems that
                        show you why—and what to do next.
                        While others stop at visualizing KPIs, I go beyond—designing, developing, and deploying complete
                        data-driven applications. I customize, automate, and give predictive insights from raw data to real
                        results
                    </p>
                    <div class="row g-3">
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="bg-light rounded h-100 p-3">
                                <div
                                    class="bg-white d-flex flex-column justify-content-center text-center rounded h-100 py-4 px-3">
                                    <img class="align-self-center mb-3" src="img/icon/icon-06-primary.png"
                                        alt="" />
                                    <h5 class="mb-0">Ease Processes</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.2s">
                            <div class="bg-light rounded h-100 p-3">
                                <div
                                    class="bg-white d-flex flex-column justify-content-center text-center rounded py-4 px-3">
                                    <img class="align-self-center mb-3" src="img/icon/icon-03-primary.png"
                                        alt="" />
                                    <h5 class="mb-0">Fast Decisions</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                            <div class="bg-light rounded h-100 p-3">
                                <div
                                    class="bg-white d-flex flex-column justify-content-center text-center rounded py-4 px-3">
                                    <img class="align-self-center mb-3" src="img/icon/icon-04-primary.png"
                                        alt="" />
                                    <h5 class="mb-0">Policy Controlling</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.4s">
                            <div class="bg-light rounded h-100 p-3">
                                <div
                                    class="bg-white d-flex flex-column justify-content-center text-center rounded h-100 py-4 px-3">
                                    <img class="align-self-center mb-3" src="img/icon/icon-07-primary.png"
                                        alt="" />
                                    <h5 class="mb-0">Strategic approach</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="position-relative rounded overflow-hidden h-100" style="min-height: 400px">
                        <a href="https://www.linkedin.com/posts/abel-shikanda-4a68a582_be-a-part-of-the-solution-for-businesses-activity-7284428647409590272-iOMB?utm_source=share&utm_medium=member_desktop&rcm=ACoAABGSzn4B-J_1M3FdCxPEv3Z_c9wuYyNDnpY"
                            target="_blank"><img class="position-absolute w-100 h-100"
                                src="https://media.licdn.com/dms/image/v2/D4D22AQG7vFSRUJHgsQ/feedshare-shrink_800/B4DZRd9OEqHIAg-/0/1736743125126?e=1755734400&v=beta&t=_GsCVC9tQtVXeb2zqtsDP8Kp-M-uGgejI3jMrqtq4vM"
                                alt="" style="object-fit: cover" /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto" style="max-width: 500px">
                <h1 class="display-6 mb-5">
                    We Provide Professional Business Intelligence
                </h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($services as $key => $service)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ 0.1 + ($key % 3) * 0.2 }}s">
                        <div class="service-item rounded h-100 p-5">
                            <div class="d-flex align-items-center ms-n5 mb-4">
                                <div class="service-icon flex-shrink-0 bg-dark rounded-end me-4">
                                    @if ($service->serviceImage && $service->serviceImage->thumbnail)
                                        <img class="img-fluid"
                                            src="{{ asset('storage/' . $service->serviceImage->thumbnail) }}"
                                            alt="{{ $service->name }}" />
                                    @else
                                        <img class="img-fluid" src="{{ asset('img/default-icon.png') }}"
                                            alt="Default Icon" />
                                    @endif
                                </div>
                                <h4 class="mb-0">{{ $service->name }}</h4>
                            </div>
                            <p class="mb-4">
                                {{ Str::limit($service->description, 120) }}
                            </p>
                            <!-- <a class="btn btn-light px-3" href="{{ route('service', $service->id) }}">Read
                                                            More</a> -->
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Service End -->

@endsection
