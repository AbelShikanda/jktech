@extends('admin.layouts.app')
@section('content')
<div class="container-fluid"><div class="row justify-content-center"><div class="col-lg-10">
    <h2 class="page-title">Knowledge Base Article</h2>
    <div class="card shadow"><div class="card-body">
        <p><strong>Title:</strong> {{ $item->title }}</p>
        <p><strong>Slug:</strong> {{ $item->slug }}</p>
        <p><strong>Sub title:</strong> {{ $item->sub_title ?: 'N/A' }}</p>
        <p><strong>Category:</strong> {{ optional($item->knowledgeBaseCategories->first())->name ?? 'N/A' }}</p>
        <p><strong>Body:</strong></p><div class="border rounded p-3 mb-3">{!! nl2br(e($item->body)) !!}</div>
        @if($item->meta_image)<p><img src="{{ $item->meta_image }}" alt="meta" style="max-width:320px" class="img-fluid border rounded" onerror="this.src='https://placehold.co/640x360?text=Image'"></p>@endif
        <a href="{{ route('knowledge-bases.edit', $item->id) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('knowledge-bases.index') }}" class="btn btn-secondary">Back</a>
    </div></div>
</div></div></div>
@endsection