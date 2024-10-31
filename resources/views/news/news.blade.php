@extends('layouts.base')

@section('title', 'News - ' . $currentNews->title)

@section('content')
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col gap-6 my-16 items-center">
            <!-- Page content -->
            <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">
                Open drawer
            </label>
            <x-news-item id="{{ $currentNews->id }}" title="{{ $currentNews->title }}" src="{{ asset('storage/' . $currentNews->image) }}"
                content="{{ $currentNews->content }}" publishedDate="{{ $currentNews->created_at }}" />
        </div>
        <div class="drawer-side shadow-md border-t">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-background text-base-content min-h-full w-80 p-4">
                <!-- Sidebar  -->
                @foreach ($newsItems as $item)
                    @if ($item->id == $currentNews->id)
                        <li class="my-1"><a class="bg-primary text-white font-bold hover:bg-primary-hover-dark"
                                href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a></li>
                    @else
                        <li class="my-1"><a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endsection
