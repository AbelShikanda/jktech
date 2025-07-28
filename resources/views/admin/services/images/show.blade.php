@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h3 mb-4 page-title">service Details</h2>
                <div class="row mt-5 align-items-center">
                    <div class="col-md-3 text-center mb-5">
                        <div class="avatar avatar-xl">
                            <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <h4 class="mb-1">{{ $service->name }}</h4>
                                <p class="small mb-3"><span class="badge badge-dark">Created on:
                                        {{ $service->created_at }}</span></p>
                                <div class="">
                                    <p class="text-muted">
                                        {{ $service->description }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="card-deck my-4">
                                    <div class="card mb-4">
                                        <div class="card-body text-center my-4">
                                            <a href="#">
                                                <h3 class="h5 mt-4 mb-0">{{ $service->slug }}</h3>
                                            </a>
                                            <p class="text-muted">Meta Tags: {{ $service->meta_keywords }}</p>

                                            <div class="">
                                                <p class="small mb-0 text-muted">Category: &nbsp;&nbsp;
                                                    {{ $service->Category[0]->name }}</p>
                                                <p class="small mb-0 text-muted">type:
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    {{ $service->serviceType[0]->name }}</p>
                                            </div>
                                        </div> <!-- .card-body -->
                                    </div> <!-- .card -->
                                </div> <!-- .card-group -->
                            </div>
                        </div>
                        <div class="row mb-5">
                        </div>
                    </div>
                </div>
                <h3>About service</h3>
                <p class="text-muted">This is a desctiption about {{ $service->name }}.</p>
                <div class="card-deck my-4">
                    <div class="card mb-4">
                        <div class="card-body text-center my-4">
                            <a href="#">
                                <h3 class="h5 mt-4 mb-0">{{ $service->name }}</h3>
                            </a>
                            <span class="h1 mb-0">Ksh {{ $service->price }}</span>
                            <p class="text-muted">Made in Kenya</p>
                            <ul class="list-unstyled">
                                <li>This service was created by admin</li>
                                @if ($service->whatsapp == 1)
                                    <li>Has already been posted on whatsapp</li>
                                @else
                                    <li>Not yet posted on whatsapp</li>
                                @endif
                                @if ($service->telegram == 1)
                                    <li>Has already been posted on telegram</li>
                                @else
                                    <li>Not yet posted on telegram</li>
                                @endif
                                @if ($service->website == 1)
                                    <li>Has already been posted on website</li>
                                @else
                                    <li>Not yet posted on website</li>
                                @endif
                                @if ($service->promotion == 1)
                                    <li>Has already been promoted</li>
                                @else
                                    <li>Not yet promoted</li>
                                @endif
                            </ul>
                            <div class="row">
                                <div class="col-md-5"></div>
                                <div class="col">
                                    <a class="btn mb-2 btn-warning btn-lg"
                                        href="{{ route('services.edit', $service->id) }}">Edit</a>
                                </div>
                                <div class="col">
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn mb-2 btn-danger btn-lg">Remove</button>
                                    </form>
                                </div>
                                <div class="col-md-5"></div>
                            </div>
                        </div> <!-- .card-body -->
                    </div> <!-- .card -->
                </div> <!-- .card-group -->
            </div> <!-- /.col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    @include('admin.layouts.partials.modals')
@endsection
