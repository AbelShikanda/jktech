@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Subscription</h2>
    @include('admin.layouts.partials.subscriptionForms', ['subscription' => $userSubscription, 'users' => $users, 'bundles' => $bundles])
</div>
@endsection
