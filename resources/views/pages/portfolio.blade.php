@extends('layouts.app')

@section('content')
    <!-- Page Header Start -->
    @include('layouts.breadcrumb')
    <!-- Page Header End -->

    <!-- Portfolio Section Start -->
    <div class="container-fluid py-5 bg-light">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 700px">
                <h1 class="display-6">Our Featured Projects</h1>
                <p class="text-muted">A showcase of select digital projects we’ve delivered for businesses like yours — from
                    websites to platforms and applications.</p>
            </div>

            <div class="row g-4 justify-content-center">
                @forelse (($portfolio ?? collect()) as $project)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.{{ $loop->iteration }}s">
                        <div class="bg-white rounded shadow-sm overflow-hidden h-100">
                            <div class="portfolio-image-container">
                                @php $img = $project->image_one ? asset('storage/' . $project->image_one) : 'https://placehold.co/600x400?text=Portfolio'; @endphp
                                <img src="{{ $img }}" class="img-fluid w-100" style="height: 220px; object-fit: cover;" alt="{{ $project->title ?? 'Project' }}" onerror="this.src='https://placehold.co/600x400?text=Portfolio'">
                            </div>
                            <div class="p-4">
                                <h5 class="mb-2">{{ $project->title ?? 'Untitled Project' }}</h5>
                                <p class="text-muted mb-3">{{ \Illuminate\Support\Str::limit($project->description ?? '', 120) }}</p>
                                @if(!empty($project->url))
                                    <a href="{{ $project->url }}" target="_blank" rel="noopener" class="btn btn-dark btn-sm">View</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">No projects available yet. Add portfolio items in admin to populate this section.</p>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Portfolio Section End -->
@endsection
