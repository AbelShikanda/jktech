@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 700px">
                <h1 class="display-6">Service Catalog</h1>
                <p class="text-muted">Browse available services. Placeholders are shown when images are missing.</p>
            </div>
            <div class="row g-4">
                @forelse (($services ?? collect()) as $service)
                    <div class="col-lg-4 col-md-6">
                        <div class="bg-white rounded shadow-sm h-100 p-4">
                            @php $thumb = optional($service->serviceImage)->thumbnail; @endphp
                            <img class="img-fluid rounded mb-3" src="{{ $thumb ? asset('storage/' . $thumb) : 'https://placehold.co/600x400?text=Service' }}" alt="{{ $service->name ?? 'Service' }}" onerror="this.src='https://placehold.co/600x400?text=Service'">
                            <h5>{{ $service->name ?? 'Service' }}</h5>
                            <p class="text-muted">{{ \Illuminate\Support\Str::limit($service->description ?? '', 120) }}</p>
                            <p class="mb-2"><strong>KES {{ number_format((float) ($service->price ?? 0), 2) }}</strong></p>
                            <a href="{{ route('service', $service->id) }}" class="btn btn-sm btn-primary">View</a>
                        </div>
                    </div>
                @empty
                    <div class="col-12"><p class="text-center text-muted">No services available yet. Add services in admin or seed placeholder data.</p></div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
