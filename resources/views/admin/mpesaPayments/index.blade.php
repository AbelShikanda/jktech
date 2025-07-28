@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>M-Pesa Transactions</h2>
    <a href="{{ route('payments.create') }}" class="btn btn-primary mb-3">+ Add Payment</a>
    <a href="{{ route('payments.export') }}" class="btn btn-success mb-3">Export to Excel</a>


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
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->payment_for }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->mpesa_receipt_number }}</td>
                    <td><span class="badge bg-{{ $payment->status === 'Success' ? 'success' : ($payment->status === 'Failed' ? 'danger' : 'secondary') }}">{{ $payment->status }}</span></td>
                    <td>
                        <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-sm btn-secondary">View</a>
                        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
