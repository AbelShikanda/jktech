@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h3 mb-4 page-title">appointment Details</h2>

                <div class="row mt-5 align-items-center">
                    <div class="col-md-3 text-center mb-5">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('img/avatar-placeholder.png') }}" alt="User Avatar" class="avatar-img rounded-circle">
                        </div>
                        <p class="mt-2 mb-0 text-muted">
                            {{ $appointment->user->first_name ?? 'Unknown User' }}
                        </p>
                        <small class="text-muted">{{ $appointment->user->email ?? '' }}</small>
                    </div>

                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <h4 class="mb-1">appointment for {{ $appointment->date }}</h4>
                                <p class="small mb-3">
                                    <span class="badge badge-dark">
                                        Created on: {{ optional($appointment->created_at)->format('F j, Y') }}
                                    </span>
                                </p>
                                <div>
                                    <p><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}</p>
                                    <p><strong>End Time:</strong> {{ \Carbon\Carbon::parse($appointment->end_time)->format('H:i') }}</p>
                                    <p>
                                        <strong>Status:</strong>
                                        @if ($appointment->confirmed)
                                            <span class="badge bg-success">Confirmed</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </p>
                                    <p class="text-muted"><strong>Message:</strong><br>{{ $appointment->message ?? 'No message provided.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-4"></div>
                    <div class="col">
                        <a class="btn mb-2 btn-warning btn-lg" href="{{ route('appointment.edit', $appointment->id) }}">Edit</a>
                    </div>
                    <div class="col">
                        <a href="{{ route('appointment.index') }}" class="btn mb-2 btn-secondary btn-lg">Back to List</a>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.partials.modals')
@endsection
