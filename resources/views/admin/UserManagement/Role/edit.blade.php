@extends('layouts.backendapp')
@section('page_title', 'Admin - Banner')
@section('banner_select', 'bg-black text-white')
@section('content')
<div class="mx-32    mt-10  rounded-lg ">
    <form id="myForm" action="{{ route('userRole.update', $role->id) }}" method="POST">
        @csrf
     
        @method('PUT')

        <div class=" gap-4 my-4">
            <p class="pb-4 font-bold text-2xl">Edit Role</p>
        </div>
        {{-- <label>Date</label>
<input type="date" name="date"
class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-4 placeholder-slate-400 shadow-sm placeholder:font-semibold placeholder:text-gray-500 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
placeholder="Select a date" /> --}}

        <label>Role</label>
        <input type="text" name="name"
            class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-4 placeholder-slate-400 shadow-sm placeholder:font-semibold placeholder:text-gray-500 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
            placeholder="Type user role" value="{{ old('name', $role->name) }}" />

            <div class="pt-5 pb-5">
                <label
                for="permission"
                class="block text-sm font-medium text-gray-700 pb-5"
              >
              Permission
              </label>
              <div class="grid grid-cols-4">
                @php
                    $displayedParents = [];
                @endphp
                {{-- @foreach ($permissions as $permission)
                    @if (!in_array($permission->parent, $displayedParents))
                        <div class="pb-2 mt-2">
                            <input type="checkbox" name="permissions[]" id="{{ $permission->parent }}"
                                value="{{ $permission->parent }}">
                            <label class="font-semibold mb-2" id="{{ $permission->parent }}">
                                {{ $permission->parent }}
                            </label>
                            <ul>
                                @foreach ($permissions->where('parent', $permission->parent) as $childPermission)
                                    <li class="ml-3">
                                        <input type="checkbox" name="permissions[]"
                                            value="{{ $childPermission->permission_name }}"
                                            {{ $role->getPermissionNames() && $role->hasPermissionTo($childPermission->permission_name) ? 'checked' : '' }}>
                                        {{ $childPermission->permission_name }}
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        @php
                            $displayedParents[] = $permission->parent;
                        @endphp
                    @endif
                @endforeach --}}

                @foreach ($permissions as $permission)
    @if (!in_array($permission->parent, $displayedParents))
        <div class="pb-2 mt-2">
            <input type="checkbox" name="permissions[]" id="{{ $permission->parent }}"
                   value="{{ $permission->parent }}"
                   {{ in_array($permission->parent, old('permissions', $role->permissions->pluck('name')->toArray())) ? 'checked' : '' }}>
            <label class="font-semibold mb-2" id="{{ $permission->parent }}">
                {{ $permission->parent }}
            </label>
            <ul>
                @foreach ($permissions->where('parent', $permission->parent) as $childPermission)
                    <li class="ml-3">
                        <input type="checkbox" name="permissions[]"
                               value="{{ $childPermission->permission_name }}"
                               {{ in_array($childPermission->permission_name, old('permissions', $role->permissions->pluck('name')->toArray())) ? 'checked' : '' }}>
                        {{ $childPermission->permission_name }}
                    </li>
                @endforeach
            </ul>
        </div>
        @php
            $displayedParents[] = $permission->parent;
        @endphp
    @endif
@endforeach

            </div>
            <div class="text-right pt-6">
                <button type="submit"
                    class="cursor-pointer rounded-lg p-5 bg-blue-700 py-2 text-sm font-semibold text-white">Add</button>
            </div>
        </div>
    </form>
</div>
@endsection

<script src="https://cdn.tailwindcss.com"></script>
