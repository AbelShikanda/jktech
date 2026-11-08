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
            @forelse(($subscriptions ?? collect()) as $subscription)
                <tr>
                    <td>{{ optional($subscription->user)->first_name ?? optional($subscription->user)->email ?? 'N/A' }}</td>
                    <td>{{ optional($subscription->bundle)->name ?? 'N/A' }}</td>
                    <td>{{ optional($subscription->start_date)->format('Y-m-d') ?? $subscription->start_date ?? 'N/A' }}</td>
                    <td>{{ optional($subscription->end_date)->format('Y-m-d') ?? $subscription->end_date ?? 'N/A' }}</td>
                    <td><span class="badge bg-{{ ($subscription->status ?? '') === 'active' ? 'success' : (($subscription->status ?? '') === 'expired' ? 'secondary' : 'danger') }}">{{ ucfirst($subscription->status ?? 'N/A') }}</span></td>
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
            @empty
                <tr><td colspan="6" class="text-muted text-center">No subscriptions found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
