@extends('layouts.base')

@section('title', 'News - ' . $currentNews->title)

@section('content')
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="flex flex-col items-center gap-6 my-16 drawer-content">
            <!-- Page content -->
            <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">
                Open drawer
            </label>
            <x-news-item id="{{ $currentNews->id }}" title="{{ $currentNews->title }}"
                src="{{ $currentNews->image }}" content="{{ $currentNews->content }}"
                publishedDate="{{ $currentNews->created_at }}" categories="{{ $currentNews->categories->pluck('name')->join(',') }}" />
        </div>
        <div class="border-t shadow-md drawer-side">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="min-h-full p-4 menu bg-background text-base-content w-80">
                <!-- Sidebar  -->
                @foreach ($newsItems as $item)
                    @if ($item->id == $currentNews->id)
                        <li class="my-1"><a class="font-bold text-white bg-primary hover:bg-primary-hover-dark"
                                href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a></li>
                    @else
                        <li class="my-1"><a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endsection
