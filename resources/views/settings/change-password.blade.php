@extends('layouts.base')

@section('title', 'Change Password')

@section('content')
    <div class="my-12">
        <h1 class="mb-8 text-6xl font-bold text-center">Change Password</h1>

        <form action="{{ route('settings.change-password.change') }}" method="POST" class="flex flex-col items-center gap-4">
            @csrf
            @method('PATCH')

            <div class="md:w-1/4">
                <div class="label">
                    <span class="label-text">Current Password</span>
                </div>
                <label class="flex items-center gap-2 input input-bordered">
                    <input type="password" name="current_password" id="current_password"
                        class="border-none grow focus:ring-transparent" placeholder="Current Password" required autofocus />
                </label>
                @error('current_password')
                    <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                @enderror
            </div>

            <div class="md:w-1/4">
                <div class="label">
                    <span class="label-text">New Password</span>
                </div>
                <label class="flex items-center gap-2 input input-bordered">
                    <input type="password" name="password" id="password" class="border-none grow focus:ring-transparent"
                        placeholder="New Password" required />
                </label>
                @error('password')
                    <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                @enderror
            </div>

            <div class="md:w-1/4">
                <div class="label">
                    <span class="label-text">Confirm New Password</span>
                </div>
                <label class="flex items-center gap-2 input input-bordered">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="border-none grow focus:ring-transparent" placeholder="Confirm New Password" required />
                </label>
                @error('password_confirmation')
                    <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="text-white border-none outline-none btn bg-primary hover:bg-primary-hover-dark">Change
                Password</button>
        </form>
    </div>

@endsection
