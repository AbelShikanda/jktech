@extends('admin.layouts.app')

@section('content')
<div class="container-fluid"><div class="row justify-content-center"><div class="col-md-8">
    <h2 class="page-title">Service Type</h2>
    <div class="card shadow"><div class="card-body">
        @if(empty($type))
            <p class="text-muted mb-0">Type not found.</p>
        @else
            <p><strong>Name:</strong> {{ $type->name ?? 'N/A' }}</p>
            <p><strong>Slug:</strong> {{ $type->slug ?? 'N/A' }}</p>
            <p><strong>Price:</strong> KES {{ number_format((float) ($type->price ?? 0), 2) }}</p>
            <a href="{{ route('types.edit', $type->id) }}" class="btn btn-primary">Edit</a>
        @endif
        <a href="{{ route('types.index') }}" class="btn btn-secondary">Back</a>
    </div></div>
</div></div></div>
@endsection
