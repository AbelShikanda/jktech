@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')

    <div class="container-xxl py-5">
        <div class="container">
            @if(!empty($service))
                <div class="row g-5">
                    <div class="col-lg-8">
                        <h1 class="display-6 mb-3">{{ $service->name ?? 'Service' }}</h1>
                        <p class="mb-4">{{ $service->description ?? 'Service details will appear here.' }}</p>
                        @if(optional($service->serviceImage)->thumbnail || optional($service->serviceImage)->full)
                            <img class="img-fluid rounded mb-4" src="{{ asset('storage/' . (optional($service->serviceImage)->full ?: optional($service->serviceImage)->thumbnail)) }}" alt="{{ $service->name ?? 'Service' }}" onerror="this.src='https://placehold.co/1200x600?text=Service'">
                        @endif
                    </div>
                    <div class="col-lg-4">
                        <div class="bg-light rounded p-4">
                            <h5 class="mb-3">Service Info</h5>
                            <p class="mb-2"><strong>Price:</strong> KES {{ number_format((float) ($service->price ?? 0), 2) }}</p>
                            <p class="mb-2"><strong>Category:</strong> {{ optional(($service->serviceType ?? collect())->first())->name ?? optional($service->serviceCategories)->name ?? 'N/A' }}</p>
                            <a href="{{ route('bookings.index') }}" class="btn btn-primary mt-2">Book Consultation</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center mx-auto" style="max-width: 700px">
                    <h1 class="display-6 mb-3">Services</h1>
                    <p class="text-muted">Select a service from the catalog or home page to view details.</p>
                    <a href="{{ route('catalog') }}" class="btn btn-primary">View Catalog</a>
                </div>
            @endif
        </div>
    </div>
@endsection
