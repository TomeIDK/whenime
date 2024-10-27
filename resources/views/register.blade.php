@extends('layouts.guest')

@section('title', 'Whenime - Register')


@section('content')
    <div class="hero bg-white min-h-screen hero-gradient">
        <div class="hero-content flex-col gap-4 items-start">
            <div class="flex flex-col gap-2">
                <h1 class="text-4xl font-bold text-white">Register</h1>
                <small class="">Already have an account? <a class="custom-link" href={{ route('login') }}>Log
                        in</a></small>
            </div>
            <div class="max-w-md">
                <div class="label">
                    <span class="label-text">Username <em>*</em></span>
                </div>
                <label class="input input-bordered flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="h-4 w-4 opacity-70">
                        <path
                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
                    </svg>
                    <input type="text" class="grow border-none focus:ring-transparent" placeholder="Username" required />
                </label>

                <div class="label">
                    <span class="label-text">Email <em>*</em></span>
                </div>
                <label class="input input-bordered flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="h-4 w-4 opacity-70">
                        <path
                            d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                        <path
                            d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                    </svg>
                    <input type="text" class="grow border-none focus:ring-transparent" placeholder="Email" required />
                </label>

                <div class="label">
                    <span class="label-text">Password <em>*</em></span>
                </div>
                <label class="input input-bordered flex items-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="h-4 w-4 opacity-70">
                        <path fill-rule="evenodd"
                            d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="password" class="grow border-none focus:ring-transparent" placeholder="Password" required />
                </label>

                <div class="label">
                    <span class="label-text">Repeat Password <em>*</em></span>
                </div>
                <label class="input input-bordered flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="h-4 w-4 opacity-70">
                        <path fill-rule="evenodd"
                            d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="password" class="grow border-none focus:ring-transparent" placeholder="Password" required />
                </label>

                <div class="label">
                    <span class="label-text">Date of Birth</span>
                </div>
                <label class="input input-bordered flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="bevel"
                        class="h-4 w-4 opacity-70">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <input type="date" class="grow border-none focus:ring-transparent" />
                </label>

                <div class="label">
                    <span class="label-text">Upload Profile Picture</span>
                </div>
                <input type="file" class="file-input file-input-sm file-input-bordered w-full max-w-xs border-none" />
            </div>
        </div>
    </div>
@endsection
