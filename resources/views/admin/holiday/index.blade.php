@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Holidays</h2>
    <a href="{{ route('holiday.create') }}" class="btn btn-primary mb-3">+ Add Holiday</a>

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
            @foreach($holiday as $holiday)
                <tr>
                    <td>{{ $holiday->date }}</td>
                    <td>{{ $holiday->reason }}</td>
                    <td>
                        <a href="{{ route('holiday.edit', $holiday->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('holiday.destroy', $holiday->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this holiday?')">
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
