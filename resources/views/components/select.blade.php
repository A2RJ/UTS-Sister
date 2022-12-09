 <div class="mb-3">
     <label class="form-label" for="{{ $name }}">{{ $label }}</label>
     <select class="form-select @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" aria-label="Pilih top level">
         <option value="">Pilih</option>
         @foreach ($select as $item)
         <option value="{{ $item['value'] }}" @if ($item["value"]===$current) selected @endif>{{ $item['text'] }}</option>
         @endforeach
     </select>
     @error($name)
     <div class="invalid-feedback">{{ $message }}</div>
     @enderror
 </div>