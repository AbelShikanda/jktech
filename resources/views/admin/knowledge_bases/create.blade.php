@extends('admin.layouts.app')
@section('content')
<div class="container-fluid"><div class="row justify-content-center"><div class="col-lg-10">
    <h2 class="page-title">Create Knowledge Base Article</h2>
    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    @if(($categories ?? collect())->isEmpty())<div class="alert alert-warning">No categories found. Create a Knowledge Base Category first.</div>@endif
    <div class="card shadow"><div class="card-body">
        <form method="POST" action="{{ route('knowledge-bases.store') }}">@csrf
            <div class="form-group"><label>Category</label><select name="knowledgeBase_categories_id" class="form-control" required><option value="">Select...</option>@foreach($categories as $category)<option value="{{ $category->id }}" @selected(old('knowledgeBase_categories_id')==$category->id)>{{ $category->name }}</option>@endforeach</select></div>
            <div class="form-group"><label>Title</label><input name="title" class="form-control" value="{{ old('title') }}" required></div>
            <div class="form-group"><label>Sub title</label><input name="sub_title" class="form-control" value="{{ old('sub_title') }}" placeholder="Optional"></div>
            <div class="form-group"><label>Body</label><textarea name="body" class="form-control" rows="6" required>{{ old('body', 'Placeholder knowledge base content for local testing.') }}</textarea></div>
            <div class="form-group"><label>Meta image URL (placeholder allowed)</label><input name="meta_image" class="form-control" value="{{ old('meta_image', 'https://placehold.co/1200x630?text=Knowledge+Base') }}"></div>
            <div class="form-group"><label><input type="checkbox" name="whatsapp" value="1" @checked(old('whatsapp'))> WhatsApp</label> <label class="ml-3"><input type="checkbox" name="telegram" value="1" @checked(old('telegram'))> Telegram</label> <label class="ml-3"><input type="checkbox" name="website" value="1" @checked(old('website', true))> Website</label></div>
            <button class="btn btn-primary">Save</button> <a href="{{ route('knowledge-bases.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div></div>
</div></div></div>
@endsection