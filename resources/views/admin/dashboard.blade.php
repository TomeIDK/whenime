@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
@php
    use \App\ContactFormStatus;
@endphp
    <div class="self-start w-full px-24">
        <h1 class="text-4xl font-bold">Whenime Overview</h1>

        <div class="grid grid-cols-2 gap-6 py-6">

            <div class="shadow stats">
                <div class="stat">
                    <div class="flex items-center justify-between stat-title">
                        <p class="font-medium text-text">Total Registered Users</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#666666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <p class="stat-value text-primary">{{ $users['count'] }}</p>
                    <small
                        class="stat-desc">{{ number_format($users['comparison'] > 0 ? (($users['count'] - $users['comparison']) / $users['comparison']) * 100 : $users['count'] * 100, 2) }}%
                        more than last week</small>
                </div>
            </div>
            <div class="shadow stats">
                <div class="stat">
                    <div class="flex items-center justify-between stat-title">
                        <p class="font-medium text-text">New Messages</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#666666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </div>
                    <p class="stat-value text-primary">0</p>
                    <small class="stat-desc">0 more than last week</small>
                </div>
            </div>

            <div class="shadow stats">
                <div class="stat">
                    <div class="flex items-center justify-between stat-title">
                        <p class="font-medium text-text">Published News Items</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#666666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                            <path d="M14 3v5h5M16 13H8M16 17H8M10 9H8" />
                        </svg>
                    </div>
                    <p class="stat-value text-primary">{{ $news['count'] }}</p>
                    <small
                        class="stat-desc">{{ number_format($news['comparison'] > 0 ? (($news['count'] - $news['comparison']) / $news['comparison']) * 100 : $news['count'] * 100, 2) }}%
                        more than last week</small>
                </div>
            </div>

            <div class="shadow stats">
                <div class="stat">
                    <div class="flex items-center justify-between stat-title">
                        <p class="font-medium text-text">Total Schedules</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#666666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <p class="stat-value text-primary">{{ $schedules['count'] }}</p>
                    <small
                        class="stat-desc">{{ number_format($schedules['comparison'] > 0 ? (($schedules['count'] - $schedules['comparison']) / $schedules['comparison']) * 100 : $schedules['count'] * 100, 2) }}%
                        more than last week</small>
                </div>
            </div>
        </div>
        <h1 class="mt-6 text-4xl font-bold">Recent Activity</h1>

        <div class="grid grid-cols-2 gap-6 py-6">
            {{-- New User Registrations --}}
            <div class="flex flex-col gap-3 px-4 border rounded-lg">
                <h2 class="mt-4 text-2xl font-medium">New User Registrations</h2>
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Registered</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users['latest'] as $user)
                                <!-- row -->
                                <tr>
                                    <td>
                                        <p class="text-xs text-discard">{{ $user->id }}</p>
                                    </td>
                                    {{-- Username --}}
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="w-12 h-12 mask mask-squircle">
                                                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/default-profile-picture.jpg') }}"
                                                        alt="Avatar Tailwind CSS Component" />
                                                </div>
                                            </div>
                                            <div>
                                                <x-link route="{{ route('profile', $user->username) }}"
                                                    text="{{ $user->username }}" />
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Email --}}
                                    <td>
                                        <p>{{ $user->email }}</p>
                                    </td>

                                    {{-- Registered --}}
                                    <td>{{ str_replace(' ', ' @ ', substr($user->created_at, 0, -3)) }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Recent News Posts --}}
            <div class="flex flex-col gap-3 px-4 border rounded-lg">
                <h2 class="mt-4 text-2xl font-medium">Recent News Posts</h2>

                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Published</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news['latest'] as $item)
                                <!-- row -->
                                <tr>
                                    {{-- Title --}}
                                    <td>
                                        <x-link route="{{ route('news.show', $item->id) }}"
                                            text="{{ $item->title }}" />
                                    </td>

                                    {{-- Published --}}
                                    <td>{{ str_replace(' ', ' @ ', substr($item->created_at, 0, -3)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Unprocessed Contact Forms --}}
            <div class="flex flex-col col-span-2 gap-3 px-4 border rounded-lg">
                <h2 class="mt-4 text-2xl font-medium">Unprocessed Contact Forms</h2>

                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Sender</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row -->
                            @foreach ($forms as $form)
                                <tr>
                                    {{-- Subject --}}
                                    <td>
                                        <p>{{ $form->subject }}</p>
                                    </td>

                                    {{-- Sender Name --}}
                                    <td>
                                        <p>{{ $form->name }}</p>
                                    </td>

                                    {{-- Sender Email --}}
                                    <td>
                                        <p>{{ $form->email }}</p>
                                    </td>

                                    {{-- Date --}}
                                    <td>{{ str_replace(' ', ' @ ', substr($form->created_at, 0, -3)) }}</td>

                                    {{-- Status --}}
                                    <td>
                                        @if ($form->status == ContactFormStatus::Unread)
                                        <div class="text-white border-none badge bg-delete">{{ $form->status }}</div>
                                            @elseif ($form->status == ContactFormStatus::Read)
                                        <div class="text-white border-none badge bg-warning">{{ $form->status }}</div>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
