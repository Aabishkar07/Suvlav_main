@extends('layouts.backendapp')
@section('page_title', 'Admin - Banner')
@section('banner_select', 'bg-black text-white')
@section('content')
    <div class="mx-32    mt-10  rounded-lg">
        <form id="myForm" action="{{ route('userRole.store') }}" method="POST">
            @csrf

            <div class=" gap-4 my-4">
                <p class="pb-4 font-bold text-2xl">Add Role</p>
            </div>


            <label>Role</label>
            <input type="text" name="name"
                class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-4 placeholder-slate-400 shadow-sm placeholder:font-semibold placeholder:text-gray-500 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
                placeholder="Type user role" />

            <div class="pt-5 pb-5">
                <label for="permission" class="block text-sm font-medium text-gray-700 pb-5">
                    Permission
                </label>
                <div class="grid grid-cols-4 gap-x-5 gap-y-5">
                    @php
                        $previousParent = null;
                    @endphp

                    @foreach ($permission as $key => $permissions)
                        @if ($permissions->parent !== $previousParent)
                            @if (!is_null($previousParent))
                </div> {{-- Close previous shadow box --}}
                @endif
                <div class="shadow-md w-full h-full  ">
                    <div class="pb-4 px-4 pt-5">
                        {{ $permissions->parent }}
                    </div>
                    <div class="flex items-center mb-4 px-4">
                        <input id="default-checkbox-{{ $key }}" type="checkbox" value="{{ $permissions->name }}"
                            name="permission[]"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="permission-{{ $key }}"
                            class="ml-2 text-sm font-medium">{{ $permissions->name }}</label>
                    </div>
                    @php
                        $previousParent = $permissions->parent;
                    @endphp
                @else
                    <div class="flex items-center mb-4 px-4">
                        <input id="permission-{{ $key }}" type="checkbox" value="{{ $permissions->name }}"
                            name="permission[]"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="permission-{{ $key }}"
                            class="ml-2 text-sm font-medium">{{ $permissions->name }}</label>
                    </div>
                    @endif

                    @if ($loop->last)
                </div>
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
