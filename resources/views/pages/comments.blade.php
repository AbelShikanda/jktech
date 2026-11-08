@extends('layouts.app')

@section('content')
    @include('layouts.breadcrumb')

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-4" style="max-width: 700px">
                <h1 class="display-6">Comments</h1>
                <p class="text-muted mb-0">Feedback and comments will appear here. No comments yet.</p>
            </div>
            <div class="bg-light rounded p-4 text-center text-muted">
                <p class="mb-0">This section is ready for local testing and future data integration.</p>
            </div>
        </div>
    </div>
@endsection
