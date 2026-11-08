@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h3 mb-4 page-title">Meme Details</h2>
                @if(empty($memes))
                    <div class="alert alert-warning">Meme not found. <a href="{{ route('memes.index') }}">Back to list</a></div>
                @else
                <div class="row mt-5 align-items-center">
                    <div class="col-md-3 text-center mb-5">
                        <div class="avatar avatar-xl">
                            <img src="{{ $memes->image ? asset('storage/' . $memes->image) : 'https://placehold.co/200x200?text=Meme' }}" alt="Meme Thumbnail" class="avatar-img rounded-circle" onerror="this.src='https://placehold.co/200x200?text=Meme'">
                        </div>
                    </div>
                    <div class="col">
                        <h4 class="mb-1">{{ $memes->heading ?? 'N/A' }}</h4>
                        <p class="small mb-3"><span class="badge badge-dark">Created on: {{ optional($memes->created_at)->format('F j, Y') ?? 'N/A' }}</span></p>
                        <p class="text-muted">{{ $memes->description ?? '' }}</p>
                    </div>
                </div>

                <h3>Image</h3>
                <div class="row">
                    @if ($memes->image)
                        <div class="col-md-6 offset-md-3 mb-4 text-center">
                            <img src="{{ asset('storage/' . $memes->image) }}" class="img-fluid rounded shadow" alt="Meme Image" onerror="this.src='https://placehold.co/800x450?text=Meme'">
                        </div>
                    @else
                        <div class="col-12 text-center text-muted"><p>No image available for this meme.</p></div>
                    @endif
                </div>

                <div class="row mt-4">
                    <div class="col-md-5"></div>
                    <div class="col"><a class="btn mb-2 btn-warning btn-lg" href="{{ route('memes.edit', $memes->id) }}">Edit</a></div>
                    <div class="col">
                        <form action="{{ route('memes.destroy', $memes->id) }}" method="POST" onsubmit="return confirm('Delete this meme?')">@csrf @method('DELETE')
                            <button type="submit" class="btn mb-2 btn-danger btn-lg">Remove</button>
                        </form>
                    </div>
                    <div class="col-md-5"></div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @include('admin.layouts.partials.modals')
@endsection
