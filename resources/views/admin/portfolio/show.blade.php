@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h3 mb-4 page-title">Portfolio Details</h2>
                <div class="row mt-5 align-items-center">
                    <div class="col-md-3 text-center mb-5">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('storage/' . $portfolio->image_one) }}" alt="Thumbnail" class="avatar-img rounded-circle">
                        </div>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <h4 class="mb-1">{{ $portfolio->title }}</h4>
                                <p class="small mb-3"><span class="badge badge-dark">Created on: {{ $portfolio->created_at }}</span></p>
                                <div class="">
                                    <p class="text-muted">{{ $portfolio->description }}</p>
                                    <p class="text-muted">URL: <a href="{{ $portfolio->url }}" target="_blank">{{ $portfolio->url }}</a></p>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="card-deck my-4">
                                    <div class="card mb-4">
                                        <div class="card-body text-center my-4">
                                            <p class="small mb-0 text-muted">Category: {{ $portfolio->category->name ?? 'N/A' }}</p>
                                            <p class="small mb-0 text-muted">Type: {{ $portfolio->type->name ?? 'N/A' }}</p>
                                        </div>
                                    </div> <!-- .card -->
                                </div> <!-- .card-group -->
                            </div>
                        </div>
                    </div>
                </div>

                <h3>Images</h3>
                <div class="row">
                    @foreach (['image_one', 'image_two', 'image_three'] as $image)
                        @if ($portfolio->$image)
                            <div class="col-md-4 mb-4">
                                <img src="{{ asset('storage/' . $portfolio->$image) }}" class="img-fluid rounded shadow" alt="{{ $image }}">
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="row mt-4">
                    <div class="col-md-5"></div>
                    <div class="col">
                        <a class="btn mb-2 btn-warning btn-lg" href="{{ route('portfolio.edit', $portfolio->id) }}">Edit</a>
                    </div>
                    <div class="col">
                        <form action="{{ route('portfolio.destroy', $portfolio->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn mb-2 btn-danger btn-lg">Remove</button>
                        </form>
                    </div>
                    <div class="col-md-5"></div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.partials.modals')
@endsection
