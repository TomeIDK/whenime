@extends('layouts.base')

@section('title', collect($anime['titles'])->firstWhere('type', 'English')['title'] ??
    collect($anime['titles'])->firstWhere('type', 'Default')['title'])

@section('content')
    <div class="flex justify-center gap-8 px-32 py-16">
        {{-- Sidebar --}}
        <img src="{{ $anime['images']['jpg']['large_image_url'] }}">

        {{-- Main Content --}}
        <div class="flex flex-col gap-2">
            <h1 class="text-3xl font-bold">
                {{ collect($anime['titles'])->firstWhere('type', 'English')['title'] ?? collect($anime['titles'])->firstWhere('type', 'Default')['title'] }}
            </h1>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <div class="flex gap-2">
                        <div class="flex flex-col items-center">
                            <div class="font-medium text-white badge bg-primary">RANK</div>
                            <p class="text-2xl font-medium">#{{ $anime['rank'] }}</p>
                        </div>
                        <div class="flex flex-col items-center justify-around">
                            <div class="font-medium text-white badge bg-primary">SCORE</div>
                            <p class="text-2xl font-medium">{{ $anime['score'] }}</p>
                        </div>
                        <div class="flex flex-col items-center justify-around">
                            <div class="font-medium text-white badge bg-primary">MEMBERS</div>
                            <p class="text-2xl font-medium">{{ number_format($anime['members']) }}</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="font-medium text-white badge bg-primary">TYPE</div>
                            <p class="text-2xl font-medium">{{ $anime['type'] }}</p>
                        </div>
                    </div>
                    <small class="ml-1 text-xs text-discard">Voted by {{ number_format($anime['scored_by']) }}
                        users</small>
                </div>
                <div class="flex flex-col gap-1 ml-1">

                    <div class="flex flex-col">
                        <h4 class="text-lg font-bold">Aired</h4>
                        <p class="text-sm">{{ date('M j, Y', strtotime($anime['aired']['from'])) }} to
                            {{ $anime['aired']['to'] ? date('M j, Y', strtotime($anime['aired']['to'])) : 'Unknown' }}</p>
                    </div>

                    <div class="flex flex-col mt-2">
                        <h4 class="text-lg font-bold">Synopsis</h4>
                        <p class="max-w-[120ch] text-sm">{{ $anime['synopsis'] }}</p>
                    </div>
                    <div class="flex gap-16">
                        <div>
                            <h4 class="mt-4 text-lg font-bold">Season</h4>
                            <p>{{ ucfirst($anime['season']) }} {{ $anime['year'] }}</p>
                        </div>
                        <div>
                            <h4 class="mt-4 text-lg font-bold">Broadcast</h4>
                            <p>{{ $anime['broadcast']['string'] !== 'Unknown'
                                ? format_user_time($anime['broadcast']['time'], substr($anime['broadcast']['day'], 0, -1))['day'] .
                                    's at ' .
                                    format_user_time($anime['broadcast']['time'], substr($anime['broadcast']['day'], 0, -1))['time']
                                : 'TBA' }}
                            </p>
                        </div>
                        <div>
                            <h4 class="mt-4 text-lg font-bold">Available on</h4>
                            @foreach ($services as $service)
                                @if (in_array($service['name'], $supportedServices))
                                    <a href="{{ $service['url'] }}"
                                        class="flex items-center gap-1 mb-1 hover:underline hover:text-primary">
                                        <img class="w-4"
                                            src="{{ asset('images/streaming_services/' . (str_contains($service['name'], '+') ? strtolower(str_replace('+', '', $service['name'])) : strtolower($service['name'])) . '-logo.png') }}"
                                            alt="{{ $service['name'] }} logo">
                                        <p>{{ $service['name'] }}</p>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h4 class="mt-4 text-lg font-bold">Status</h4>
                            <p>{{ $anime['status'] }}</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('anime.store', $anime['mal_id']) }}">
                        @csrf
                        <button type="submit"
                            class="mt-4 font-bold text-white border-none btn bg-primary hover:bg-primary-hover-dark w-fit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="16"></line>
                                <line x1="8" y1="12" x2="16" y2="12"></line>
                            </svg>
                            Add to {{ ucfirst($anime['season']) }} {{ $anime['year'] }} Schedule</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
