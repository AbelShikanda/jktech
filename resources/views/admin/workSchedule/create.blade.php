@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">work schedule Posts</h2>
                <p class="text-muted">add more schedules for posting</p>

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
                                <strong class="card-title">work schedule Posts</strong>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('work.store') }}" method="POST" class="needs-validation">
                                    @csrf
                                    @method('post')

                                    <div class="col-md-12 mb-3">
                                        <label for="day_of_week">Day of the Week</label>
                                        <select name="day_of_week" class="form-control" id="day_of_week" required>
                                            <option value="">Select a day</option>
                                            @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                                <option value="{{ $day }}">{{ $day }}</option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback"> Looks good! </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="start_time">Start Time</label>
                                        <input type="time" name="start_time" class="form-control" id="start_time"
                                            required>
                                        <div class="valid-feedback"> Looks good! </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="end_time">End Time</label>
                                        <input type="time" name="end_time" class="form-control" id="end_time" required>
                                        <div class="valid-feedback"> Looks good! </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="is_off_day">Is Off Day?</label>
                                        <select name="is_off_day" class="form-control" id="is_off_day" required>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                        <div class="valid-feedback"> Looks good! </div>
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
