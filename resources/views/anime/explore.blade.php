@extends('layouts.base')

@section('title', 'Explore')

@section('content')

    <h1>Top Airing Anime ></h1>
    <div class="grid grid-cols-3 p-8">
        @foreach ($airing as $index => $anime)
            <div class="flex p-4">
                <img src="{{ $anime['images']['jpg']['image_url'] }}" alt="" class="object-cover max-h-48 aspect-auto">

                <div class="px-4">
                    <p>Rating: {{ $anime['score'] }}</p>
                    @foreach ($anime['titles'] as $title)
                        @if ($title['type'] == 'English')
                            <a href="{{ $anime['url'] }}">
                                <h2>Default: {{ $title['title'] }}</h2>
                            </a>
                        @endif
                    @endforeach
                    <p>Airing time: {{ $anime['broadcast']['string'] }}</p>
                    <p>Type: {{ $anime['type'] }}</p>
                    <p>Episodes: {{ $anime['episodes'] ?? 'N/A' }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
