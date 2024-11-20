@extends('layouts.base')

@section('title', 'Explore')

@section('content')

    @foreach ($upcoming as $index => $anime)
        <div class="p-4">
            <small>Index: {{ $index }}</small>
            <small>ID:{{ $anime['mal_id'] }}</small>
            @foreach ($anime['titles'] as $title)
                @if ($title['type'] == 'English')
                    <h1>English: {{ $title['title'] }}</h1>
                @elseif ($title['type'] == 'Japanese')
                    <h2>Japanese: {{ $title['title'] }}</h2>
                @elseif ($title['type'] == 'Default')
                    <h2>Default: {{ $title['title'] }}</h2>
                @elseif ($title['type'] == 'Synonym')
                    <h2>Synonym: {{ $title['title'] }}</h2>
                @endif
            @endforeach
            <a href="{{ $anime['url'] }}" target="_blank">URL</a>
            <img src="{{ $anime['images']['jpg']['image_url'] }}" alt="">
            <p>Type: {{ $anime['type'] }}</p>
            <p>episodes: {{ $anime['episodes'] ?? 'N/A' }}</p>
            <p>Status: {{ $anime['status'] }}</p>
        </div>
    @endforeach
@endsection
