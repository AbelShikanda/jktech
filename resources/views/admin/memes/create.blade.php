@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">smemes Posts</h2>
                <p class="text-muted">add more smemes for posting</p>

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
                                <strong class="card-title">smeme Posts</strong>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('memes.store') }}" method="POST" class="needs-validation"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-md-12 mb-3">
                                        <label for="title">Heading</label>
                                        <input type="text" name="heading" class="form-control" id="heading"
                                            value="{{ old('heading') }}" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter description" required>{{ old('description') }}</textarea>
                                        <div class="invalid-feedback">Please enter a description.</div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="image">Image One</label>
                                        <input type="file" name="image" class="form-control" id="image"
                                            accept="image/jpeg,image/png,image/jpg" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                    <button class="btn btn-primary" type="submit">Submit</button>
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
