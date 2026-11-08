@extends('admin.layouts.app')

@section('content')
<div class="container-fluid"><div class="row justify-content-center"><div class="col-md-8">
    <h2 class="page-title">Work Schedule</h2>
    <div class="card shadow"><div class="card-body">
        @if(empty($work))
            <p class="text-muted mb-0">Schedule not found.</p>
        @else
            <p><strong>Day:</strong> {{ $work->day_of_week ?? 'N/A' }}</p>
            <p><strong>Start:</strong> {{ $work->start_time ?? 'N/A' }}</p>
            <p><strong>End:</strong> {{ $work->end_time ?? 'N/A' }}</p>
            <p><strong>Off day:</strong> {{ ($work->is_off_day ?? false) ? 'Yes' : 'No' }}</p>
            <a href="{{ route('work.edit', $work->id) }}" class="btn btn-primary">Edit</a>
        @endif
        <a href="{{ route('work.index') }}" class="btn btn-secondary">Back</a>
    </div></div>
</div></div></div>
@endsection

