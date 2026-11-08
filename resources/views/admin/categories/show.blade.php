@extends('admin.layouts.app')

@section('content')
<div class="container-fluid"><div class="row justify-content-center"><div class="col-md-8">
    <h2 class="page-title">Service Category</h2>
    <div class="card shadow"><div class="card-body">
        <p><strong>Name:</strong> {{ $category->name ?? 'N/A' }}</p>
        <p><strong>Slug:</strong> {{ $category->slug ?? 'N/A' }}</p>
        @if(auth('admin')->user()?->can('admin.services.manage'))
        <a href="{{ route('service_categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
        @endif
        <a href="{{ route('service_categories.index') }}" class="btn btn-secondary">Back</a>
    </div></div>
</div></div></div>
@endsection
