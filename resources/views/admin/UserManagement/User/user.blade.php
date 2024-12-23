@extends('layouts.backendapp')
@section('page_title', 'Admin - Banner')
@section('banner_select', 'bg-black text-white')
@section('content')
    <div class="px-5 bg-background w-full">

        <div class="d-flex justify-content-between">
            <div class="h2 font-weight-bold">User Management</div>

            {{-- @can('Add User') --}}
            <a href='{{ route('userManagement.create') }}'
                class='btn btn-primary d-flex align-items-center p-2'>
                <i class="ion-ios-add-circle-outline" style="font-size: 1.5em; margin-right: 8px;"></i>
                <span>Add User</span>
            </a>
            {{-- @endcan --}}
        </div>

        <div class="table-responsive bg-white p-3 rounded-lg mt-4 font-main shadow">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="p-2 font-weight-semibold">Name</th>
                        <th scope="col" class="font-weight-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $key => $users)
                        <tr class="text-center">
                            <td>{{ $users->name }}</td>
                            <td class="p-2">

                             
                                {{-- @can('Delete User') --}}
                                <form action="{{ route('userManagement.destroy', $users->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                {{-- @endcan --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
