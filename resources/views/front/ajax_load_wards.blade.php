<option value=''> Select Wards </option>
@foreach ($wards as $ward)
    <option value="{{ $ward->id }}" data-ward="{{ $ward->id }}">{{ $ward->number }}</option>
@endforeach
