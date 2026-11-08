@extends('admin.layouts.app')

@section('content')
<div class="container-fluid"><div class="row justify-content-center"><div class="col-md-8">
    <h2 class="page-title">Service Image</h2>
    <div class="card shadow"><div class="card-body">
        @if(empty($service))
            <p class="text-muted mb-0">Service/image not found.</p>
        @else
            <p><strong>Service:</strong> {{ $service->name ?? 'N/A' }}</p>
            <p><strong>Category:</strong> {{ optional(($service->Category ?? collect())->first() ?? $service->serviceCategories)->name ?? 'N/A' }}</p>
            <p><strong>Type:</strong> {{ optional(($service->serviceType ?? collect())->first())->name ?? 'N/A' }}</p>
            @if(!empty($service->meta_image))
                <img src="{{ \Illuminate\Support\Str::startsWith($service->meta_image, ['http://','https://','/']) ? $service->meta_image : asset('storage/' . ltrim($service->meta_image, '/')) }}" alt="Image" class="img-fluid" onerror="this.style.display='none'">
            @else
                <p class="text-muted">No image available.</p>
            @endif
            <div class="mt-3"><a href="{{ route('service_Images.index') }}" class="btn btn-secondary">Back</a></div>
        @endif
    </div></div>
</div></div></div>
@endsection
