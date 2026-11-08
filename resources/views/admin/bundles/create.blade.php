@extends('admin.layouts.app')

@section('content')
@can('admin.services.manage', auth('admin')->user())
<div class="container">
    <h2>Create Bundle</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bundles.store') }}" method="POST">
        @csrf

        @include('admin.layouts.partials.form', ['buttonText' => 'Create'])

    </form>
</div>
@else
<div class="container-fluid"><div class="alert alert-danger mt-3">You do not have permission to access this form.</div></div>
@endcan
@endsection
