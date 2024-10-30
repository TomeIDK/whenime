@extends('layouts.base')

@section('title', 'Reset Password')

@section('content')
    <div class="hero bg-white min-h-screen">
        <div class="hero-content flex-col gap-4">
            <div class="flex flex-col gap-2 max-w-lg">
                <h1 class="text-4xl font-bold">Reset your password</h1>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="flex flex-col gap-4 items-center w-full">
                @csrf
                <div class="max-w-lg w-full">
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email -->
                    <div class="label">
                        <span class="label-text">Email</span>
                    </div>
                    <label class="input input-bordered flex items-center gap-2">
                        <input type="text" name="email" class="grow border-none focus:ring-transparent"
                            placeholder="Email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="email" />
                    </label>
                    @error('email')
                        <span class="text-red-500 mt-2 label-text-alt">{{ $message }}</span>
                    @enderror

                    <!-- New password -->
                    <div class="label">
                        <span class="label-text">New password</span>
                    </div>
                    <label class="input input-bordered flex items-center gap-2">
                        <input type="password" name="password" class="grow border-none focus:ring-transparent"
                            placeholder="New password" required />
                    </label>
                    @error('password')
                        <span class="text-red-500 mt-2 label-text-alt">{{ $message }}</span>
                    @enderror

                    <!-- Confirm new password -->
                    <div class="label">
                        <span class="label-text">Confirm new password</span>
                    </div>
                    <label class="input input-bordered flex items-center gap-2">
                        <input type="password" name="password_confirmation" class="grow border-none focus:ring-transparent"
                            placeholder="Confirm new password" required />
                    </label>
                    @error('password_confirmation')
                        <span class="text-red-500 mt-2 label-text-alt">{{ $message }}</span>
                    @enderror
                </div>

                <x-cta-button text="Reset Password" class="w-full" />

            </form>
        </div>
    </div>
@endsection
