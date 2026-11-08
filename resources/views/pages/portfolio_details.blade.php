@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')

    <div class="container-xxl py-5">
        <div class="container">
            @if(!empty($project))
                <h1 class="display-6 mb-3">{{ $project->title ?? 'Portfolio Details' }}</h1>
                <p class="text-muted">{{ $project->description ?? '' }}</p>
            @else
                <div class="text-center mx-auto" style="max-width: 700px">
                    <h1 class="display-6 mb-3">Portfolio Details</h1>
                    <p class="text-muted mb-3">Select a project from the portfolio to view details.</p>
                    <a href="{{ route('portfolio') }}" class="btn btn-primary">Back to Portfolio</a>
                </div>
            @endif
        </div>
    </div>
@endsection
