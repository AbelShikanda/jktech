@extends('admin.layouts.app')
@section('content')
<div class="container-fluid"><div class="row justify-content-center"><div class="col-md-8">
    <h2 class="page-title">Create Knowledge Base Category</h2>
    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <div class="card shadow"><div class="card-body">
        <form method="POST" action="{{ route('knowledge-base-categories.store') }}">@csrf
            <div class="form-group"><label>Name</label><input name="name" class="form-control" value="{{ old('name') }}" required></div>
            <div class="form-group"><label>Slug (optional)</label><input name="slug" class="form-control" value="{{ old('slug') }}" placeholder="auto-generated from name"></div>
            <button class="btn btn-primary">Save</button>
            <a href="{{ route('knowledge-base-categories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div></div>
</div></div></div>
@endsection