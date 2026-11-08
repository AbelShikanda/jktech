@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Holidays</h2>
    @if(auth('admin')->user()?->can('admin.settings.manage'))
    <a href="{{ route('holiday.create') }}" class="btn btn-primary mb-3">+ Add Holiday</a>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Reason</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse(($holiday ?? collect()) as $item)
                <tr>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->reason ?? 'N/A' }}</td>
                    <td>
                        @if(auth('admin')->user()?->can('admin.settings.manage'))
                        <a href="{{ route('holiday.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('holiday.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this holiday?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        @else
                        <span class="text-muted">View only</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-muted">No holidays found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
