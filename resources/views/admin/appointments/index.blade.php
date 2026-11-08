@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">appointments Table</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text">
                            All scheduled appointments and appointments in the system.
                        </p>
                    </div>
                </div>

                @if (session('success'))
                    <div class="text-success text-center">
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif

                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Date</th>
                                            <th>Start Time</th>
                                            <th>Confirmed</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse (($appointments ?? collect()) as $appointment)
                                            <tr>
                                                <td>{{ optional($appointment->user)->first_name ?? optional($appointment->user)->email ?? 'N/A' }}</td>
                                                <td>{{ optional($appointment->date)->format('Y-m-d') ?? $appointment->date ?? 'N/A' }}</td>
                                                <td>{{ $appointment->start_time ? \Carbon\Carbon::parse($appointment->start_time)->format('H:i') : 'N/A' }}</td>
                                                <td>
                                                    @if ($appointment->confirmed)
                                                        <span class="badge bg-success">Yes</span>
                                                    @else
                                                        <span class="badge bg-warning">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ route('appointment.edit', $appointment->id) }}">Edit</a>
                                                        <a class="dropdown-item" href="{{ route('appointment.show', $appointment->id) }}">View</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="5" class="text-muted text-center">No appointments found.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> 

    @include('admin.layouts.partials.modals')
@endsection
