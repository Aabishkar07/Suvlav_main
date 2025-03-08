@extends('layouts.backendapp')
@section('content')
    @php
        // Configure this page
        $pageName = $provinces->name . ' Province / Add District';
        $post_per_page = siteSettings('posts_per_page');

        $breadcrumbs = [
            ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
            ['title' => 'District / add ', 'link' => '#', 'isActive' => 'active'],
        ];

        $start = isset($request->page) && !empty($request->page) ? $request->page * $post_per_page + 1 : 1;
        // dd($provinces->name);
    @endphp
    <div class="">
        {{-- <div class="h4 fw-bold">Province</div> --}}
        <div class="p-4 mx-auto bg-white rounded shadow-lg " style="width: 80%">

            <form method="post" action="{{ route('district.store', $provinces->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mt-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">District name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name here"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger small">
                                * {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="btn btn-dark">Add</button>

                        <a href="{{ route('district.index', $provinces->id) }}" class="bg-black border-0 btn btn-info ">
                            Back
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
