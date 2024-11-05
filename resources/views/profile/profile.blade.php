@extends('layouts.base')

@section('title', $user->username . (strtolower(substr($user->username, strlen($user->username) - 1)) == 's' ? "'" :
    "'s") . ' Profile')

@section('content')
    <div class="flex flex-row h-full w-full grow p-8 justify-center gap-16">
        <div class="flex flex-col gap-2">
            <div class="avatar">
                <div class="w-96 rounded">
                    <img
                        src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/default-profile-picture.jpg') }}" />
                </div>
            </div>
            @auth
                @if ($isCurrentUser || Auth::user()->is_admin)
                    <x-cta-nav-link route="{{ route('profile.edit', $user->username) }}" class="w-full self-center mt-3"
                        text="Edit Profile" />
                @endif
            @endauth
            <div class="flex justify-between text-discard">
                @if ($user->date_of_birth)
                    <div class="flex items-center gap-1">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-balloon" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 9.984C10.403 9.506 12 7.48 12 5a4 4 0 0 0-8 0c0 2.48 1.597 4.506 4 4.984M13 5c0 2.837-1.789 5.227-4.52 5.901l.244.487a.25.25 0 1 1-.448.224l-.008-.017c.008.11.02.202.037.29.054.27.161.488.419 1.003.288.578.235 1.15.076 1.629-.157.469-.422.867-.588 1.115l-.004.007a.25.25 0 1 1-.416-.278c.168-.252.4-.6.533-1.003.133-.396.163-.824-.049-1.246l-.013-.028c-.24-.48-.38-.758-.448-1.102a3 3 0 0 1-.052-.45l-.04.08a.25.25 0 1 1-.447-.224l.244-.487C4.789 10.227 3 7.837 3 5a5 5 0 0 1 10 0m-6.938-.495a2 2 0 0 1 1.443-1.443C7.773 2.994 8 2.776 8 2.5s-.226-.504-.498-.459a3 3 0 0 0-2.46 2.461c-.046.272.182.498.458.498s.494-.227.562-.495" />
                        </svg>
                        <p>{{ date('F j', strtotime($user->date_of_birth)) }}</p>
                    </div>
                @endif
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="#6b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <p>
                        Joined {{ date('F j, Y', strtotime($user->created_at)) }}
                    </p>
                </div>
            </div>
            @if ($user->schedules)
                <h3 class="text-xl font-bold">Schedules</h3>
                @foreach ($user->schedules as $schedule)
                    @if ($schedule->name === $currentSchedule->name)
                        <p class="w-fit ml-4 underline text-primary hover:cursor-pointer">
                            {{ $schedule->name }}
                        </p>
                    @else
                        <a href="{{ route('profile-schedule.show',['username' => $user->username, 'scheduleName' => $schedule->name]) }}" class="w-fit text-discard ml-4 hover:underline hover:text-primary hover:cursor-pointer">
                            {{ $schedule->name }}
                        </a>
                    @endif
                @endforeach
            @endif
        </div>

        <div class="flex flex-col w-1/2 gap-2">
            <h1 class="text-2xl font-bold text-primary">
                {{ $user->username . (strtolower(substr($user->username, strlen($user->username) - 1)) == 's' ? "'" : "'s") }}
                Profile</h1>
            <p>{{ $user->about ? $user->about : 'No information given' }}</p>

            {{-- Schedule --}}
            @if ($currentSchedule)

                <div>
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
                                                <x-schedule-item name="{{ $item->name }}"
                                                    service="{{ $item->service }}" />
                                            @endforeach
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
