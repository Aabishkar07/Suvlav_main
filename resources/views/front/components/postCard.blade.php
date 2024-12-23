@php
$image_url = ($list->image != '')?$list->image : 'assets/images/no_photo.jpg';
@endphp
<div class="col-lg-4 col-md-6 col-12">
	<!-- Start Single Blog  -->
	<div class="shop-single-blog">
	<a href="/post/{{ $list->slug }}">
		<img src="{{asset($image_url) }}" alt="{{ $list->title }}">
	</a>
	<div class="content">
			<p class="date">{{ ($list->created_at) }}</p>
			<a href="/post/{{ $list->slug }}" class="title">{{ $list->title }}</a>
			<a href="/post/{{ $list->slug }}" class="more-btn">Continue Reading</a>
		</div>
	</div>
	<!-- End Single Blog  -->
</div>