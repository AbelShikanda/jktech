@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="page-title">{{ $service->name }}</h2>
        <div class="card">
            <div class="card-body">
                <p><strong>Description:</strong> {{ $service->description }}</p>
                <p><strong>Categories:</strong>
                    {{ $service->Category->pluck('name')->implode(', ') ?: 'N/A' }}
                </p>
                <p><strong>Type:</strong>
                    @foreach ($service->serviceType as $type)
                        {{ $type->name }}
                    @endforeach
                </p>
                <p><strong>Price:</strong> {{ $service->price }}</p>
                <p><strong>Meta Title:</strong> {{ $service->meta_title }}</p>
                <p><strong>Meta Description:</strong> {{ $service->meta_description }}</p>
                <p><strong>Meta Keywords:</strong> {{ $service->meta_keywords }}</p>
                <p><strong>Posted on:</strong>
                    @if ($service->whatsapp)
                        WhatsApp
                    @endif
                    @if ($service->telegram)
                        Telegram
                    @endif
                    @if ($service->website)
                        Website
                    @endif
                    @if ($service->promotion)
                        Promotion
                    @endif
                </p>
                @if ($service->meta_image)
                    <img src="{{ asset('storage/' . $service->meta_image) }}" width="200" />
                @endif
            </div>
        </div>
    </div>
@endsection
