@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="mb-2 page-title">Bundles</h2>
            <a href="{{ route('bundles.create') }}" class="btn btn-primary mb-3">+ Create New Bundle</a>

            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <table class="table datatables" id="dataTable-1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price (KES)</th>
                                <th>Recurring</th>
                                <th>Trial</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bundles as $bundle)
                                <tr>
                                    <td>{{ $bundle->name }}</td>
                                    <td>{{ number_format($bundle->price, 2) }}</td>
                                    <td>{{ $bundle->is_recurring ? 'Yes' : 'No' }}</td>
                                    <td>{{ $bundle->trial_days }} days</td>
                                    <td class="d-flex gap-1 flex-wrap">
                                        <a href="{{ route('bundles.show', $bundle->id) }}" class="btn btn-sm btn-secondary">View</a>
                                        <a href="{{ route('bundles.edit', $bundle->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <form action="{{ route('bundles.destroy', $bundle->id) }}" method="POST" onsubmit="return confirm('Delete this bundle?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
