@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Service Types Table</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text">
                            Types of Services available in the organization
                        </p>
                    </div>
                    <div class="col-md-6">
                        @if(auth('admin')->user()?->can('admin.services.manage'))
                        <a href="{{ route('types.create') }}" type="button"
                            class=" float-right btn mb-2 btn-outline-primary">Add Type</a>
                        @endif
                    </div>
                </div>

                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
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
                                            <!-- <th>Slug</th> -->
                                            <th>Price</th>
                                            <!-- <th>Created At</th> -->
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse (($types ?? collect()) as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>KES {{ number_format((float) ($item->price ?? 0), 2) }}</td>
                                                <td>{{ optional($item->updated_at)->format('Y-m-d H:i') ?? 'N/A' }}</td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @if(auth('admin')->user()?->can('admin.services.manage'))
                                                        <a class="dropdown-item" href="{{ route('types.edit', $item->id) }}">Edit</a>
                                                        <a class="dropdown-item" href="{{ route('types.destroy', $item->id) }}" onclick="event.preventDefault(); document.getElementById('destroy-type-{{ $item->id }}').submit();">{{ __('Remove') }}</a>
                                                        <form id="destroy-type-{{ $item->id }}" action="{{ route('types.destroy', $item->id) }}" method="POST" class="d-none">@csrf @method('DELETE')</form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="5" class="text-muted text-center">No service types found.</td></tr>
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
