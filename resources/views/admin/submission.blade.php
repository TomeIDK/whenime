@extends('layouts.admin')

@section('title', 'Subject: ' . $submission->subject)

@section('content')
    @php
        use App\ContactFormStatus;
    @endphp
    <div class="flex flex-col w-1/2 gap-6 px-8 py-6 border rounded shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold">{{ $submission->subject }}</h1>
                <p class="stat-desc">Submission ID #{{ $submission->id }}</p>
            </div>
            <div class="text-white border-none badge bg-primary">{{ $submission->status }}</div>
        </div>
        <div class="flex items-center gap-3">
            <img class="w-16 rounded-full" src="{{ asset('storage/profile_pictures/default-profile-picture.jpg') }}"
                alt="">
            <div>
                <p class="text-xl font-semibold">{{ $submission->name }}</p>
                <p class="text-base stat-desc">{{ $submission->email }}</p>
            </div>
        </div>

        <div class="flex items-center gap-6">
            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <p>{{ explode(' ', $submission->created_at)[0] }}</p>
            </div>
            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <p>{{ substr(explode(' ', $submission->created_at)[1], 0, -3) }}</p>
            </div>
        </div>

        <div>
            <h3 class="text-sm font-bold">Message</h3>
            <p class="px-3 py-4 mt-2 border rounded">{{ $submission->message }}</p>
        </div>

        <div class="flex justify-between gap-2">
            {{-- Buttons --}}
            <a href="{{ route('contact.unread') }}"
                class="flex items-center gap-1 shadow-none text-text btn btn-sm btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10 16l-6-6 6-6" />
                    <path d="M20 21v-7a4 4 0 0 0-4-4H5" />
                </svg>
                Back to list
            </a>
            <div class="flex gap-2">
                <form method="POST" action="{{ route('contact.toggleSolved', $submission->id) }}">
                    @csrf
                    @method('PATCH')
                    @if ($submission->status == ContactFormStatus::Solved)
                        <button type="submit"
                            class="flex items-center gap-1 text-white border-none shadow-none bg-primary btn btn-sm hover:bg-primary-hover-dark">
                            Mark as unsolved
                        </button>
                    @else
                        <button type="submit"
                            class="flex items-center gap-1 text-white border-none shadow-none bg-primary btn btn-sm hover:bg-primary-hover-dark">
                            Mark as solved
                        </button>
                    @endif

                </form>
            </div>
        </div>
    </div>
@endsection
