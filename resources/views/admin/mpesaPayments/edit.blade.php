@extends('admin.layouts.app')

@section('content')
@can('admin.bookings.manage', auth('admin')->user())
<div class="container">
    <h2>Edit M-Pesa Payment</h2>
    @include('admin.layouts.partials.mpesaPaymentForms', ['payment' => $payment, 'users' => $users, 'bundles' => $bundles, 'bookings' => $bookings])
</div>
@else
<div class="container-fluid"><div class="alert alert-danger mt-3">You do not have permission to access this form.</div></div>
@endcan
@endsection
