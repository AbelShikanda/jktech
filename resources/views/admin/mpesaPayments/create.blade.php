@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Add M-Pesa Payment</h2>
    @include('admin.layouts.partials.mpesaPaymentForms', ['users' => $users, 'bundles' => $bundles, 'bookings' => $bookings])
</div>
@endsection
