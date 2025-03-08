@extends('layouts.backendapp')
@section('content')
    @php
        // Configure this page
        // $pageName = 'Municipality/Add';
        $pageName = $title . ' / ' . $district->district . ' / Add Municipality';

        $post_per_page = siteSettings('posts_per_page');

        $breadcrumbs = [
            ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
            ['title' => 'Municipality / add ', 'link' => '#', 'isActive' => 'active'],
        ];

        $start = isset($request->page) && !empty($request->page) ? $request->page * $post_per_page + 1 : 1;
        // dd($provinces->name);
    @endphp
    <div class="">
        {{-- <div class="h4 fw-bold">Province</div> --}}
        <div class="p-4 mx-auto bg-white rounded shadow-lg " style="width: 80%">
            
            <form method="post" action="{{ route('municipality.store', $district->id) }}" enctype="multipart/form-data">
                @csrf

                <div class="mt-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Municipality name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name here"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger small">
                                * {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="">
                        <label class="form-label fw-semibold">Add Ward Range</label>

                        <div class="gap-4 d-flex place-content-center">

                            <div class="mb-3">
                                <input type="number" class="form-control" name="ward_from" placeholder="Eg.1"
                                    value="1" disabled required>
                                @error('name')
                                    <div class="text-danger small">
                                        * {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="pt-2">
                                <label>to</label>
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control" name="ward_to" placeholder="Eg.31" value=""
                                    required>
                                @error('name')
                                    <div class="text-danger small">
                                        * {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>




                    <div>
                        <button type="submit" class="btn btn-dark">Add</button>
                        <a href="{{ route('municipality', $district->id) }}" class="bg-black border-0 btn btn-info sfw "><i
                            class="fa fa-back"></i> Back
                    </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
