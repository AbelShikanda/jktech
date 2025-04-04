@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Edit service</h2>
                <p class="text-muted">update the services for posting</p>

                @if (count($errors) > 0)
                    <div class="alert alert-danger col-md-8 offset-md-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <strong class="card-title">Edit service Posts</strong>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('portfolio.update', $work->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="col-md-12 mb-3">
                                        <label for="url">URL</label>
                                        <input type="text" name="url" class="form-control" id="url"
                                            value="{{ old('url', $work->url) }}" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="title"
                                            value="{{ old('title', $work->title) }}" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" required>{{ old('description', $work->description) }}</textarea>
                                        <div class="invalid-feedback">Please enter a description.</div>
                                    </div>

                                    @foreach (['image_one', 'image_two', 'image_three'] as $field)
                                        <div class="col-md-12 mb-3">
                                            <label
                                                for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                            @if ($work->$field)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $work->$field) }}"
                                                        alt="{{ $field }}" class="img-thumbnail"
                                                        style="max-width: 200px;">
                                                </div>
                                            @endif
                                            <input type="file" name="{{ $field }}" class="form-control"
                                                id="{{ $field }}" accept="image/jpeg,image/png,image/jpg">
                                        </div>
                                    @endforeach

                                    <button class="btn btn-success" type="submit">Update Portfolio</button>
                                </form>

                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.col -->
                </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    @include('admin.layouts.partials.modals')
@endsection
