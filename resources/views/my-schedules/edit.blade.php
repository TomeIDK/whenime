@extends('layouts.base')

@section('title', $schedule->season . ' ' . $schedule->year)

@section('content')
    <div class="flex flex-col items-center gap-8 p-4">
        <h1 class="text-6xl font-bold text-center">{{ $schedule->season . ' ' . $schedule->year }}</h1>

        {{-- Search --}}
        <div class="w-3/4">
            <form method="GET" action="{{ route('my-schedules.edit', [$schedule->season, $schedule->year]) }}"
                class="flex flex-col w-1/2 gap-1 justify-self-center">
                <label class="flex items-center gap-2 pr-0 border-r-0 input input-bordered">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" class="grow" name="search" placeholder="Search"
                        value="{{ request('search') }}" />
                    <x-cta-button text="Search" class="px-6 rounded-l-none" />
                </label>
                <div class="form-control">
                    <label class="flex flex-row justify-start gap-1 cursor-pointer label">
                        <input type="checkbox" {{ request('onlyAiringAndUpcoming') ? 'checked' : '' }}
                            name="onlyAiringAndUpcoming"
                            class="checkbox checkbox-sm border-muted [--chkbg:rgb(74,144,226)] [--chkfg:white] rounded" />
                        <span class="label-text">Airing and upcoming releases only</span>
                    </label>
                </div>
            </form>
            @if ($searchResults)
                <div>
                    <h1 class="pb-2 pr-12 text-2xl font-bold border-b w-fit">Search Results
                        ({{ $searchResults['total'] }})</h1>
                    <div class="grid grid-cols-3 pb-4 grid-rows-auto">
                        @foreach ($searchResults['data'] as $index => $result)
                            <div class="flex p-4">
                                <img src="{{ $result['images']['jpg']['image_url'] }}" alt=""
                                    class="object-cover max-h-36 aspect-auto">

                                <div class="flex flex-col pl-4 grow">
                                    {{-- Title --}}
                                    @foreach ($result['titles'] as $title)
                                        @if ($title['type'] == 'Default')
                                            <a href="{{ route('anime.show', $result['mal_id']) }}"
                                                class="hover:underline hover:text-primary">
                                                <h2 class="mb-2 font-medium">{{ $title['title'] }}</h2>
                                            </a>
                                        @endif
                                    @endforeach
                                    {{-- Status --}}
                                    <div class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="2"></circle>
                                            <path
                                                d="M16.24 7.76a6 6 0 0 1 0 8.49m-8.48-.01a6 6 0 0 1 0-8.49m11.31-2.82a10 10 0 0 1 0 14.14m-14.14 0a10 10 0 0 1 0-14.14">
                                            </path>
                                        </svg>
                                        <p>{{ $result['status'] }}</p>
                                    </div>
                                    @if ($result['aired']['from'])
                                        {{-- Start Date --}}
                                        <div class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="4" width="18" height="18" rx="2"
                                                    ry="2">
                                                </rect>
                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg>
                                            <p>{{ date('M j, Y', strtotime($result['aired']['from'])) }} to
                                                {{ $result['aired']['to'] ? date('M j, Y', strtotime($result['aired']['to'])) : 'Unknown' }}
                                            </p>
                                        </div>
                                    @endif
                                    @if ($result['status'] != 'Finished Airing' && $result['broadcast']['string'])
                                        {{-- Broadcast --}}
                                        <div class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            <p>{{ $result['broadcast']['string'] !== 'Unknown'
                                                ? format_user_time_from_jst($result['broadcast']['time'], substr($result['broadcast']['day'], 0, -1))['day'] .
                                                    's at ' .
                                                    format_user_time_from_jst($result['broadcast']['time'], substr($result['broadcast']['day'], 0, -1))['time']
                                                : 'TBA' }}
                                            </p>
                                        </div>
                                    @endif

                                    <div class="flex gap-3">
                                        @if ($result['score'])
                                            {{-- Score --}}
                                            <div class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <polygon
                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                    </polygon>
                                                </svg>
                                                <p>{{ $result['score'] }}</p>
                                            </div>
                                        @endif

                                        {{-- Episodes --}}
                                        @if ($result['episodes'])
                                            <div class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                                <p>{{ $result['episodes'] }} eps.</p>
                                            </div>
                                        @endif
                                    </div>
                                    @if ($result['season'])
                                        <form method="POST" action="{{ route('anime.store', $result['mal_id']) }}"
                                            class="self-end mt-auto">
                                            @csrf
                                            <x-cta-button class="btn-sm"
                                                text="Add to {{ strtoupper($result['season'][0]) }}{{ substr($result['season'], 1) }} {{ $result['year'] }}" />
                                        </form>
                                    @endif

                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="w-1/2">
            @foreach ($uniqueDays as $day)
                <div class="collapse collapse-plus">
                    <input type="checkbox" name="my-accordion-{{ $day }}" checked />
                    <div class="text-xl font-medium border-b collapse-title">{{ $day }}</div>
                    <div class="flex flex-col gap-3 mt-3 collapse-content">
                        @if (isset($groupedItems[$day]))
                            @foreach ($groupedItems[$day] as $time => $items)
                                <div class="flex flex-col gap-2">
                                    <p class="font-bold underline text-discard">{{ $time }}
                                    </p>
                                    @foreach ($items as $item)
                                        <div class="flex justify-between hover:underline">
                                            {{-- Item --}}
                                            <x-schedule-item :name="$item->name" :service="$item->service" :animeid="$item->anime_id" />
                                            <div class="flex gap-1">
                                                {{-- Update Item --}}
                                                <button
                                                    class="flex flex-col items-center gap-1 bg-transparent border-none shadow-none btn btn-sm hover:bg-primary"
                                                    onclick="showUpdateModal({{ $item->id }}, '{{ $item->name }}', '{{ format_user_time_from_utc($item->time, $item->day)['day'] }}', '{{ format_user_time_from_utc($item->time)['time'] }}', '{{ $item->service }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="#000000"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon>
                                                    </svg>
                                                </button>
                                                {{-- Delete Item --}}
                                                <button
                                                    class="flex flex-col items-center gap-1 bg-transparent border-none shadow-none btn btn-sm hover:bg-delete-hover"
                                                    onclick="showDeleteModal({{ $item->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="#000000"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10"
                                                            y2="17">
                                                        </line>
                                                        <line x1="14" y1="11" x2="14"
                                                            y2="17">
                                                        </line>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            @endforeach
        </div>
        <!-- Create Schedule Item Modal -->
        <dialog id="create_schedule_item" class="text-center modal modal-bottom sm:modal-middle">
            <div class="modal-box">
                <form method="dialog">
                    <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
                </form>
                <h3 class="text-2xl font-bold">Add anime to<br>{{ $schedule->season . ' ' . $schedule->year }}</h3>
                <div class="flex justify-center gap-4 mt-2 modal-action">

                    {{-- Create Schedule Item --}}
                    <form method="POST"
                        action="{{ route('schedule-item.store', [$schedule->season, $schedule->year]) }}"
                        class="flex flex-col gap-6">
                        @csrf
                        <div>
                            <div class="label">
                                <span class="label-text">I will be watching</span>
                            </div>
                            <label class="flex items-center gap-2 input input-bordered">
                                <input type="text" name="name" class="border-none grow focus:ring-transparent"
                                    placeholder="Anime" :value="old('name')" required autofocus />
                            </label>
                            @error('name')
                                <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                            @enderror

                            <div class="label">
                                <span class="label-text">which airs on</span>
                            </div>
                            <select class="w-full select select-bordered" name="day" required>
                                <option value="" disabled selected>Select a day</option>
                                <option value="Monday" {{ old('day') === 'Monday' ? 'selected' : '' }}>Monday</option>
                                <option value="Tuesday" {{ old('day') === 'Tuesday' ? 'selected' : '' }}>Tuesday
                                </option>
                                <option value="Wednesday" {{ old('day') === 'Wednesday' ? 'selected' : '' }}>Wednesday
                                </option>
                                <option value="Thursday" {{ old('day') === 'Thursday' ? 'selected' : '' }}>Thursday
                                </option>
                                <option value="Friday" {{ old('day') === 'Friday' ? 'selected' : '' }}>Friday</option>
                                <option value="Saturday" {{ old('day') === 'Saturday' ? 'selected' : '' }}>Saturday
                                </option>
                                <option value="Sunday" {{ old('day') === 'Sunday' ? 'selected' : '' }}>Sunday</option>
                            </select>
                            @error('day')
                                <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                            @enderror

                            <div class="label">
                                <span class="label-text">at</span>
                            </div>
                            <label class="flex items-center gap-2 input input-bordered">
                                <input type="time" name="time" class="border-none grow focus:ring-transparent"
                                    :value="old('time')" required />
                            </label>
                            @error('time')
                                <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                            @enderror

                            <div class="label">
                                <span class="label-text">on</span>
                            </div>
                            <select class="w-full select select-bordered" name="service" required>
                                <option value="" disabled selected>Select a streaming service</option>
                                <option value="Netflix" {{ old('service') === 'Netflix' ? 'selected' : '' }}>Netflix
                                </option>
                                <option value="HIDIVE" {{ old('service') === 'HIDIVE' ? 'selected' : '' }}>HIDIVE</option>
                                <option value="Disney+" {{ old('service') === 'Disney+' ? 'selected' : '' }}>Disney+
                                </option>
                                <option value="Funimation" {{ old('service') === 'Funimation' ? 'selected' : '' }}>
                                    Funimation</option>
                                <option value="Crunchyroll" {{ old('service') === 'Crunchyroll' ? 'selected' : '' }}>
                                    Crunchyroll</option>
                                <option value="Other" {{ old('service') === 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('service')
                                <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit"
                            class="text-white border-none outline-none btn btn-sm bg-success hover:bg-success-hover">Add
                            anime</button>
                    </form>
                </div>
            </div>
        </dialog>

        <!-- Update Schedule Item Modal -->
        <dialog id="update_schedule_item" class="text-center modal modal-bottom sm:modal-middle">
            <div class="modal-box">
                <form method="dialog">
                    <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
                </form>
                <h3 class="text-2xl font-bold">Edit Anime</h3>
                <div class="flex justify-center gap-4 mt-2 modal-action">
                    {{-- Update Schedule Item --}}
                    <form method="POST" action="{{ route('schedule-item.update', ':id') }}" id="update_form"
                        class="flex flex-col gap-6">
                        @csrf
                        @method('PATCH')
                        <div>
                            <div class="label">
                                <span class="label-text">Name</span>
                            </div>
                            <label class="flex items-center gap-2 input input-bordered">
                                <input type="text" name="name" class="border-none grow focus:ring-transparent"
                                    placeholder="Anime" required />
                            </label>
                            @error('name')
                                <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                            @enderror

                            <div class="label">
                                <span class="label-text">Day</span>
                            </div>
                            <select class="w-full select select-bordered" name="day" required>
                                <option value="" disabled selected>Select a day</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                            @error('day')
                                <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                            @enderror

                            <div class="label">
                                <span class="label-text">Time</span>
                            </div>
                            <label class="flex items-center gap-2 input input-bordered">
                                <input type="time" name="time" class="border-none grow focus:ring-transparent"
                                    required />
                            </label>
                            @error('time')
                                <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                            @enderror

                            <div class="label">
                                <span class="label-text">Service</span>
                            </div>
                            <select class="w-full select select-bordered" name="service" required>
                                <option value="" disabled selected>Select a streaming service</option>
                                <option value="Netflix">Netflix</option>
                                <option value="HIDIVE">HIDIVE</option>
                                <option value="Disney+">Disney+</option>
                                <option value="Funimation">Funimation</option>
                                <option value="Crunchyroll">Crunchyroll</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('service')
                                <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                            @enderror
                        </div>


                        <button type="submit"
                            class="text-white border-none outline-none btn btn-sm bg-success hover:bg-success-hover">Update
                            anime</button>
                    </form>
                </div>
            </div>
        </dialog>

        <!-- Delete Schedule Item Confirmation Modal -->
        <dialog id="delete_schedule_item" class="text-center modal modal-bottom sm:modal-middle">
            <div class="modal-box">
                <h3 class="text-lg font-bold text-balance">Are you sure you want to delete this anime from your schedule?
                </h3>
                <p class="underline text-discard">This action cannot be undone!</p>
                <div class="flex justify-center gap-4 modal-action">
                    {{-- Delete Schedule Item --}}
                    <form method="POST" action="{{ route('schedule-item.destroy', ':id') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-white border-none outline-none btn btn-sm bg-delete hover:bg-delete-hover">Yes,
                            delete</button>
                    </form>
                    <form method="dialog">
                        <button class="text-white border-none btn btn-sm bg-discard hover:bg-discard-hover">No,
                            don't
                            delete</button>
                    </form>
                </div>
            </div>
        </dialog>
    </div>

    <script>
        function showDeleteModal(scheduleItemId) {
            // Select the delete form directly without using Blade syntax in the selector
            const deleteForm = document.querySelector('#delete_schedule_item form');

            // Ensure that the action URL contains the placeholder ':id' before replacing
            if (deleteForm.action.includes(':id')) {
                deleteForm.action = deleteForm.action.replace(':id', scheduleItemId); // Replace ':id' with the actual ID
            }

            // Show the modal
            const modal = document.getElementById('delete_schedule_item');
            modal.showModal();
        }

        function showUpdateModal(scheduleItemId, name, day, time, service) {
            // Populate the fields in the modal
            document.querySelector('#update_schedule_item [name="name"]').value = name;
            document.querySelector('#update_schedule_item [name="day"]').value = day;
            document.querySelector('#update_schedule_item [name="time"]').value = time;
            document.querySelector('#update_schedule_item [name="service"]').value = service;

            // Select the update form directly without using Blade syntax in the selector
            const updateForm = document.getElementById('update_form');

            // Ensure that the action URL contains the placeholder ':id' before replacing
            if (updateForm.action.includes(':id')) {
                updateForm.action = updateForm.action.replace(':id', scheduleItemId); // Replace ':id' with the actual ID
            }

            // Show the modal
            const modal = document.getElementById('update_schedule_item');
            modal.showModal();
        }
    </script>


@endsection
