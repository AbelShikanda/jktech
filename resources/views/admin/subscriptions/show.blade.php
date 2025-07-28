@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>User Subscription Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Subscription #{{ $subscription->id }}</h5>

            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>User:</strong>
                    {{ $subscription->user->name }} ({{ $subscription->user->email }})
                </li>
                <li class="list-group-item">
                    <strong>Bundle:</strong>
                    {{ $subscription->bundle->name }} – {{ $subscription->bundle->description }}
                </li>
                <li class="list-group-item">
                    <strong>Start Date:</strong>
                    {{ $subscription->start_date->format('M d, Y') }}
                </li>
                <li class="list-group-item">
                    <strong>End Date:</strong>
                    {{ $subscription->end_date->format('M d, Y') }}
                </li>
                <li class="list-group-item">
                    <strong>Status:</strong>
                    <span class="badge 
                        @if ($subscription->status === 'active') bg-success
                        @elseif ($subscription->status === 'expired') bg-secondary
                        @else bg-danger @endif">
                        {{ ucfirst($subscription->status) }}
                    </span>
                </li>
                <li class="list-group-item">
                    <strong>Created At:</strong>
                    {{ $subscription->created_at->format('M d, Y H:i') }}
                </li>
                <li class="list-group-item">
                    <strong>Updated At:</strong>
                    {{ $subscription->updated_at->format('M d, Y H:i') }}
                </li>
            </ul>

            <div class="mt-4">
                <a href="{{ route('user-bundles.edit', $subscription->id) }}" class="btn btn-info">Edit</a>
                <a href="{{ route('user-bundles.index') }}" class="btn btn-secondary">Back to List</a>
                <form action="{{ route('user-bundles.destroy', $subscription->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
