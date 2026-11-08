@extends('admin.layouts.app')
@section('content')
<div class="container-fluid"><div class="row justify-content-center"><div class="col-12">
    <h2 class="mb-2 page-title">Knowledge Base</h2>
    <p class="card-text">Articles with placeholder/meta content for local testing.</p>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(auth('admin')->user()?->can('admin.content.manage'))
    <a href="{{ route('knowledge-bases.create') }}" class="btn btn-primary mb-3">Add Article</a>
    @endif
    <div class="card shadow"><div class="card-body">
        @if(($items ?? collect())->isEmpty())
            <p class="text-muted mb-0">No knowledge base articles found. Add one with placeholder content to test the section.</p>
        @else
        <table class="table"><thead><tr><th>ID</th><th>Title</th><th>Category</th><th>Actions</th></tr></thead><tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ optional($item->knowledgeBaseCategories->first())->name ?? 'N/A' }}</td>
                <td>
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('knowledge-bases.show', $item->id) }}">View</a>
                    @if(auth('admin')->user()?->can('admin.content.manage'))
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('knowledge-bases.edit', $item->id) }}">Edit</a>
                    <form action="{{ route('knowledge-bases.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this article?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody></table>
        @endif
    </div></div>
</div></div></div>
@endsection