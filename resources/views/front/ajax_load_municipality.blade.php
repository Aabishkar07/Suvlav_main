<option value=''> Select Municipality </option>
@foreach ($municipalities as $municipality)
    <option value="{{ $municipality->id }}" data-municipality="{{ $municipality->id }}">{{ $municipality->name }}</option>
@endforeach
