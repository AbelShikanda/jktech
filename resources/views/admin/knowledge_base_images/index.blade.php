@extends('admin.layouts.app')
@section('content')
<div class="container-fluid"><div class="row justify-content-center"><div class="col-12">
    <h2 class="mb-2 page-title">Knowledge Base Images</h2>
    <p class="card-text">Image records with placeholder URLs for local testing.</p>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <a href="{{ route('knowledge-base-images.create') }}" class="btn btn-primary mb-3">Add Image</a>
    <div class="card shadow"><div class="card-body">
        @if(($images ?? collect())->isEmpty())
            <p class="text-muted mb-0">No knowledge base images found. Add one using a placeholder URL or local path.</p>
        @else
        <table class="table"><thead><tr><th>ID</th><th>Article</th><th>Thumbnail</th><th>Actions</th></tr></thead><tbody>
        @foreach($images as $image)
            <tr>
                <td>{{ $image->id }}</td>
                <td>{{ optional($image->knowledgeBases->first())->title ?? $image->knowledgeBases_id }}</td>
                <td>@if($image->thumbnail)<img src="{{ $image->thumbnail }}" alt="" style="max-width:80px" class="img-thumbnail" onerror="this.src='https://placehold.co/80x60?text=img'">@else N/A @endif</td>
                <td>
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('knowledge-base-images.edit', $image->id) }}">Edit</a>
                    <form action="{{ route('knowledge-base-images.destroy', $image->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this image?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form>
                </td>
            </tr>
        @endforeach
        </tbody></table>
        @endif
    </div></div>
</div></div></div>
@endsection