<?php  $dash .='--- ';  ?>
@foreach($subcategories as $subcategory)
@php
$productcat_image_url = ($subcategory->image != '')?$subcategory->image : 'assets/images/no_photo.jpg';
@endphp
<tr> 
    <td>{{ ( $GLOBALS['counter']++ )  }}</td>
    <td><img src="{{asset($productcat_image_url) }}" alt="{{ $subcategory->title }}"></td>
    <td>{{$dash}} {{$subcategory->title}}</td>
    <td>{{ $subcategory->short_desc }}</td>  
    <td>{!! ($subcategory->status === 'active')? '<i class="fa fa-check"></i>':'<i class="fa fa-times"></i>' !!}</td>  
    <td><a href="{{ route('productcat.edit', $subcategory->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a>
    </td>
    <td>
        <form action="{{route('productcat.destroy', $subcategory->id)}}" method="POST" class="delete_confirm">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="DELETE">
        <button class="btn btn-danger sfw btn-sm"><i class="fa fa-trash-o"></i> </button>
        </form>
        </td>
        </tr>
    @if($subcategory->parent_id != 0)
        @include('admin.components.subcatrow',['subcategories' => $subcategory->subcategory, 'counter' => $GLOBALS['counter'] ])
    @endif
@endforeach