@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>{{ $software->name }}</h2>
    <p>{{ $software->description }}</p>

    @if($software->image)
        <img src="{{ asset('storage/' . $software->image) }}" class="img-fluid mb-3" style="max-width: 300px;">
    @endif

    <h4>Releases</h4>
    <ul>
        @foreach($software->releases as $release)
            <li>
                <strong>{{ ucfirst($release->os) }}:</strong>
                Version {{ $release->version }},
                <a href="{{ $release->download_url }}" target="_blank">Download</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
