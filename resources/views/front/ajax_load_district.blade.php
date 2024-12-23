<option value=''> Select District </option>
 @foreach($districts as $district)
    <option value="{{ $district->id }}" data-district="{{ $district->id }}">{{ $district->district }}</option>
@endforeach