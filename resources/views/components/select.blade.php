<!-- Styles select2 -->
<!-- <link rel="stylesheet" href="{{ asset('/dist/select2/css/bootstrap.min.css') }}" /> -->
<link rel="stylesheet" href="{{ asset('/dist/select2/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/dist/select2/css/select2-bootstrap-5-theme.min.css') }}" />

<div class="mb-3">
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    <select class="form-select @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" aria-label="Pilih top level" {{ isset($required) && $required == true ? 'required' : '' }}>
        <option value="">Pilih</option>
        @foreach ($select as $item)
        <option value="{{ $item['value'] }}" {{ $current == $item['value'] ? 'selected' : ''}} class="text-capitalize">{{ $item['text'] }}</option>
        @endforeach
    </select>
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Scripts select2 -->
<script src="{{ asset('/dist/select2/js/jquery.slim.min.js') }}"></script>
<script src="{{ asset('/dist/select2/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/dist/select2/js/select2.min.js') }}"></script>

<script>
    $('#{{ $name }}').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });
</script>