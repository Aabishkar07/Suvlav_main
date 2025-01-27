@extends('layouts.backendapp')

@section('content')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <div class="px-5 col-lg-12 grid-margin stretch-card">



        @php
            // Configure this page
            $pageName = 'Members';
            $showChildFormat = 'yes';
            $post_per_page = siteSettings('posts_per_page');

            $breadcrumbs = [
                ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
                ['title' => 'members', 'link' => '#', 'isActive' => 'active'],
            ];

            $start = isset($request->page) && !empty($request->page) ? ($request->page - 1) * $post_per_page + 1 : 1;

        @endphp


        <div class=" col-lg-12 grid-margin stretch-card">

            <div class="card">
                <div class="">

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                
                    <div class="row margin-bottom-30">
                        <form method="get" class="forms-sample deceased-search">
                            <input type="hidden" name="search" value="search">
                            <div class="form-group row">
                                {{-- <div class="col-sm-6"> <a href="{{ route('member.create') }}" class="btn btn-info sfw btn-sm"><i
                                        class="fa fa-plus"></i> Add New </a> </div> --}}
                                <div class="col-sm-3">
                                    <input type="text" name= "title" class="form-control" id="searchName"
                                        value="{{ $request->title }}" placeholder="Search...">
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-info sfw btn-sm btn_search" type="submit"><i
                                            class="fa fa-search"></i> Search</button>
                                    <a href="{{ route('member.index') }}" class="btn btn-info sfw btn-sm"><i
                                            class="fa fa-mail-reply"></i> Reset </a>
                                </div>
                            </div>

                        </form>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th> SN </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Phone </th>
                                <th> Address </th>
                                <th> Gender </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $GLOBALS['counter'] = $start; ?>

                            @php
                                $total = $members->total(); // Total records across all pages
                                // Calculate the starting number for the current page
                                $start = $total - ($members->currentPage() - 1) * $members->perPage();
                            @endphp

                            @if (count($members) > 0)
                                @foreach ($members as $key => $member)
                                    <tr>
                                        <td>{{ $start-- }}</td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td> {{ $member->mobileno }}</td>
                                        <td> {{ $member->address }}</td>
                                        @if ($member->membertype != 'admin')
                                            <td>{{ $member->gender }}</td>
                                            <td>
                                                @if ($member->share_status == 'verified')
                                                    <div style="background-color: green;padding:5px;color:white;border-radius: 5px"
                                                        class="">

                                                        VERIFIED
                                                    </div>
                                                @else
                                                    <span
                                                        style="background-color: red;padding:5px;color:white;border-radius: 5px">REJECTED</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div data-toggle="modal" data-target="#exampleModal{{ $key }}"
                                                    class="btn btn-success btn-sm"><i class="fa fa-eye"></i> </div>

                                                <div class="modal fade" id="exampleModal{{ $key }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Change Share
                                                                    Status
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">



                                                                <form
                                                                    action="{{ route('admin.sharestatus.update', $member->id) }}"
                                                                    method="POST" enctype="multipart/form-data"
                                                                    class="forms-sample">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="px-5">
                                                                        <div class="">
                                                                            <div class="">
                                                                                <div class="form-group row">
                                                                                    <label for="statusInput"
                                                                                        class="col-sm-3 col-form-label">Share
                                                                                        Status</label>
                                                                                    <div class="col-sm-9">
                                                                                        <select class="form-select"
                                                                                            name="status" id="statusInput">
                                                                                            <option
                                                                                                @if ($member->share_status == 'verified') {{ 'selected' }} @endif
                                                                                                value="verified">
                                                                                                VERIFIED
                                                                                            </option>
                                                                                            <option
                                                                                                @if ($member->share_status == '' || $member->share_status == 'reject') {{ 'selected' }} @endif
                                                                                                value="reject">
                                                                                                REJECTED
                                                                                            </option>
                                                                                        </select>
                                                                                        @error('status')
                                                                                            <span> {{ $message }} </span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-info sfw">Update</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <a href="{{ route('member.edit', $member->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a> --}}
                                                <form action="{{ route('member.destroy', $member->id) }}" method="Post"
                                                    class="delete_confirm">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger sfw btn-sm"><i class="fa fa-trash-o"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        @else
                                            <td colspan="2"> </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">
                                        <p class="text-danger">No record found!</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="row margin-top-30">
                        <div class="card">
                            <div class="card-body">
                                {{ $members->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    @endsection
