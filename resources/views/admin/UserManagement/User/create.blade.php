@extends('layouts.backendapp')

@section('page_title', 'Admin - Banner')

@section('banner_select', 'bg-black text-white')

@section('content')
<section class="bg-white px-5 container py-4">
    <div class="text-3xl pb-6 font-bold">
        Add User Role
    </div>

    <form action="{{ route('userManagement.store') }}" method="POST">
        @csrf

        <!-- Role Selection -->
        <div class="mb-4">
            <div class="form-check form-check-inline">
                @foreach ($roles as $key => $role)
                    <input type="checkbox" id="Name{{ $key }}" name="role[]" class="form-check-input" value="{{ $role->name }}" />
                    <label for="Name{{ $key }}" class="form-check-label">
                        {{ $role->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Username -->
        <div class="mb-4">
            <label for="Name" class="form-label">Username</label>
            <input type="text" id="Name" name="name" class="form-control w-50" />
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control w-50" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control w-50" />
        </div>

        <!-- Password Confirmation -->
        <div class="mb-4">
            <label for="confirm_password" class="form-label">Password Confirmation</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control w-50" />
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-start pt-3">
            <button type="submit" class="btn btn-primary px-4 py-2">Submit</button>
        </div>
    </form>
</section>
@endsection
