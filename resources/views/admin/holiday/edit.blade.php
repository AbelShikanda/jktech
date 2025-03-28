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
                                <form action="{{ route('services.update', $services->id) }}" method="POST" class="needs-validation"
                                    enctype="multipart/form-data">
                                    @method('patch')
                                    @csrf
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Name</label>
                                        <input type="text" name="name" class="form-control" id="validationCustom01" value="{{ $services->name }}"
                                            required>
                                        <div class="valid-feedback"> Looks good! </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Tags</label>
                                        <input type="text" name="meta" class="form-control" id="validationCustom01" value="{{ $services->meta_keywords }}"
                                            required>
                                        <div class="valid-feedback"> Looks good! </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">category</label>
                                        <select class="validate form-control select2" id="country" name="category" data-error="#e3"
                                            placeholder="Pick a country..." required>
                                            @if ($category)
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @endif
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('category') == $category)>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">type</label>
                                        <select class="form-control select2" style="width: 100%;" name="type">
                                            @if ($service_type)
                                                <option value="{{ $service_type->id }}" selected>{{ $service_type->name }}</option>
                                            @endif
                                            @foreach ($service_types as $s)
                                                <option value="{{ $s->id }}" @selected(old('s') == $s)>{{ $s->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback"> Looks good! </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="validationTextarea">Description</label>
                                        <textarea class="form-control" name="description" id="validationTextarea" placeholder="" required>{{ $services->description }}</textarea>
                                        <div class="invalid-feedback"> Please enter a message in the
                                            textarea. </div>
                                    </div>

                                    <div class="form-group">
                                        <div
                                            class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input name="whatsapp" type="checkbox" class="custom-control-input" id="customSwitch1"
                                            {{ old('whatsapp', $services->whatsapp) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customSwitch1">posted on whatsapp</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div
                                            class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input name="telegram" type="checkbox" class="custom-control-input" id="customSwitch2"
                                            {{ old('whatsapp', $services->whatsapp) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customSwitch2">Posted on Telegram</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div
                                            class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input name="website" type="checkbox" class="custom-control-input" id="customSwitch3"
                                            {{ old('whatsapp', $services->whatsapp) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customSwitch3">posted on the Site</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div
                                            class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input name="promotion" type="checkbox" class="custom-control-input" id="customSwitch4"
                                            {{ old('whatsapp', $services->whatsapp) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customSwitch4">Has Promotion</label>
                                        </div>
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
