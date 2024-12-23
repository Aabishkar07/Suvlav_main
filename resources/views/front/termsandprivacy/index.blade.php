@extends('layouts.frontendapp')


@section('content')
<div class="mx-auto container px-10 bg-white my-5  ">
        <h4 class="text-xl sm:fw-md font-bold mb-4">{{ $pages->title }}</h4>

        <p class="mb-4">
          {!!$pages->content!!}
        </p>

</div>
@endsection


