@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit M-Pesa Payment</h2>
    @include('admin.layouts.partials.mpesaPaymentForms', ['payment' => $payment, 'users' => $users, 'bundles' => $bundles, 'bookings' => $bookings])
</div>
@endsection
