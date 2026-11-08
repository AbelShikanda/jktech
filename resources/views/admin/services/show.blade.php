@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        @if(empty($service))
            <div class="alert alert-warning">Service not found. <a href="{{ route('services.index') }}">Back to list</a></div>
        @else
        <h2 class="page-title">{{ $service->name ?? 'Service' }}</h2>
        <div class="card shadow"><div class="card-body">
                <p><strong>Description:</strong> {{ $service->description ?? 'N/A' }}</p>
                <p><strong>Categories:</strong> {{ optional($service->Category ?? collect())->pluck('name')->filter()->implode(', ') ?: (optional($service->serviceCategories)->name ?? 'N/A') }}</p>
                <p><strong>Type:</strong> {{ optional($service->serviceType ?? collect())->pluck('name')->filter()->implode(', ') ?: 'N/A' }}</p>
                <p><strong>Price:</strong> KES {{ number_format((float) ($service->price ?? 0), 2) }}</p>
                <p><strong>Meta Title:</strong> {{ $service->meta_title ?? 'N/A' }}</p>
                <p><strong>Meta Description:</strong> {{ $service->meta_description ?? 'N/A' }}</p>
                <p><strong>Meta Keywords:</strong> {{ $service->meta_keywords ?? 'N/A' }}</p>
                <p><strong>Posted on:</strong>
                    {{ collect([($service->whatsapp ?? false) ? 'WhatsApp' : null, ($service->telegram ?? false) ? 'Telegram' : null, ($service->website ?? false) ? 'Website' : null, ($service->promotion ?? false) ? 'Promotion' : null])->filter()->implode(', ') ?: 'None' }}
                </p>
                @if (!empty($service->meta_image))
                    <img src="{{ \Illuminate\Support\Str::startsWith($service->meta_image, ['http://','https://','/']) ? $service->meta_image : asset('storage/' . ltrim($service->meta_image, '/')) }}" width="200" alt="Meta image" onerror="this.style.display='none'" />
                @endif
                <div class="mt-3"><a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary">Edit</a> <a href="{{ route('services.index') }}" class="btn btn-secondary">Back</a></div>
        </div></div>
        @endif
    </div>
@endsection
