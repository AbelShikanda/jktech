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
            @foreach($software as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>
                        <ul>
                            @foreach($item->releases as $release)
                                <li>{{ $release->os }} - v{{ $release->version }}</li>
                            @endforeach
                        </ul>
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
            @endforeach
        </tbody>
    </table>
</div>
@endsection
