@extends('layouts.backendapp')
@section('page_title', 'Admin - Banner')
@section('banner_select', 'bg-black text-white')
@section('content')
    <div class=" py-5  w-100 px-5">
        {{-- @include('admin.message.index') --}}

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 font-weight-bold">User Roles</h1>
            {{-- @can('Add Role') --}}
            <a href="{{ route('userRole.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="svgicon" height="1em" viewBox="0 0 448 512">
                    <style>
                        .svgicon {
                            fill: #ffffff;
                        }
                    </style>
                    <path
                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                </svg>
                <span>Add Role</span>
            </a>
            {{-- @endcan --}}
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">Name</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="text-center align-middle">{{ $role->name }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- @can("Edit Role") --}}
                                            <a href="{{ route('userRole.edit', $role->id) }}" class="btn btn-success">
                                                Edit
                                            </a>
                                            {{-- @endcan --}}

                                            {{-- @can("Delete Role") --}}
                                            <form id="deleteRoleForm{{ $role->id }}" method="POST"
                                                action="{{ route('userRole.destroy', $role->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            {{-- @endcan --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
