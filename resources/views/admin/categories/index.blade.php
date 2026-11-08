@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Service Categories Table</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text">
                            Categories for all the Services on sale
                        </p>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('service_categories.create')}}" type="button" class=" float-right btn mb-2 btn-outline-primary">Add Product Category</a>
                    </div>
                </div>
                <p class="card-text">
                </p>

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
                                            <th>created at</th>
                                            <th>updated at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse (($serviceCategories ?? collect()) as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ optional($item->created_at)->format('Y-m-d H:i') ?? 'N/A' }}</td>
                                                <td>{{ optional($item->updated_at)->format('Y-m-d H:i') ?? 'N/A' }}</td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ route('service_categories.edit', $item->id) }}">Edit</a>
                                                        <form action="{{ route('service_categories.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">@csrf @method('DELETE')<button class="dropdown-item" type="submit">Remove</button></form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="5" class="text-muted text-center">No service categories found.</td></tr>
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
