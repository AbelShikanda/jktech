@extends('admin.layouts.app')
@section('content')
<div class="container-fluid"><div class="row justify-content-center"><div class="col-md-8">
    <h2 class="page-title">Knowledge Base Category</h2>
    <div class="card shadow"><div class="card-body">
        <p><strong>Name:</strong> {{ $category->name }}</p>
        <p><strong>Slug:</strong> {{ $category->slug }}</p>
        <a href="{{ route('knowledge-base-categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('knowledge-base-categories.index') }}" class="btn btn-secondary">Back</a>
    </div></div>
</div></div></div>
@endsection