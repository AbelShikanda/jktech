@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>M-Pesa Transactions</h2>
    @if(auth('admin')->user()?->can('admin.payments.view'))
    <a href="{{ route('payments.create') }}" class="btn btn-primary mb-3">+ Add Payment</a>
    <a href="{{ route('payments.export') }}" class="btn btn-success mb-3">Export to Excel</a>
    @endif


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Payment For</th>
                <th>Amount</th>
                <th>Receipt</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse(($payments ?? collect()) as $payment)
                <tr>
                    <td>{{ $payment->payment_for ?? 'N/A' }}</td>
                    <td>{{ number_format((float) ($payment->amount ?? 0), 2) }}</td>
                    <td>{{ $payment->mpesa_receipt_number ?? $payment->checkout_request_id ?? 'N/A' }}</td>
                    <td><span class="badge bg-{{ in_array($payment->status, ['Success','Completed']) ? 'success' : ($payment->status === 'Failed' ? 'danger' : 'secondary') }}">{{ $payment->status ?? 'N/A' }}</span></td>
                    <td>
                        <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-sm btn-secondary">View</a>
                        @if(auth('admin')->user()?->can('admin.payments.view'))
                        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-muted text-center">No M-Pesa payments found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
