@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Add Image to: {{ $service->name }}</h3>

        <form action="{{ route('service_Images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="service_id" value="{{ $service->id }}">

            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail Image (required)</label>
                <input type="file" name="thumbnail" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="full">Caption</label>
                <input type="text" name="full" class="form-control" id="full" value="{{ old('full') }}"
                    required>
                <div class="valid-feedback">Looks good!</div>
            </div>

            <button type="submit" class="btn btn-primary">Upload Image</button>
        </form>
    </div>
@endsection
