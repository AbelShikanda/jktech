@extends('admin.layouts.app')
@section('content')
<div class="container-fluid"><div class="row justify-content-center"><div class="col-lg-10">
    <h2 class="page-title">Edit Knowledge Base Article</h2>
    @if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <div class="card shadow"><div class="card-body">
        <form method="POST" action="{{ route('knowledge-bases.update', $item->id) }}">@csrf @method('PUT')
            <div class="form-group"><label>Category</label><select name="knowledgeBase_categories_id" class="form-control" required>@foreach($categories as $category)<option value="{{ $category->id }}" @selected(old('knowledgeBase_categories_id', $item->knowledgeBase_categories_id)==$category->id)>{{ $category->name }}</option>@endforeach</select></div>
            <div class="form-group"><label>Title</label><input name="title" class="form-control" value="{{ old('title', $item->title) }}" required></div>
            <div class="form-group"><label>Sub title</label><input name="sub_title" class="form-control" value="{{ old('sub_title', $item->sub_title) }}"></div>
            <div class="form-group"><label>Body</label><textarea name="body" class="form-control" rows="6" required>{{ old('body', $item->body) }}</textarea></div>
            <div class="form-group"><label>Meta image URL</label><input name="meta_image" class="form-control" value="{{ old('meta_image', $item->meta_image) }}"></div>
            <div class="form-group"><label><input type="checkbox" name="whatsapp" value="1" @checked(old('whatsapp', $item->whatsapp))> WhatsApp</label> <label class="ml-3"><input type="checkbox" name="telegram" value="1" @checked(old('telegram', $item->telegram))> Telegram</label> <label class="ml-3"><input type="checkbox" name="website" value="1" @checked(old('website', $item->website))> Website</label></div>
            <button class="btn btn-primary">Update</button> <a href="{{ route('knowledge-bases.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div></div>
</div></div></div>
@endsection