@extends('layouts.guest')

@section('title', 'Whenime - Login')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="hero bg-white min-h-screen hero-gradient">
            <div class="hero-content flex-col gap-4 items-start">
                <div class="flex flex-col gap-2 ">
                    <h1 class="text-4xl font-bold text-white">Log in</h1>
                    <small class="">Don't have an account yet? <a class="custom-link"
                            href={{ route('register') }}>Register</a></small>
                </div>
                <div class="max-w-md">
                    <div class="label">
                        <span class="label-text">Username</span>
                    </div>
                    <label class="input input-bordered flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="h-4 w-4 opacity-70">
                            <path
                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
                        </svg>

                        <input type="text" name="username" class="grow border-none focus:ring-transparent"
                            placeholder="Username" :value="old('username')" required autofocus />

                    </label>
                    @error('username')
                        <span class="text-red-500 mt-2 label-text-alt">{{ $message }}</span>
                    @enderror

                    <div class="label">
                        <span class="label-text">Password</span>
                        <a href={{ route('forgot-password') }} class="custom-link label-text-alt">Forgot Password?</a>
                    </div>
                    <label class="input input-bordered flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="h-4 w-4 opacity-70">
                            <path fill-rule="evenodd"
                                d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                                clip-rule="evenodd" />
                        </svg>

                        <input type="password" name="password" class="grow border-none focus:ring-transparent"
                            placeholder="Password" required />

                    </label>
                    @error('password')
                        <span class="text-red-500 mt-2 label-text-alt">{{ $message }}</span>
                    @enderror

                    <label class="label cursor-pointer flex flex-row justify-start gap-1">
                        <input type="checkbox" name="remember" class="checkbox checkbox-xs rounded justify-start" />
                        <span class="label-text">Remember me</span>
                    </label>
                    <x-cta-button text="Login" class="w-full" />

                </div>
            </div>
        </div>
    </form>
@endsection
