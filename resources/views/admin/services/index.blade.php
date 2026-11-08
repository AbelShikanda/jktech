@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">services Table</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text">
                            service available in the organization
                        </p>
                    </div>
                    <div class="col-md-6">
                        @if(auth('admin')->user()?->can('admin.services.manage'))
                        <a href="{{ route('services.create') }}" type="button"
                            class=" float-right btn mb-2 btn-outline-primary">Add service</a>
                        @endif
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
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse (($services ?? collect()) as $s)
                                            <tr>
                                                <td>{{ $s->id }}</td>
                                                <td>{{ $s->name ?? 'N/A' }}</td>
                                                <td>{{ optional(($s->serviceType ?? collect())->first())->name ?? 'N/A' }}</td>
                                                <td>{{ \Illuminate\Support\Str::words($s->description ?? '', 6, '...') }}</td>
                                                <td>KES {{ number_format((float) ($s->price ?? 0), 2) }}</td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ route('services.show', $s->id) }}">View</a>
                                                        @if(auth('admin')->user()?->can('admin.services.manage'))
                                                        <a class="dropdown-item" href="{{ route('services.edit', $s->id) }}">Edit</a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="6" class="text-muted text-center">No services found.</td></tr>
                                        @endforelse
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
