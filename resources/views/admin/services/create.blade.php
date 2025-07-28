{{-- resources/views/admin/services/create.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="page-title">Create Service</h2>
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label>Meta Title</label>
            <input type="text" class="form-control" name="meta_title" required>
        </div>
        <div class="form-group">
            <label>Meta Description</label>
            <textarea class="form-control" name="meta_description" required></textarea>
        </div>
        <div class="form-group">
            <label>Meta Keywords</label>
            <input type="text" class="form-control" name="meta_keywords" required>
        </div>
        <div class="form-group">
            <label>Meta Image</label>
            <input type="file" class="form-control" name="meta_image">
        </div>
        <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Type</label>
            <select class="form-control" name="type" required>
                @foreach ($service_types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
        @foreach (['whatsapp', 'telegram', 'website', 'promotion'] as $channel)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="{{ $channel }}" id="{{ $channel }}">
                <label class="form-check-label" for="{{ $channel }}">
                    Post on {{ ucfirst($channel) }}
                </label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary mt-3">Create</button>
    </form>
</div>
@endsection