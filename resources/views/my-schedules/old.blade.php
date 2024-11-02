@extends('layouts.no-header')

@section('title', $schedule->name)

@section('content')
    @php
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    @endphp

    <div class="container mx-auto py-8">
        <div class="grid grid-cols-8 border border-b-0">
            <div class="font-bold border border-b-0"></div>
            @foreach ($days as $day)
                <div class="font-bold text-center border border-b-0">{{ $day }}</div>
            @endforeach
        </div>

        <div class="grid grid-rows-auto border border-t-0"> <!-- Adjusted to 48 rows for half-hour slots -->
            @for ($hour = 0; $hour < 24; $hour++)
                <div class="grid grid-cols-8 border-x h-fit border border-y-transparent hover:border-primary p-0 m-0"> <!-- Full Hour Time slot lane -->
                    <div class="flex text-xs items-center border-t justify-end px-1"> <!-- Full Hour Time slot -->
                        {{ sprintf('%02d:00', $hour) }} <!-- Full hour -->
                    </div>

                    @foreach ($days as $day)
                        <div class="flex flex-col px-2 border border-b-0 border-l border-r-0 hover:bg-blue-50"
                            data-day="{{ $day }}" data-hour="{{ $hour }}"
                            ondragover="event.preventDefault(); handleDragOver(event)"
                            ondrop="handleDrop(event, '{{ $day }}', '{{ sprintf('%02d:00', $hour) }}')">
                                @foreach ($schedule->scheduleItems as $item)
                                    @if ($item->day === $day && $item->time === sprintf('%02d:00:00', $hour))
                                        <x-schedule-item itemId="{{ $item->id }}" itemName="{{ $item->name }}" itemService="{{ $item->service }}" itemTime="{{ $item->time }}"/>
                                    @endif
                                @endforeach
                        </div>
                    @endforeach
                </div>

                <!-- Half-hour row -->
                <div class="grid grid-cols-8 border-gray-300 border-x h-fit border border-y-0 hover:border-primary p-0 m-0"> <!-- Half Hour Time slot lane -->
                    <div class="flex text-xs items-center justify-end px-1 border-t border-dotted min-h-4 hover:border-primary"> <!-- Half Hour Time slot -->
                    </div>

                    @foreach ($days as $day)
                        <div class="flex flex-col px-2 border-t border-t-dotted border-b-0 border-l border-r-0 border-solid hover:bg-blue-50"
                            data-day="{{ $day }}" data-hour="{{ sprintf('%02d:30', $hour) }}"
                            ondragover="event.preventDefault(); handleDragOver(event)"
                            ondrop="handleDrop(event, '{{ $day }}', '{{ sprintf('%02d:30', $hour) }}')">
                            @foreach ($schedule->scheduleItems as $item)
                                @if ($item->day === $day && $item->time === sprintf('%02d:30:00', $hour))
                                    <x-schedule-item itemId="{{ $item->id }}" itemName="{{ $item->name }}" itemService="{{ $item->service }}" itemTime="{{ $item->time }}" />
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endfor
        </div>
    </div>
@endsection
