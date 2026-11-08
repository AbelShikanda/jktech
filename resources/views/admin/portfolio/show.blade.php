@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h3 mb-4 page-title">Portfolio Details</h2>
                @if(empty($portfolio))
                    <div class="alert alert-warning">Portfolio item not found. <a href="{{ route('portfolios.index') }}">Back</a></div>
                @else
                <div class="row mt-5 align-items-center">
                    <div class="col-md-3 text-center mb-5">
                        <div class="avatar avatar-xl">
                            <img src="{{ !empty($portfolio->image_one) ? asset('storage/' . ltrim($portfolio->image_one, '/')) : 'https://placehold.co/200x200?text=Work' }}" alt="Thumbnail" class="avatar-img rounded-circle" onerror="this.src='https://placehold.co/200x200?text=Work'">
                        </div>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <h4 class="mb-1">{{ $portfolio->title ?? 'N/A' }}</h4>
                                <p class="small mb-3"><span class="badge badge-dark">Created on: {{ optional($portfolio->created_at)->format('F j, Y') ?? 'N/A' }}</span></p>
                                <div class="">
                                    <p class="text-muted">{{ $portfolio->description ?? '' }}</p>
                                    @if(!empty($portfolio->url))
                                    <p class="text-muted">URL: <a href="{{ $portfolio->url }}" target="_blank" rel="noopener">{{ $portfolio->url }}</a></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h3>Images</h3>
                <div class="row">
                    @foreach (['image_one', 'image_two', 'image_three'] as $image)
                        @if (!empty($portfolio->$image))
                            <div class="col-md-4 mb-4">
                                <img src="{{ asset('storage/' . ltrim($portfolio->$image, '/')) }}" class="img-fluid rounded shadow" alt="{{ $image }}" onerror="this.style.display='none'">
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="row mt-4">
                    <div class="col-md-5"></div>
                    @if(auth('admin')->user()?->can('admin.content.manage'))
                    <div class="col"><a class="btn mb-2 btn-warning btn-lg" href="{{ route('portfolios.edit', $portfolio->id) }}">Edit</a></div>
                    <div class="col">
                        <form action="{{ route('portfolios.destroy', $portfolio->id) }}" method="POST" onsubmit="return confirm('Delete this portfolio item?')">@csrf @method('DELETE')
                            <button type="submit" class="btn mb-2 btn-danger btn-lg">Remove</button>
                        </form>
                    </div>
                    @endif
                    <div class="col-md-5"></div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @include('admin.layouts.partials.modals')
@endsection
