@php $dash.='---&nbsp; &nbsp;&nbsp; &nbsp;';
if($product_cat_selected == ''){
    $product_cat_selected = [];
}
@endphp
@foreach($subcategories as $subcategory)
    <div class="form-check">
            <label class="form-check-label">
            {!!$dash !!}<input type="checkbox" @if(in_array($subcategory->id, $product_cat_selected)){{ 'checked'}} @endif  name="prod_cats[]" value="{{$subcategory->id}}" class="form-check-input">{{$subcategory->title}}</label>
    </div>
    @if(count($subcategory->subcategory))
        @include('admin.components.subcatcheckbox',['subcategories' => $subcategory->subcategory,  'product_cat_selected' => $product_cat_selected ])
    @endif
@endforeach