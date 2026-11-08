@extends('admin.layouts.app')
@section('content')
@can('admin.content.manage', auth('admin')->user())
<div class="container-fluid"><div class="row justify-content-center"><div class="col-lg-8">
    <h2 class="page-title">Create Knowledge Base Image</h2>
    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    @if(($knowledgeBases ?? collect())->isEmpty())<div class="alert alert-warning">No knowledge base articles found. Create an article first (placeholder images can be added later).</div>@endif
    <div class="card shadow"><div class="card-body">
        <form method="POST" action="{{ route('knowledge-base-images.store') }}">@csrf
            <div class="form-group"><label>Article</label><select name="knowledgeBases_id" class="form-control" required><option value="">Select...</option>@foreach($knowledgeBases as $kb)<option value="{{ $kb->id }}" @selected(old('knowledgeBases_id')==$kb->id)>{{ $kb->title }}</option>@endforeach</select></div>
            <div class="form-group"><label>Thumbnail URL (optional)</label><input name="thumbnail" class="form-control" value="{{ old('thumbnail') }}" placeholder="https://placehold.co/400x300?text=KB"></div>
            <div class="form-group"><label>Full image URL (optional)</label><input name="full" class="form-control" value="{{ old('full') }}" placeholder="https://placehold.co/1200x800?text=KB"></div>
            <button class="btn btn-primary">Save</button> <a href="{{ route('knowledge-base-images.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div></div>
</div></div></div>
@else
<div class="container-fluid"><div class="alert alert-danger mt-3">You do not have permission to access this form.</div></div>
@endcan
@endsection