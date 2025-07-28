@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Create New Subscription</h2>
    @include('admin.layouts.partials.subscriptionForms', ['subscription' => null, 'users' => $users, 'bundles' => $bundles])
</div>
@endsection
