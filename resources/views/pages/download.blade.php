@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-6 mb-3">Download Our Latest Software Releases</h1>
                <p class="mb-0">
                    Find and download the latest versions of our applications for your preferred operating system.
                    Whether you're on Windows, macOS, Linux, or Kali, we’ve built powerful tools to enhance your workflow,
                    productivity, and performance. Select your platform below and get started in just one click.
                </p>
            </div>
            @foreach ($softwares as $software)
                <div class="row g-5 mb-5 mt-5 py-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <h1 class="display-6 mb-4">{{ $software->name }}</h1>
                        <p class="mb-4">{{ $software->description }}</p>

                        <div class="row g-3">
                            @foreach ($software->releases as $release)
                                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.{{ $loop->index + 1 }}s">
                                    <div class="bg-light rounded h-100 p-3">
                                        <div
                                            class="bg-white d-flex flex-column justify-content-center text-center rounded h-100 py-4 px-3">
                                            <h6 class="mb-1">{{ ucfirst($release->os) }} - v{{ $release->version }}</h6>
                                            <a href="{{ $release->download_url }}" class="btn btn-primary mt-2"
                                                target="_blank">Download</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="position-relative rounded overflow-hidden h-100" style="min-height: 400px">
                            <!-- <img class="position-absolute w-100 h-100"
                                    src="{{ asset($software->image ?? 'img/default_software.png') }}" alt=""
                                    style="object-fit: cover" /> -->

                            <a href="https://www.linkedin.com/posts/abel-shikanda-4a68a582_be-a-part-of-the-solution-for-businesses-activity-7284428647409590272-iOMB?utm_source=share&utm_medium=member_desktop&rcm=ACoAABGSzn4B-J_1M3FdCxPEv3Z_c9wuYyNDnpY"
                                target="_blank"><img class="position-absolute w-100 h-100"
                                    src="https://media.licdn.com/dms/image/v2/D4D22AQG7vFSRUJHgsQ/feedshare-shrink_800/B4DZRd9OEqHIAg-/0/1736743125126?e=1755734400&v=beta&t=_GsCVC9tQtVXeb2zqtsDP8Kp-M-uGgejI3jMrqtq4vM"
                                    alt="" style="object-fit: cover" /></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
