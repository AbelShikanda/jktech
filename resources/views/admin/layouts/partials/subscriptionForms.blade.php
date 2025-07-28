@php
    $isEdit = isset($subscription);
@endphp

<form action="{{ $isEdit ? route('user-bundles.update', $subscription->id) : route('user-bundles.store') }}"
    method="POST">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="user_id" class="form-label">User</label>
        <select name="user_id" id="user_id" class="form-control" required>
            <option value="">-- Select User --</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}"
                    {{ old('user_id', $subscription->user_id ?? '') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }} ({{ $user->email }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="bundle_id" class="form-label">Bundle</label>
        <select name="bundle_id" id="bundle_id" class="form-control" required>
            <option value="">-- Select Bundle --</option>
            @foreach ($bundles as $bundle)
                <option value="{{ $bundle->id }}"
                    {{ old('bundle_id', $subscription->bundle_id ?? '') == $bundle->id ? 'selected' : '' }}>
                    {{ $bundle->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" name="start_date" class="form-control" id="start_date"
            value="{{ old('start_date', optional($subscription)->start_date?->format('Y-m-d')) }}" required>
    </div>

    <div class="mb-3">
        <label for="end_date" class="form-label">End Date</label>
        <input type="date" name="end_date" class="form-control" id="end_date"
            value="{{ old('end_date', optional($subscription)->end_date?->format('Y-m-d')) }}" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-control" required>
            @foreach (['active', 'expired', 'cancelled'] as $status)
                <option value="{{ $status }}"
                    {{ old('status', $subscription->status ?? '') == $status ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Update' : 'Create' }} Subscription</button>
</form>
