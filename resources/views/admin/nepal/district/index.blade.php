@extends('layouts.backendapp')

@section('content')

    @php
        // Configure this page
        $pageName = $title . ' Province / ' . ' District  ';
        $post_per_page = siteSettings('posts_per_page');

        $breadcrumbs = [
            ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
            [
                'title' => $title . ' / ' . ' District  ',
                'link' => '#',
                'isActive' => 'active',
            ],
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
                    <div class="mt-2 col-sm-6">
                        <a href="{{ route('district.create', $districts[0]->province) }}"
                            class="bg-black border-0 btn btn-info sfw btn-sm"><i class="fa fa-plus"></i> Add New
                        </a>
                        <a href="{{ route('province') }}" class="bg-black border-0 btn btn-info sfw btn-sm"><i
                                class="fa fa-back"></i> Back
                        </a>
                    </div>

                </div>
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Status </th>

                            <th> Action </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $GLOBALS['counter'] = $start; ?>
                        @if (count($districts) > 0)
                            @foreach ($districts as $key => $district)
                                <tr>
                                    <td>{{ $GLOBALS['counter']++ }}</td>
                                    <td>{{ $district->district }}</td>

                                    <td class=" text-sm bg-white " style="width: 10px">

                                        <form method="POST" action="{{ route('togleActivedistrict', $district->id) }}">
                                            @csrf
                                            <label class="inline-flex d-flex items-center cursor-pointer">
                                                <div class="form-check d-flex form-switch">
                                                    <div class="px-4">
                                                        <input class=" form-check-input bigger-toggle" type="checkbox"
                                                            role="switch" id="flexSwitchCheckChecked"
                                                            onchange="this.form.submit()"
                                                            {{ $district->is_active == '1' ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                                <div class="pt-3">
                                                    @if ($district->is_active == '1')
                                                        <div class="px-4 py-1 text-white rounded bg-success">
                                                            Active
                                                        </div>
                                                    @else
                                                        <div class="px-4 py-1 text-white rounded bg-danger">
                                                            InActive
                                                        </div>
                                                    @endif
                                                </div>
                                                <style>
                                                    .bigger-toggle {
                                                        width: 50px !important;
                                                        height: 25px !important;
                                                    }
                                                </style>


                                            </label>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('municipality', $district->id) }} "
                                            class="btn btn-success btn-sm">Municipalities </a>
                                        <a href="{{ route('district.edit', $district->id) }} "
                                            class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a>

                                        {{-- <form action="{{ route('district.delete', $district->id) }}" method="POST"
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



            </div>
        </div>
    </div>


@endsection
