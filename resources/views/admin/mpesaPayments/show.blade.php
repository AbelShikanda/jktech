@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Payment Details</h2>
    <table class="table table-striped">
        <tr><th>User</th><td>{{ $payment->user->first_name ?? 'N/A' }}</td></tr>
        <tr><th>Bundle</th><td>{{ $payment->bundle->name ?? 'N/A' }}</td></tr>
        <tr><th>Payment For</th><td>{{ $payment->payment_for }}</td></tr>
        <tr><th>Amount</th><td>{{ $payment->amount }}</td></tr>
        <tr><th>Mpesa Receipt</th><td>{{ $payment->mpesa_receipt_number }}</td></tr>
        <tr><th>Phone Number</th><td>{{ $payment->phone_number }}</td></tr>
        <tr><th>Transaction Date</th><td>{{ $payment->transaction_date }}</td></tr>
        <tr><th>Status</th><td>{{ $payment->status }}</td></tr>
        <tr><th>Created At</th><td>{{ $payment->created_at }}</td></tr>
    </table>
    <a href="{{ route('payments.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
