@extends('layouts.base')

@section('title', $schedule->name)

@section('content')
    <div class="p-4">
        <h1 class="text-6xl font-bold my-16 text-center">{{ $schedule->name }}</h1>

        <div class="flex flex-col mb-4 w-1/2 m-auto gap-4">
            <div class="self-end">
                <x-cta-nav-link route="{{ route('home') }}" class="btn-sm font-bold"
                    text='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 22" fill="none" stroke="#ffffff" stroke-width="3"
                                            stroke-linecap="round" stroke-linejoin="bevel">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        Add Anime' />
            </div>
            <div class="flex space-x-4 mb-4">
                <select class="select select-bordered w-full">
                    <option value="">All Days</option>
                    @foreach ($uniqueDays as $day)
                        <option value="{{ $day }}">{{ $day }}</option>
                    @endforeach
                </select>
                <select class="select select-bordered w-full">
                    <option value="">All Platforms</option>
                    @foreach ($uniqueServices as $service)
                        <option value="{{ $service }}">{{ $service }}</option>
                    @endforeach
                    <!-- Add other platforms -->
                </select>
            </div>
        </div>
        <div class="w-1/2 m-auto">
            @foreach ($uniqueDays as $day)
                <div class="collapse collapse-plus">
                    <input type="checkbox" name="my-accordion-{{ $day }}" checked />
                    <div class="collapse-title text-xl font-medium border-b">{{ $day }}</div>
                    <div class="collapse-content mt-3 flex flex-col gap-3">
                        @if (isset($groupedItems[$day]))
                            @foreach ($groupedItems[$day] as $time => $items)
                                <div class="flex flex-col gap-2">
                                    <p class="text-discard underline font-bold">{{ date('H:i', strtotime($time)) }}
                                    </p>
                                    @foreach ($items as $item)
                                        <x-schedule-item name="{{ $item->name }}" service="{{ $item->service }}" />
                                    @endforeach
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection
