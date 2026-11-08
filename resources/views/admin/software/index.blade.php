@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Software List</h2>
    <a href="{{ route('software.create') }}" class="btn btn-primary mb-3">+ Add Software</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Releases</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse(($software ?? collect()) as $item)
                <tr>
                    <td>{{ $item->name ?? 'N/A' }}</td>
                    <td>
                        @if(($item->releases ?? collect())->isEmpty())
                            <span class="text-muted">No releases</span>
                        @else
                        <ul class="mb-0">
                            @foreach($item->releases as $release)
                                <li>{{ $release->os ?? 'N/A' }} - v{{ $release->version ?? 'N/A' }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('software.show', $item->id) }}" class="btn btn-sm btn-secondary">View</a>
                        <a href="{{ route('software.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('software.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-muted text-center">No software found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
