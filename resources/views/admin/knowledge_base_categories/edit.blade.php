@extends('admin.layouts.app')
@section('content')
@can('admin.content.manage', auth('admin')->user())
<div class="container-fluid"><div class="row justify-content-center"><div class="col-md-8">
    <h2 class="page-title">Edit Knowledge Base Category</h2>
    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <div class="card shadow"><div class="card-body">
        <form method="POST" action="{{ route('knowledge-base-categories.update', $category->id) }}">@csrf @method('PUT')
            <div class="form-group"><label>Name</label><input name="name" class="form-control" value="{{ old('name', $category->name) }}" required></div>
            <div class="form-group"><label>Slug</label><input name="slug" class="form-control" value="{{ old('slug', $category->slug) }}"></div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('knowledge-base-categories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div></div>
</div></div></div>
@else
<div class="container-fluid"><div class="alert alert-danger mt-3">You do not have permission to access this form.</div></div>
@endcan
@endsection