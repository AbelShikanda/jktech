@extends('admin.layouts.app')

@section('content')
<div class="container-fluid"><div class="row justify-content-center"><div class="col-md-8">
    <h2 class="page-title">Holiday</h2>
    <div class="card shadow"><div class="card-body">
        @if(empty($holiday))
            <p class="text-muted mb-0">Holiday not found.</p>
        @else
            <p><strong>Date:</strong> {{ optional($holiday->date)->format('Y-m-d') ?? $holiday->date ?? 'N/A' }}</p>
            <p><strong>Reason:</strong> {{ $holiday->reason ?? 'N/A' }}</p>
            <a href="{{ route('holiday.edit', $holiday->id) }}" class="btn btn-primary">Edit</a>
        @endif
        <a href="{{ route('holiday.index') }}" class="btn btn-secondary">Back</a>
    </div></div>
</div></div></div>
@endsection

