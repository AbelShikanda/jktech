@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center"><div class="col-12">
        <h2 class="mb-2 page-title">Knowledge Base Categories</h2>
        <p class="card-text">Manage knowledge base categories (placeholder/local-testable data supported).</p>
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if(auth('admin')->user()?->can('admin.content.manage'))
        <a href="{{ route('knowledge-base-categories.create') }}" class="btn btn-primary mb-3">Add Category</a>
        @endif
        <div class="card shadow"><div class="card-body">
            @if(($categories ?? collect())->isEmpty())
                <p class="text-muted mb-0">No knowledge base categories found. Create one to get started.</p>
            @else
            <table class="table">
                <thead><tr><th>ID</th><th>Name</th><th>Slug</th><th>Actions</th></tr></thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            @if(auth('admin')->user()?->can('admin.content.manage'))
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('knowledge-base-categories.edit', $category->id) }}">Edit</a>
                            <form action="{{ route('knowledge-base-categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                            @else
                            <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div></div>
    </div></div>
</div>
@endsection