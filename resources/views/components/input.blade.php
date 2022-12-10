<div class="mb-3">
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    <input class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" placeholder="{{ $placeholder }}" value="{{ $value ? $value : old($name) }}" required />
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>