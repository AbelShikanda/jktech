@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4 page-title">Service Gallery</h2>

        @if (Session('success'))
            <div class="alert alert-success">
                {{ Session('success') }}
            </div>
        @endif

        <div class="row">
            @forelse ($services as $s)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @php
                            $image = $s->serviceImage;
                        @endphp

                        @if ($image && $image->thumbnail)
                            <img src="{{ asset('storage/' . $image->thumbnail) }}" alt="{{ $s->name }}"
                                class="card-img-top img-fluid" width="100">
                        @else
                            <div class="text-center p-4">
                                <a href="{{ route('service_Images.create', $s->id) }}"
                                    class="btn btn-sm btn-outline-warning">
                                    Add Image
                                </a>
                            </div>
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $s->name }}</h5>
                            <p class="card-text">{{ Str::limit($s->description, 100) }}</p>
                        </div>

                        <div class="card-footer bg-white border-top-0 d-flex justify-content-between">
                            <a href="{{ route('services.show', $s->id) }}" class="btn btn-sm btn-outline-primary">View</a>

                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton{{ $s->id }}" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    Actions
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton{{ $s->id }}">
                                    @if ($s->serviceImage)
                                        <a class="dropdown-item" href="{{ route('service_Images.edit', $s->serviceImage->id) }}">
                                            Edit Image
                                        </a>

                                        <form action="{{ route('service_Images.destroy', $s->serviceImage->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this image?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">Delete Image</button>
                                        </form>
                                    @else
                                        <a class="dropdown-item" href="{{ route('service_Images.create', $s->id) }}">Add Image</a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('services.edit', $s->id) }}">Edit Service</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">No services available.</p>
                </div>
            @endforelse
        </div>

        @include('admin.layouts.partials.modals')
    </div>
@endsection
