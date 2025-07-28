@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Add Holiday</h2>

    <form action="{{ route('holiday.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="date" class="form-label">Holiday Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <input type="text" name="reason" id="reason" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Add Holiday</button>
    </form>
</div>
@endsection
