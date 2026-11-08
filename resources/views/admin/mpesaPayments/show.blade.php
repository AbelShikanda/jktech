@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Payment Details</h2>
    <div class="mb-3">
        @if(auth('admin')->user()?->can('admin.payments.manage'))
        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-info">Edit</a>
        @endif
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Back</a>
    </div>
    <table class="table table-striped">
        <tr><th>User</th><td>{{ optional($payment->user)->first_name ?? optional($payment->user)->email ?? 'N/A' }}</td></tr>
        <tr><th>Bundle</th><td>{{ optional($payment->bundle)->name ?? 'N/A' }}</td></tr>
        <tr><th>Payment For</th><td>{{ $payment->payment_for ?? 'N/A' }}</td></tr>
        <tr><th>Amount</th><td>{{ number_format((float) ($payment->amount ?? 0), 2) }}</td></tr>
        <tr><th>Mpesa Receipt</th><td>{{ $payment->mpesa_receipt_number ?? 'N/A' }}</td></tr>
        <tr><th>Phone Number</th><td>{{ $payment->phone_number ?? 'N/A' }}</td></tr>
        <tr><th>Transaction Date</th><td>{{ optional($payment->transaction_date)->format('Y-m-d H:i:s') ?? $payment->transaction_date ?? 'N/A' }}</td></tr>
        <tr><th>Status</th><td>{{ $payment->status ?? 'N/A' }}</td></tr>
        <tr><th>Created At</th><td>{{ optional($payment->created_at)->format('Y-m-d H:i:s') ?? 'N/A' }}</td></tr>
    </table>
</div>
@endsection
