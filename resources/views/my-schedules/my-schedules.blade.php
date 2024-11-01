@extends('layouts.base')

@section('title', 'My Schedules')

@section('content')
    <div class="m-16">
        <h1 class="text-6xl font-bold text-center">My Anime Schedules</h1>

        <div class="grid grid-cols-4 gap-4 my-16">
            @foreach ($user->schedules as $schedule)
                <div class="card border hover:border-primary hover:bg-blue-100 transition-all duration-300 w-96 text-text">
                    <div class="card-body p-6 gap-2">
                        <div class="flex gap-1 justify-between items-center">
                            <h2 class="card-title">{{ $schedule->name }}</h2>
                            @if ($schedule->is_public)
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="#333333" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="#333333" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" data-id="8">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68">
                                    </path>
                                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                    <line x1="2" x2="22" y1="2" y2="22"></line>
                                </svg>
                            @endif
                        </div>
                        <small>15 anime</small>
                        <div class="card-actions justify-between mt-4">
                            <x-cta-nav-link route="{{ route('my-schedules.edit', $schedule->name) }}"
                                class="btn-sm self-start flex flex-col items-center gap-1"
                                text='
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" 
                            fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon></svg> 
                            Edit' />
                            <a class="btn btn-sm border-none bg-delete hover:bg-delete-hover text-white flex flex-col items-center gap-1"
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
            <div class="card border hover:border-primary hover:bg-blue-100 transition-all duration-300 w-96 text-text">
                <div class="card-body p-0 gap-2">
                    <button class="my-auto w-full h-full p-6" onclick="my_modal_6.showModal()">
                        <div class="gap-1 text-discard flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                fill="none" stroke="#6b7280" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            <h2 class="card-title font-normal">Create new schedule</h2>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Create Schedule Modal -->
            <dialog id="my_modal_6" class="modal modal-bottom sm:modal-middle text-center">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <h3 class="text-lg font-bold">Create a new schedule</h3>
                    <div class="modal-action flex gap-4 justify-center mt-2">
                        {{-- Create Schedule --}}
                        <form method="POST" action="{{ route('my-schedules.store') }}" class="flex flex-col gap-2">
                            @csrf
                            <div>
                                <div class="label">
                                    <span class="label-text">Schedule name</span>
                                </div>
                                <label class="input input-bordered flex items-center gap-2">
                                    <input type="text" name="name" class="grow border-none focus:ring-transparent"
                                        placeholder="Schedule" :value="old('name')" required autofocus />
                                </label>
                                @error('name')
                                    <span class="text-red-500 mt-2 label-text-alt">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="label cursor-pointer flex flex-row justify-start gap-1">
                                    <input type="checkbox" name="is_public"
                                        class="checkbox checkbox-xs rounded justify-start" value="1" checked />
                                    <span class="label-text">Public</span>
                                </label>
                            </div>
                            <button type="submit"
                                class="btn btn-sm border-none bg-success hover:bg-success-hover text-white outline-none">Create
                                schedule</button>
                        </form>
                    </div>
                </div>
            </dialog>

            <!-- Delete Confirmation Modal -->
            <dialog id="my_modal_5" class="modal modal-bottom sm:modal-middle text-center">
                <div class="modal-box">
                    <h3 class="text-lg font-bold">Are you sure you want to delete this schedule?</h3>
                    <p class="text-discard underline">This action cannot be undone!</p>
                    <div class="modal-action flex gap-4 justify-center">
                        {{-- Delete Schedule --}}
                        <form method="POST" action="{{ route('my-schedules.destroy', ':id') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm border-none bg-delete hover:bg-delete-hover text-white outline-none">Yes,
                                delete</button>
                        </form>
                        <form method="dialog">
                            <button class="btn btn-sm border-none bg-discard text-white hover:bg-discard-hover">No,
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
