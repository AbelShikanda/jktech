@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="page-title">Edit Service</h2>
    <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="{{ $service->name }}" required>
        </div>
        <div class="form-group">
            <label>Meta Title</label>
            <input type="text" class="form-control" name="meta_title" value="{{ $service->meta_title }}" required>
        </div>
        <div class="form-group">
            <label>Meta Description</label>
            <textarea class="form-control" name="meta_description" required>{{ $service->meta_description }}</textarea>
        </div>
        <div class="form-group">
            <label>Meta Keywords</label>
            <input type="text" class="form-control" name="meta_keywords" value="{{ $service->meta_keywords }}" required>
        </div>
        <div class="form-group">
            <label>Meta Image</label>
            <input type="file" class="form-control" name="meta_image">
        </div>
        <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $service->categories_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Type</label>
            <select class="form-control" name="type" required>
                @foreach ($serviceTypes as $type)
                    <option value="{{ $type->id }}" {{ $type->id == $service->type_id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description" required>{{ $service->description }}</textarea>
        </div>
        @foreach (['whatsapp', 'telegram', 'website', 'promotion'] as $channel)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="{{ $channel }}" id="{{ $channel }}"
                    {{ $service->$channel ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $channel }}">
                    Post on {{ ucfirst($channel) }}
                </label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
