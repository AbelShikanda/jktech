@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>User Subscriptions</h2>
    <a href="{{ route('user-bundles.create') }}" class="btn btn-primary mb-3">+ Add Subscription</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Bundle</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions as $subscription)
                <tr>
                    <td>{{ $subscription->user->first_name }}</td>
                    <td>{{ $subscription->bundle->name }}</td>
                    <td>{{ $subscription->start_date }}</td>
                    <td>{{ $subscription->end_date }}</td>
                    <td><span class="badge bg-{{ $subscription->status === 'active' ? 'success' : ($subscription->status === 'expired' ? 'secondary' : 'danger') }}">{{ ucfirst($subscription->status) }}</span></td>
                    <td>
                        <a href="{{ route('user-bundles.show', $subscription->id) }}" class="btn btn-sm btn-secondary">View</a>
                        <a href="{{ route('user-bundles.edit', $subscription->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('user-bundles.destroy', $subscription->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
@endsection
