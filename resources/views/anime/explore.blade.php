@extends('layouts.base')

@section('title', 'Explore')

@section('content')
    <div class="flex flex-col gap-8 mx-32 my-8">
        @if ($daysUntilNextSeason != -1)
            <h1 class="text-6xl font-bold text-center">{{ $daysUntilNextSeason }} days until {{ $nextSeason['season'] }}
                {{ $nextSeason['year'] }}!</h1>
        @else
            <h1 class="text-6xl font-bold text-center">{{ $currentSeason }} {{ date('Y') }} is now live!</h1>
        @endif

        {{-- Top Airing Anime --}}
        <div>
            <h1 class="pb-2 pr-12 ml-12 text-2xl font-bold border-b w-fit">Top Airing Anime</h1>
            <div class="grid grid-cols-3 grid-rows-2 px-8 pb-4">
                @foreach ($airing as $index => $anime)
                    <div class="flex p-4">
                        <img src="{{ $anime['images']['jpg']['image_url'] }}" alt=""
                            class="object-cover max-h-36 aspect-auto">

                        <div class="flex flex-col pl-4 grow">
                            {{-- Title --}}
                            @foreach ($anime['titles'] as $title)
                                @if ($title['type'] == 'English')
                                    <a href="{{ route('anime.show', $anime['mal_id']) }}" class="hover:underline hover:text-primary">
                                        <h2 class="mb-2 font-medium">{{ $title['title'] }}</h2>
                                    </a>
                                @endif
                            @endforeach
                            @if ($anime['broadcast']['string'])
                                {{-- Broadcast --}}
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <p>{{ $anime['broadcast']['string'] }}</p>
                                </div>
                            @endif

                            <div class="flex gap-3">
                                {{-- Score --}}
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <polygon
                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                        </polygon>
                                    </svg>
                                    <p>{{ $anime['score'] }}</p>
                                </div>

                                {{-- Episodes --}}
                                @if ($anime['episodes'])
                                    <div class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        <p>{{ $anime['episodes'] }} eps.</p>
                                    </div>
                                @endif
                            </div>
                            <x-cta-button class="self-end mt-auto btn-sm" text="Want to Watch" />
                        </div>

                    </div>
                @endforeach
            </div>
        </div>

        {{-- Popular Upcoming Anime --}}
        <div>
            <h1 class="pb-2 pr-12 ml-12 text-2xl font-bold border-b w-fit">Popular Upcoming Anime</h1>
            <div class="grid grid-cols-3 grid-rows-2 px-8 ">
                @foreach ($popularUpcoming as $index => $anime)
                    <div class="flex p-4">
                        <img src="{{ $anime['images']['jpg']['image_url'] }}" alt=""
                            class="object-cover max-h-36 aspect-auto">

                        <div class="flex flex-col pl-4 grow">
                            {{-- Title --}}
                            <a href="{{ route('anime.show', $anime['mal_id']) }}" class="hover:underline hover:text-primary">
                                <h2 class="mb-2 font-medium">
                                    {{ collect($anime['titles'])->firstWhere('type', 'English')['title'] ??
                                        collect($anime['titles'])->firstWhere('type', 'Default')['title'] }}
                                </h2>
                            </a>

                            @if ($anime['aired']['from'])
                                {{-- Start Date --}}
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2">
                                        </rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <p>{{ date('F jS, Y', strtotime($anime['aired']['from'])) }}</p>
                                </div>
                            @endif

                            @if ($anime['broadcast']['string'])
                                {{-- Broadcast --}}
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <p>{{ $anime['broadcast']['string'] !== 'Unknown' ? $anime['broadcast']['string'] : 'TBA' }}
                                    </p>
                                </div>
                            @endif

                            {{-- Members --}}
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <p>{{ number_format($anime['members']) }} Members</p>
                            </div>
                            <x-cta-button class="self-end mt-auto btn-sm" text="Want to Watch" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
