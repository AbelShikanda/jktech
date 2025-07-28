<form method="POST" action="{{ isset($payment) ? route('payments.update', $payment->id) : route('payments.store') }}">
    @csrf
    @if(isset($payment))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>User</label>
        <select name="user_id" class="form-control">
            <option value="">-- Select User --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ (isset($payment) && $payment->user_id == $user->id) ? 'selected' : '' }}>
                    {{ $user->first_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Bundle</label>
        <select name="bundle_id" class="form-control">
            <option value="">-- Select Bundle --</option>
            @foreach($bundles as $bundle)
                <option value="{{ $bundle->id }}" {{ (isset($payment) && $payment->bundle_id == $bundle->id) ? 'selected' : '' }}>
                    {{ $bundle->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Payment For</label>
        <input type="text" name="payment_for" class="form-control" value="{{ old('payment_for', $payment->payment_for ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Amount</label>
        <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $payment->amount ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Mpesa Receipt Number</label>
        <input type="text" name="mpesa_receipt_number" class="form-control" value="{{ old('mpesa_receipt_number', $payment->mpesa_receipt_number ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="Pending" {{ (isset($payment) && $payment->status == 'Pending') ? 'selected' : '' }}>Pending</option>
            <option value="Success" {{ (isset($payment) && $payment->status == 'Success') ? 'selected' : '' }}>Success</option>
            <option value="Failed" {{ (isset($payment) && $payment->status == 'Failed') ? 'selected' : '' }}>Failed</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Transaction Date</label>
        <input type="datetime-local" name="transaction_date" class="form-control" value="{{ old('transaction_date', isset($payment) ? \Carbon\Carbon::parse($payment->transaction_date)->format('Y-m-d\TH:i') : '') }}">
    </div>

    <div class="mb-3">
        <label>Phone Number</label>
        <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $payment->phone_number ?? '') }}">
    </div>

    <button type="submit" class="btn btn-success">{{ isset($payment) ? 'Update' : 'Save' }}</button>
</form>
