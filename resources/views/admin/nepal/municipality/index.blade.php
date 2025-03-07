@extends('layouts.backendapp')

@section('content')

    @php
        // Configure this page
        $pageName = $title . ' / ' . $district->district . ' / Municipality';
        $post_per_page = siteSettings('posts_per_page');

        $breadcrumbs = [
            ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
            ['title' => 'Municipality', 'link' => '#', 'isActive' => 'active'],
        ];

        $start = isset($request->page) && !empty($request->page) ? $request->page * $post_per_page + 1 : 1;

    @endphp

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <div class="px-5 col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="row margin-bottom-30">
                    <div class="mt-2 mb-4 col-sm-6"> <a
                            href="
                        {{ route('municipality.create', $district->id) }}
                         "
                            class="bg-black border-0 btn btn-info sfw btn-sm"><i class="fa fa-plus"></i> Add New
                        </a>
                        <a href="{{ route('district.index', $district->province) }}"
                            class="bg-black border-0 btn btn-info sfw btn-sm"><i class="fa fa-back"></i> Back
                        </a>
                    </div>

                </div>
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Action </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $GLOBALS['counter'] = $start; ?>
                        @if (count($municipalities) > 0)
                            @foreach ($municipalities as $key => $municipality)
                                <tr>
                                    <td>{{ $GLOBALS['counter']++ }}</td>
                                    <td>{{ $municipality->name }}</td>


                                    <td>
                                        {{-- <a href="{{ route('district.index', $municipality->id) }} "
                                            class="btn btn-success btn-sm">Municipalities </a> --}}
                                        <a href="{{ route('municipality.edit', $municipality->id) }} "
                                            class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a>

                                        <form action="{{ route('municipality.delete', $municipality->id) }}" method="POST"
                                            class="delete_confirm ">
                                            @csrf
                                            @method('Delete')
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger sfw btn-sm "><i class="fa fa-trash-o "></i>
                                            </button>
                                        </form>
                                    </td>



                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">
                                    <p class="text-danger">No record found!</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>



            </div>
        </div>
    </div>


@endsection
