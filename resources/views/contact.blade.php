@extends('layouts.guest')

@section('title', 'Contact')

@section('header')
    @include('components.menu')
@endsection


@section('content')

    <div class="flex flex-col gap-8 items-center p-4 mx-auto mt-32">
        <div class="flex flex-col gap-12 w-96">

            <h1 class="text-6xl font-bold text-center">Contact Us</h1>

            <span class="mb-4 underline text-center">{{ session('success') }}</span>

            <form method="POST" action="">
                @csrf
                <!-- Name -->
                <div class="label">
                    <span class="label-text">Name</span>
                </div>
                <label class="input input-bordered flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="bevel">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <input type="text" name="name" class="grow border-none focus:ring-transparent" placeholder="Name"
                        value="{{ old('name') }}" required autofocus autocomplete="name" />
                </label>
                @error('name')
                    <span class="text-red-500 mt-2 label-text-alt">{{ $message }}</span>
                @enderror

                <!-- Email -->
                <div class="label">
                    <span class="label-text">Email</span>
                </div>
                <label class="input input-bordered flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="bevel">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                        </path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <input type="text" name="email" class="grow border-none focus:ring-transparent" placeholder="Email"
                        value="{{ old('email') }}" required autocomplete="email" />
                </label>
                @error('email')
                    <span class="text-red-500 mt-2 label-text-alt">{{ $message }}</span>
                @enderror

                <!-- Subject -->
                <div class="label">
                    <span class="label-text">Subject</span>
                </div>
                <label class="input input-bordered flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="bevel">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                        <path d="M14 3v5h5M16 13H8M16 17H8M10 9H8" />
                    </svg>
                    <input type="text" name="subject" class="grow border-none focus:ring-transparent"
                        placeholder="Subject" value="{{ old('subject') }}" required />
                </label>
                @error('subject')
                    <span class="text-red-500 mt-2 label-text-alt">{{ $message }}</span>
                @enderror

                <!-- Message -->
                <div class="label">
                    <span class="label-text">Message</span>
                </div>
                <textarea name="contact_message" class="textarea border border-gray-300 rounded w-full p-2 focus:outline-none" placeholder="Message"
                    value="{{ old('message') }}" required></textarea>
                @error('message')
                    <span class="text-red-500 mt-2 label-text-alt">{{ $message }}</span>
                @enderror

                <x-cta-button text="Send Message" class="w-full mt-6" />
            </form>
        </div>
    </div>
@endsection
