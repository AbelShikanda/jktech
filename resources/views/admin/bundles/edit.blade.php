@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Bundle: {{ $bundle->name }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bundles.update', $bundle->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.layouts.partials.form', ['buttonText' => 'Update', 'bundle' => $bundle])

    </form>
</div>
@endsection
