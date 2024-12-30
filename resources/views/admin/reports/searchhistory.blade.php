@extends('layouts.backendapp')

@section('content')
    {{-- @dd($searchhistorys) --}}
    @php
        // Configure this page
        $pageName = 'Search History';
        $showChildFormat = 'yes';
        $post_per_page = siteSettings('posts_per_page');
        $site_currency = siteSettings('site_currency');

        $breadcrumbs = [
            ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
            ['title' => 'Report', 'link' => '#', 'isActive' => ''],
            ['title' => 'Search History', 'link' => '#', 'isActive' => 'active'],
        ];

        $start = isset($request->page) && !empty($request->page) ? ($request->page - 1) * $post_per_page + 1 : 1;

    @endphp
    <div class="px-4">
        <div class="">
            <div style="width:210px;" class="">


            </div>
        </div>
        {{-- @dd($customers) --}}

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Search Item / Searched For</th>
                    <th scope="col">Name</th>
                    <th scope="col">Contact number</th>

                    <th scope="col">Email</th>
                    <th scope="col">District</th>
                  
                    <th scope="col">Search Date</th>
                </tr>
            </thead>
            <tbody>
                <div class="py-4">
                    <span style="font-size: 22px;color: blue">Search History : </span>
                </div>
                @foreach ($searchhistorys as $key => $customer)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $customer->search_item }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phonenumber }}</td>

                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->district }}</td>

                        {{-- <td>{{ $customer->state }}</td>
                        <td>{{ $customer->district }}</td>
                        <td>{{ $customer->gaupalika}}</td> --}}
                        <td>{{ $customer->created_at ? \Carbon\Carbon::parse($customer->created_at)->format('Y-m-d') : 'N/A' }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        @if (count($searchhistorys) > 0)
            <div class="row ">
                <div class="card">
                    <div class="">
                        {{ $searchhistorys->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection