@extends('admin.layouts.app')

@section('content')
@can('admin.services.manage', auth('admin')->user())
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
@else
<div class="container-fluid"><div class="alert alert-danger mt-3">You do not have permission to access this form.</div></div>
@endcan
@endsection
