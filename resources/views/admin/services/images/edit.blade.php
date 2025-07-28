@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Edit Image for: {{ $service->name }}</h3>

        <form action="{{ route('service_Images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Current Thumbnail</label><br>
                @if ($image->thumbnail)
                    <img src="{{ asset('storage/' . $image->thumbnail) }}" width="150">
                @else
                    <p>No image</p>
                @endif
            </div>

            <div class="mb-3">
                <label>New Thumbnail</label>
                <input type="file" name="thumbnail" class="form-control">
            </div>

            <div class="mb-3">
                <label for="full">Caption</label>
                <input type="text" name="full" class="form-control" id="full" value="{{ old('full') }}">
                <div class="valid-feedback">Looks good!</div>
            </div>

            <button type="submit" class="btn btn-primary">Update Image</button>
        </form>
    </div>
@endsection
