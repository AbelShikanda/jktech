@extends('admin.layouts.app')

@section('content')
<div class="container-fluid"><div class="row justify-content-center"><div class="col-md-8">
    <h2 class="page-title">Service Image</h2>
    <div class="card shadow"><div class="card-body">
        @php $img = $image ?? $service ?? null; @endphp
        @if(empty($img) && empty($service))
            <p class="text-muted mb-0">Service/image not found.</p>
        @else
            <p><strong>Service:</strong> {{ optional($service)->name ?? optional(optional($img)->services)->name ?? 'N/A' }}</p>
            <p><strong>Category:</strong> {{ optional(($service->Category ?? collect())->first() ?? optional($service)->serviceCategories ?? (optional(optional($img)->services)->Category ?? collect())->first())->name ?? 'N/A' }}</p>
            <p><strong>Type:</strong> {{ optional(($service->serviceType ?? collect())->first() ?? (optional(optional($img)->services)->serviceType ?? collect())->first())->name ?? 'N/A' }}</p>
            @php $src = optional($img)->thumbnail ?? optional($img)->full ?? optional($service)->meta_image; @endphp
            @if(!empty($src))
                <img src="{{ \Illuminate\Support\Str::startsWith($src, ['http://','https://','/']) ? $src : asset('storage/' . ltrim($src, '/')) }}" alt="Image" class="img-fluid" onerror="this.style.display='none'">
            @else
                <p class="text-muted">No image available.</p>
            @endif
            <div class="mt-3"><a href="{{ route('service_Images.index') }}" class="btn btn-secondary">Back</a></div>
        @endif
    </div></div>
</div></div></div>
@endsection
