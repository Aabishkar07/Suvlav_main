@extends('layouts.backendapp')
@section('content')
    @php

        $pageName = $provinces->name . ' Province / Edit District';

        $post_per_page = siteSettings('posts_per_page');

        $breadcrumbs = [
            ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
            ['title' => 'Municipality / Create ', 'link' => '#', 'isActive' => 'active'],
        ];

        $start = isset($request->page) && !empty($request->page) ? $request->page * $post_per_page + 1 : 1;
        // dd($provinces->name);
    @endphp
    <div class="">
        {{-- <div class="h4 fw-bold">Province</div> --}}
        <div class="p-4 mx-auto bg-white rounded shadow-lg " style="width: 80%">

            <form method="post" action="{{ route('district.update', $district->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mt-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">District name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name here"
                            value="{{ old('name', $district->district) }}" required>
                        @error('name')
                            <div class="text-danger small">
                                * {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="btn btn-dark">Update</button>
                        <a href="{{ route('district.index', $district->province) }}"
                            class="bg-black border-0 btn btn-info sfw "><i class="fa fa-back"></i> Back
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
