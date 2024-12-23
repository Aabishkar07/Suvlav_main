@php $dash.='--- '; @endphp
@foreach($subcategories as $subcategory)
    <option value="{{$subcategory->id}}" @if($selectedId === $subcategory->id) {{ 'selected' }} @endif >{{$dash}}{{$subcategory->title}}</option>
    @if(count($subcategory->subcategory))
        @include('admin.components.subcatdrop',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach