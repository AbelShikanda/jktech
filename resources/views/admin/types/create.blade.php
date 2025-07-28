@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Types</h2>
                <p class="text-muted">Add more types for posting</p>

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
                                <strong class="card-title">New Type</strong>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('types.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data">
                                    @csrf
                                    @method('post')

                                    <div class="col-md-12 mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug') }}" >
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" class="form-control" id="price" value="{{ old('price') }}" step="0.01" min="0" required>
                                    </div>

                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </form>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.col -->
                </div> <!-- end section -->
            </div>
        </div>
    </div>
    @include('admin.layouts.partials.modals')
@endsection
