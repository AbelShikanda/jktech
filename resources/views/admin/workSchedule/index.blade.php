@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">works Table</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text">
                            work available in the organization
                        </p>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('work.create') }}" type="button"
                            class=" float-right btn mb-2 btn-outline-primary">Add work Schedule</a>
                    </div>
                </div>

                @if (Session('success'))
                    <div class="text-success text-center">
                        <strong>{{ Session('success') }}</strong>
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
                                            <th>#</th>
                                            <th>Day</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Is Off Day</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($work as $w)
                                            <tr>
                                                <td>{{ $w->id }}</td>
                                                <td>{{ $w->day_of_week }}</td>
                                                <td>{{ $w->start_time }}</td>
                                                <td>{{ $w->end_time }}</td>
                                                <td>{{ $w->is_off_day }}</td>
                                                <td><button class="btn btn-sm dropdown-toggle more-horizontal"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <!-- <a class="dropdown-item"
                                                            href="{{ route('work.show', $w->id) }}">view</a> -->
                                                        <a class="dropdown-item"
                                                            href="{{ route('work.edit', $w->id) }}">Edit</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('work.destroy', $w->id) }}"
                                                                onclick="event.preventDefault();
                                                            document.getElementById('destroy-work').submit();">
                                                                {{ __('Remove') }}
                                                            </a>

                                                            <form id="destroy-work"
                                                                action="{{ route('work.destroy', $w->id) }}"
                                                                method="POST" class="d-none">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    @include('admin.layouts.partials.modals')
@endsection
