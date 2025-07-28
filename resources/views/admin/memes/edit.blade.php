@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Edit Meme</h2>
                <p class="text-muted">Update the meme post</p>

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
                                <strong class="card-title">Edit Meme Post</strong>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('memes.update', $memes->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="col-md-12 mb-3">
                                        <label for="heading">Heading</label>
                                        <input type="text" name="heading" class="form-control" id="heading"
                                            value="{{ old('heading', $memes->heading) }}" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter description" required>{{ old('description', $memes->description) }}</textarea>
                                        <div class="invalid-feedback">Please enter a description.</div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="image">Image</label>
                                        @if ($memes->image)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $memes->image) }}"
                                                    alt="Current Meme Image" class="img-thumbnail"
                                                    style="max-width: 200px;">
                                            </div>
                                        @endif
                                        <input type="file" name="image" class="form-control" id="image"
                                            accept="image/jpeg,image/png,image/jpg">
                                        <small class="text-muted">Leave blank to keep existing image</small>
                                    </div>

                                    <button class="btn btn-success" type="submit">Update Meme</button>
                                </form>

                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.col -->
                </div> <!-- end section -->
            </div> <!-- /.col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    @include('admin.layouts.partials.modals')
@endsection
