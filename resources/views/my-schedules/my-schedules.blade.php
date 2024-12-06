@extends('layouts.base')

@section('title', 'My Schedules')

@section('content')
    <div class="m-16">
        <h1 class="text-6xl font-bold text-center">My Anime Schedules</h1>

        <div class="grid grid-cols-4 gap-4 my-16">
            @foreach ($user->schedules as $schedule)
                <div class="transition-all duration-300 border card hover:border-primary hover:bg-blue-100 text-text">
                    <div class="gap-2 p-6 card-body">
                        <div class="flex items-center justify-between gap-1">
                            <div class="flex items-center gap-4">
                                <h2 class="card-title">{{ $schedule->season . ' ' . $schedule->year }}</h2>
                                @if ($schedule->status == "Airing")
                                <div class="text-white badge bg-primary">{{ $schedule->status }}</div>
                                    @else
                                <div class="text-white badge bg-discard">{{ $schedule->status }}</div>
                                @endif
                            </div>
                        </div>
                        <small>{{ $schedule->schedule_items_count }} anime</small>
                        <div class="justify-between mt-4 card-actions">
                            <x-cta-nav-link route="{{ route('my-schedules.edit', [$schedule->season, $schedule->year]) }}"
                                class="flex flex-col items-center self-start gap-1 btn-sm"
                                text='
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                            fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon></svg> 
                            Edit' />
                            <a class="flex flex-col items-center gap-1 text-white border-none btn btn-sm bg-delete hover:bg-delete-hover"
                                onclick="showDeleteModal({{ $schedule->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                    </path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                                Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="transition-all duration-300 border card hover:border-primary hover:bg-blue-100 w-96 text-text">
                <div class="gap-2 p-0 card-body">
                    <button class="w-full h-full p-6 my-auto" onclick="my_modal_6.showModal()">
                        <div class="flex flex-col items-center gap-1 text-discard">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                fill="none" stroke="#6b7280" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            <h2 class="font-normal card-title">Create new schedule</h2>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Create Schedule Modal -->
            <dialog id="my_modal_6" class="text-center modal modal-bottom sm:modal-middle">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
                    </form>
                    <h3 class="text-lg font-bold">Create a new schedule</h3>
                    <div class="flex justify-center gap-4 mt-2 modal-action">
                        {{-- Create Schedule --}}
                        <form method="POST" action="{{ route('my-schedules.store') }}" class="flex flex-col gap-2">
                            @csrf
                            <div class="flex justify-around gap-4">
                                <div>
                                    <div class="label">
                                        <span class="label-text">Season</span>
                                    </div>
                                    <select name="season" class="w-full select select-bordered" required>
                                        @foreach ($seasons as $season)
                                            @if ($season == $currentSeason)
                                                <option selected="selected" value="{{ $season }}">{{ $season }}
                                                </option>
                                            @else
                                                <option value="{{ $season }}">{{ $season }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <div class="label">
                                        <span class="label-text">Year</span>
                                    </div>
                                    <select name="year" class="w-full select select-bordered" required>
                                        <option value="{{ date('Y') - 1 }}">{{ date('Y') - 1 }}</option>
                                        <option selected="selected" value="{{ date('Y') }}">{{ date('Y') }}
                                        </option>
                                        <option value="{{ date('Y') + 1 }}">{{ date('Y') + 1 }}</option>
                                    </select>

                                </div>
                            </div>
                            @error('season')
                                <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                            @enderror
                            @error('year')
                                <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                            @enderror
                            <button type="submit"
                                class="text-white border-none outline-none btn btn-sm bg-success hover:bg-success-hover">Create
                                schedule</button>
                        </form>
                    </div>
                </div>
            </dialog>

            <!-- Delete Confirmation Modal -->
            <dialog id="my_modal_5" class="text-center modal modal-bottom sm:modal-middle">
                <div class="modal-box">
                    <h3 class="text-lg font-bold">Are you sure you want to delete this schedule?</h3>
                    <p class="underline text-discard">This action cannot be undone!</p>
                    <div class="flex justify-center gap-4 modal-action">
                        {{-- Delete Schedule --}}
                        <form method="POST" action="{{ route('my-schedules.destroy', ':id') }}">
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
    </div>
    <script>
        function showDeleteModal(scheduleId) {
            // Set the action of the delete form with the schedule id
            const deleteForm = document.querySelector(
                '#my_modal_5 form[action^="{{ route('my-schedules.destroy', '') }}"]');
            deleteForm.action = deleteForm.action.replace(':id',
                scheduleId); // Replace the last number in the action URL with the schedule id

            // Show the modal
            const modal = document.getElementById('my_modal_5');
            modal.showModal();
        }
    </script>

@endsection
