@php
//echo '<pre>';
//echo $list->title; 
///print_r($list); 
$productcat_image_url = ($list->image != '')?$list->image : 'assets/images/no_photo.jpg';
@endphp
<div class="col-xl-2 col-lg-2 col-md-2 col-6">
	<div class="single-list">	
		<div class="list-image"> <a href="/category/{{ $list->slug }}">
		<img src="{{asset('public/' . $productcat_image_url) }}" alt="{{ $list->title }}"> </a>
			<div class="content">
				<h4 class="title"><a href="/category/{{ $list->slug }}">{{ $list->title }}</a></h4>
			</div>

		</div>
	</div>
</div>

