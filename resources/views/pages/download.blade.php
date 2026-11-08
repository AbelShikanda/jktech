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
            @forelse (($softwares ?? collect()) as $software)
                <div class="row g-5 mb-5 mt-5 py-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <h1 class="display-6 mb-4">{{ $software->name ?? 'Software' }}</h1>
                        <p class="mb-4">{{ $software->description ?? '' }}</p>

                        <div class="row g-3">
                            @forelse (($software->releases ?? collect()) as $release)
                                @php $dl = $release->download_url ?? $release->download_link ?? ''; @endphp
                                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.{{ $loop->index + 1 }}s">
                                    <div class="bg-light rounded h-100 p-3">
                                        <div class="bg-white d-flex flex-column justify-content-center text-center rounded h-100 py-4 px-3">
                                            <h6 class="mb-1">{{ ucfirst($release->os ?? 'OS') }} - v{{ $release->version ?? 'N/A' }}</h6>
                                            @if($dl)
                                                <a href="{{ \Illuminate\Support\Str::startsWith($dl, ['http://', 'https://']) ? $dl : asset($dl) }}" class="btn btn-primary mt-2" target="_blank" rel="noopener">Download</a>
                                            @else
                                                <span class="text-muted small mt-2">No download link</span>
                                            @endif
                                            <small class="text-muted mt-1">{{ optional($release->release_date)->format('M d, Y') ?? '' }}</small>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12"><p class="text-muted mb-0">No releases available.</p></div>
                            @endforelse
                        </div>
                    </div>

                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="position-relative rounded overflow-hidden h-100" style="min-height: 400px">
                            <img class="position-absolute w-100 h-100" src="{{ $software->image ? asset('storage/'.$software->image) : 'https://placehold.co/800x600?text=Software' }}" alt="{{ $software->name ?? 'Software' }}" style="object-fit: cover" onerror="this.src='https://placehold.co/800x600?text=Software'" />
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-4 text-center text-muted">No software available yet. Add software in admin to populate this page.</div>
            @endforelse
        </div>
    </div>
@endsection
