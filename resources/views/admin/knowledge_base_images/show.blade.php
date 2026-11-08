@extends('admin.layouts.app')
@section('content')
<div class="container-fluid"><div class="row justify-content-center"><div class="col-lg-8">
    <h2 class="page-title">Knowledge Base Image</h2>
    <div class="card shadow"><div class="card-body">
        <p><strong>ID:</strong> {{ $image->id }}</p>
        <p><strong>Article:</strong> {{ optional($image->knowledgeBases->first())->title ?? $image->knowledgeBases_id }}</p>
        @if($image->thumbnail)<p><img src="{{ $image->thumbnail }}" alt="thumbnail" style="max-width:240px" class="img-fluid border rounded"></p>@endif
        @if($image->full)<p><img src="{{ $image->full }}" alt="full" style="max-width:480px" class="img-fluid border rounded"></p>@endif
        <a href="{{ route('knowledge-base-images.edit', $image->id) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('knowledge-base-images.index') }}" class="btn btn-secondary">Back</a>
    </div></div>
</div></div></div>
@endsection