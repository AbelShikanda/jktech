@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Bundle Details: {{ $bundle->name }}</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Description:</strong> {{ $bundle->description }}</p>
            <p><strong>Price:</strong> KES {{ number_format($bundle->price, 2) }}</p>
            <p><strong>Duration:</strong> {{ $bundle->duration }} {{ ucfirst($bundle->duration_unit) }}</p>
            <p><strong>Recurring:</strong> {{ $bundle->is_recurring ? 'Yes' : 'No' }}</p>
            <p><strong>Trial Days:</strong> {{ $bundle->trial_days }}</p>
            <p><strong>Type:</strong> {{ $bundle->type ?? 'N/A' }}</p>

            <p><strong>Features:</strong></p>
            @if(is_array($bundle->features))
                <ul>
                    @foreach($bundle->features as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">No features listed.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('bundles.edit', $bundle->id) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('bundles.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
