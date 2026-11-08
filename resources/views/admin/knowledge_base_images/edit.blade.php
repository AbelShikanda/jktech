@extends('admin.layouts.app')
@section('content')
<div class="container-fluid"><div class="row justify-content-center"><div class="col-lg-8">
    <h2 class="page-title">Edit Knowledge Base Image</h2>
    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <div class="card shadow"><div class="card-body">
        <form method="POST" action="{{ route('knowledge-base-images.update', $image->id) }}">@csrf @method('PUT')
            <div class="form-group"><label>Article</label><select name="knowledgeBases_id" class="form-control" required>@foreach($knowledgeBases as $kb)<option value="{{ $kb->id }}" @selected(old('knowledgeBases_id', $image->knowledgeBases_id)==$kb->id)>{{ $kb->title }}</option>@endforeach</select></div>
            <div class="form-group"><label>Thumbnail URL</label><input name="thumbnail" class="form-control" value="{{ old('thumbnail', $image->thumbnail) }}"></div>
            <div class="form-group"><label>Full image URL</label><input name="full" class="form-control" value="{{ old('full', $image->full) }}"></div>
            <button class="btn btn-primary">Update</button> <a href="{{ route('knowledge-base-images.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div></div>
</div></div></div>
@endsection