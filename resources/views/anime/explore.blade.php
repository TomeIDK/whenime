@extends('layouts.base')

@section('title', 'Explore')

@section('content')

    <h1 class="text-2xl font-bold">Top Airing Anime</h1>

    <div class="grid grid-cols-4 p-8 ">
        @foreach ($airing as $index => $anime)
            <div class="flex p-4 w-4/5">
                <img src="{{ $anime['images']['jpg']['image_url'] }}" alt="" class="object-cover max-h-48 aspect-auto">

                <div class="pl-4">
                    @foreach ($anime['titles'] as $title)
                        @if ($title['type'] == 'English')
                            <a href="{{ $anime['url'] }}">
                                <h2>{{ $title['title'] }}</h2>
                            </a>
                        @endif
                    @endforeach
                    <p>Rating: {{ $anime['score'] }}</p>
                    <p>Airing time: {{ $anime['broadcast']['string'] }}</p>
                    <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="15" rx="2" ry="2"></rect>
                            <polyline points="17 2 12 7 7 2"></polyline>
                        </svg> {{ $anime['type'] }}</p>
                    <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>{{ $anime['episodes'] ?? 'N/A' }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
