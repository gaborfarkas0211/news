<div class="col">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select name="{{ $name }}[]" id="{{ $name }}" class="form-control" multiple>
        @foreach($translatedOptions as $option => $translated)
            <option value="{{ $option }}" @if(in_array($option, $selected)) selected @endif>{{ $translated }}</option>
        @endforeach
    </select>
</div>
