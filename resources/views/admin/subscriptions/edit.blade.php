@extends('admin.layouts.app')

@section('content')
@can('admin.bookings.manage', auth('admin')->user())
<div class="container">
    <h2>Edit Subscription</h2>
    @include('admin.layouts.partials.subscriptionForms', ['subscription' => $userSubscription, 'users' => $users, 'bundles' => $bundles])
</div>
@else
<div class="container-fluid"><div class="alert alert-danger mt-3">You do not have permission to access this form.</div></div>
@endcan
@endsection
