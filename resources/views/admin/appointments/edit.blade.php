@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h3 mb-4 page-title">Edit appointment</h2>

                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{ route('appointment.update', $appointment->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="date">Date</label>
                                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                                        value="{{ old('date', $appointment->date) }}" required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="start_time">Start Time</label>
                                    <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror"
                                            value="{{ old('start_time', $appointment->start_time) }}" required>
                                    @error('start_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label for="end_time">End Time</label>
                                    <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror"
                                            value="{{ old('end_time', $appointment->end_time) }}" required>
                                    @error('end_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="message">Message</label>
                                <textarea name="message" rows="4" class="form-control @error('message') is-invalid @enderror">{{ old('message', $appointment->message) }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="confirmed" id="confirmed"
                                        value="1" {{ old('confirmed', $appointment->confirmed) ? 'checked' : '' }}>
                                <label class="form-check-label" for="confirmed">
                                    Confirmed
                                </label>
                            </div>

                            <div class="form-group d-flex justify-content-between">
                                <a href="{{ route('appointment.index') }}" class="btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-primary">Update appointment</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('admin.layouts.partials.modals')
@endsection
