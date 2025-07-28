@php
    $isEdit = isset($bundle);
@endphp

<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $bundle->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control">{{ old('description', $bundle->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Price (KES)</label>
    <input type="number" name="price" class="form-control" step="0.01" value="{{ old('price', $bundle->price ?? '') }}" required>
</div>

<div class="row mb-3">
    <div class="col">
        <label>Duration</label>
        <input type="number" name="duration" class="form-control" value="{{ old('duration', $bundle->duration ?? 1) }}" required>
    </div>
    <div class="col">
        <label>Unit</label>
        <select name="duration_unit" class="form-control" required>
            @foreach(['day', 'week', 'month', 'year'] as $unit)
            <option value="{{ $unit }}" {{ old('duration_unit', $bundle->duration_unit ?? '') === $unit ? 'selected' : '' }}>
                    {{ ucfirst($unit) }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="mb-3">
    <label>Trial Days</label>
    <input type="number" name="trial_days" class="form-control" value="{{ old('trial_days', $bundle->trial_days ?? 0) }}">
</div>

<div class="mb-3">
    <label>Type</label>
    <input type="text" name="type" class="form-control" value="{{ old('type', $bundle->type ?? '') }}">
</div>

<div class="mb-3">
    <label>Features (comma-separated)</label>
    <input type="text" name="features" class="form-control"
        value="{{ old('features', isset($bundle) ? implode(',', $bundle->features ?? []) : '') }}">
    <small class="text-muted">Separate each feature with a comma (e.g. "Unlimited Ads, Class Access")</small>
</div>

<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
        {{ old('is_active', $bundle->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Active</label>
</div>

<div class="form-check mb-4">
    <input class="form-check-input" type="checkbox" name="is_recurring" value="1" id="is_recurring"
        {{ old('is_recurring', $bundle->is_recurring ?? false) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_recurring">Recurring</label>
</div>

<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
