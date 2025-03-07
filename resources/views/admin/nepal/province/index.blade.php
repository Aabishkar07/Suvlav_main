@extends('layouts.backendapp')

@section('content')

    @php
        // Configure this page
        $pageName = 'Province';
        $post_per_page = siteSettings('posts_per_page');

        $breadcrumbs = [
            ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
            ['title' => 'Province', 'link' => '#', 'isActive' => 'active'],
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

                <div class="mb-4 row margin-bottom-30">
                    <div class="mt-2 col-sm-6"> <a href="{{ route('province.create') }}"
                            class="bg-black border-0 btn btn-info sfw btn-sm"><i class="fa fa-plus"></i> Add New
                        </a>
                    </div>
                    {{-- <form method="get" class="forms-sample deceased-search">
                        <input type="hidden" name="search" value="search">
                        <div class="form-group row">

                           
                             
                        
                            <div class="col-sm-3">
                                <input type="text" name= "title" class="form-control " id="searchName"
                                    value="{{ $request->title }}" placeholder="Search...">
                            </div>
                            <div class="mt-2 col-sm-3">
                                <button class="bg-black border-0 btn btn-info sfw btn-sm btn_search" type="submit"><i
                                        class="fa fa-search"></i> Search</button>
                                <a href="{{ route('banner.index') }}" class="bg-black border-0 btn btn-info sfw btn-sm"><i
                                        class="fa fa-mail-reply"></i> Reset </a>
                            </div>
                        </div>

                    </form> --}}
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
                        @if (count($provinces) > 0)
                            @foreach ($provinces as $key => $province)
                                <tr>
                                    <td>{{ $GLOBALS['counter']++ }}</td>
                                    <td>{{ $province->name }}</td>


                                    <td>
                                        <a href="{{ route('district.index', $province->id) }} "
                                            class="btn btn-success btn-sm">District </a>
                                        <a href="{{ route('province.edit', $province->id) }} "
                                            class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a>

                                        {{-- <form action="{{ route('province.delete', $province->id) }}" method="POST"
                                            class="delete_confirm ">
                                            @csrf
                                            @method('Delete')
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger sfw btn-sm "><i class="fa fa-trash-o "></i>
                                            </button>
                                        </form> --}}
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

                <div class="row margin-top-30">
                    <div class="card">
                        <div class="card-body">
                            {{-- {{ $provinces->appends(request()->query())->links() }} --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
