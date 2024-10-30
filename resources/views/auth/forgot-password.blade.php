@extends('layouts.base')

@section('title', 'Forgot Password')

@section('content')
    <div class="hero bg-white min-h-screen">
        <div class="hero-content flex-col gap-4">
            <div class="flex flex-col gap-2 max-w-lg">
                <h1 class="text-4xl font-bold">Reset your password</h1>
            </div>


            <span class="mb-4 underline">{{ session('status') }}</span>

            <!-- Email -->
            <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-4 items-center w-full">
                @csrf
                <div class="max-w-lg">
                    <div class="label">
                        <p class="mb-4 text-sm text-text label-text">
                            Forgot your password? No problem. Just let us know your email address and we will email you a
                            password
                            reset
                            link
                            that will allow you to choose a new one.
                        </p>
                    </div>

                    <label class="input input-bordered flex items-center gap-2">
                        <input type="text" name="email" class="grow border-none focus:ring-transparent"
                            placeholder="Email" value="{{ old('email') }}" required autofocus />
                    </label>
                    @error('email')
                        <span class="text-red-500 mt-2 label-text-alt">{{ $message }}</span>
                    @enderror
                </div>

                <x-cta-button text="Email Password Reset Link" class="w-full" />

            </form>
        </div>
    </div>
@endsection
