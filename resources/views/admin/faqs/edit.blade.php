@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">faqs</h2>
                <p class="text-muted">edit more faqs for posting</p>

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
                                <strong class="card-title">faqs</strong>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('faqs.update', $faq->id) }}" method="POST" class="needs-validation"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Qeustion</label>
                                        <input type="text" name="question" class="form-control" id="validationCustom01" value="{{ $faq->question }}" required>
                                        <div class="valid-feedback"> Looks good! </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Answer</label>
                                        <input type="text" name="answer" class="form-control" id="validationCustom01" value="{{ $faq->answer }}" required>
                                        <div class="valid-feedback"> Looks good! </div>
                                    </div>
                                    <div class="form-group">
                                        <div
                                            class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input name="is_active" type="checkbox" class="custom-control-input" id="customSwitch2"
                                            {{ old('faq', $faq->is_active) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customSwitch2">Activate</label>
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
