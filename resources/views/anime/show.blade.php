@extends('layouts.base')

@section('title', collect($anime['titles'])->firstWhere('type', 'English')['title'] ?? collect($anime['titles'])->firstWhere('type', 'Default')['title'])

@section('content')

<h1>{{ collect($anime['titles'])->firstWhere('type', 'English')['title'] ?? collect($anime['titles'])->firstWhere('type', 'Default')['title'] }}</h1>
<h1>{{ collect($anime['titles'])->firstWhere('type', 'Japanese')['title'] ?? '' }}</h1>
<h1>{{ collect($anime['titles'])->firstWhere('type', 'Synonym')['title'] ?? '' }}</h1>


@endsection