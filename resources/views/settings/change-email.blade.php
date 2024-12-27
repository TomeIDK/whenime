@extends('layouts.base')

@section('title', 'Change Email')

@section('content')
    <div class="my-12">
        <h1 class="mb-8 text-6xl font-bold text-center">Change Email</h1>

        <form action="{{ route('settings.change-email.change') }}" method="POST" class="flex flex-col items-center gap-4">
            @csrf
            <div class="md:w-1/4">
                <div class="label">
                    <span class="label-text">New Email Address</span>
                </div>
                <label class="flex items-center gap-2 input input-bordered">
                    <input type="email" name="new_email" id="new_email" class="border-none grow focus:ring-transparent"
                        placeholder="New Email Address" required autofocus />
                </label>
                @error('new_email')
                    <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="text-white border-none outline-none btn bg-primary hover:bg-primary-hover-dark">Update
                Email</button>
        </form>
    </div>

@endsection
