@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Holiday</h2>

    <form action="{{ route('holiday.update', $holiday->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="date" class="form-label">Holiday Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $holiday->date }}" required>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <input type="text" name="reason" id="reason" class="form-control" value="{{ $holiday->reason }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Holiday</button>
    </form>
</div>
@endsection
