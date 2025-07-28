@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($software) ? 'Edit Software' : 'Add Software' }}</h2>
    <form action="{{ isset($software) ? route('software.update', $software->id) : route('software.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($software)) @method('PUT') @endif

        @include('admin.layouts.partials.downloadsForm')

        <button type="submit" class="btn btn-primary">{{ isset($software) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection
