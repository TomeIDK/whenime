@extends('layouts.admin')

@section('title', 'Manage ' . $status . ' forms')

@section('content')
    <div class="flex flex-col self-start w-full gap-4 px-24">
        <h1 class="text-4xl font-bold">Manage {{ $status }} forms</h1>
        <div class="flex items-center justify-between">
            <p class="stat-desc">Retrieved {{ $forms->count() . ' ' . $status }} forms
            </p>
            <div class="flex gap-2">
                {{-- Buttons --}}
                <a href="{{ route('contact.unread') }}"
                    class="flex items-center shadow-none btn-ghost btn btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="w-4 h-4 lucide lucide-mail">
                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                    </svg>
                    Unread
                </a>
                <a href="{{ route('contact.read') }}"
                    class="flex items-center shadow-none btn btn-sm btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="w-4 h-4 lucide lucide-mail-open">
                        <path
                            d="M21.2 8.4c.5.38.8.97.8 1.6v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V10a2 2 0 0 1 .8-1.6l8-6a2 2 0 0 1 2.4 0l8 6Z">
                        </path>
                        <path d="m22 10-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 10"></path>
                    </svg>
                    Read
                </a>
                <a href="{{ route('contact.solved') }}"
                    class="flex items-center shadow-none btn-ghost btn btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="w-4 h-4 lucide lucide-circle-check">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    Solved
                </a>
            </div>
        </div>

        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sender</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($forms as $form)
                    <!-- row -->
                    <tr data-route="{{ route('contact.show', $form->id) }}" class="cursor-pointer hover:bg-background">
                        <td>
                            <p class="text-xs text-discard">{{ $form->id }}</p>
                        </td>
                        {{-- Sender --}}
                        @if ($status == 'unread')
                            <td class="flex items-center gap-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="w-4 h-4 mr-2 lucide lucide-mail">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                </svg>
                                <p class="font-bold">{{ $form->name }}</p>
                            </td>
                            {{-- Subject --}}
                            <td>
                                <p class="font-bold">{{ $form->subject }}</p>
                            </td>
                        @elseif ($status == 'solved')
                            <td class="flex items-center gap-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="w-4 h-4 mr-2 lucide lucide-circle-check" data-id="17">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="m9 12 2 2 4-4"></path>
                                </svg>
                                <p">{{ $form->name }}</p>
                            </td>
                            {{-- Subject --}}
                            <td>
                                <p>{{ $form->subject }}</p>
                            </td>
                        @else
                            <td class="flex items-center gap-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="w-4 h-4 mr-2 lucide lucide-mail-open">
                                    <path
                                        d="M21.2 8.4c.5.38.8.97.8 1.6v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V10a2 2 0 0 1 .8-1.6l8-6a2 2 0 0 1 2.4 0l8 6Z">
                                    </path>
                                    <path d="m22 10-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 10"></path>
                                </svg>
                                <p>{{ $form->name }}</p>
                            </td>
                            {{-- Subject --}}
                            <td>
                                <p>{{ $form->subject }}</p>
                            </td>
                        @endif

                        {{-- Date --}}
                        <td>
                            <p>{{ str_replace(' ', ' @ ', substr($form->created_at, 0, -3)) }}</p>
                        </td>
                        {{-- Actions --}}
                        <td>
                            <div class="dropdown dropdown-end actions-container">
                                <div tabindex="0" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg>
                                </div>
                                <ul tabindex="0"
                                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                                    <li class="mb-2 font-bold">Actions</li>
                                    @if ($status == 'unread')
                                        <li>
                                            <form method="POST" action="{{ route('contact.toggleRead', $form->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="justify-between mb-1">
                                                    Mark as read
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                    @if ($status == 'read')
                                        <li>
                                            <form method="POST" action="{{ route('contact.toggleRead', $form->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="justify-between mb-1">
                                                    Mark as unread
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('contact.toggleSolved', $form->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="justify-between mb-1">
                                                    Mark as solved
                                                </button>
                                            </form>
                                        </li>
                                    @elseif ($status == 'solved')
                                        <li>
                                            <form method="POST" action="{{ route('contact.toggleSolved', $form->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="justify-between mb-1">
                                                    Mark as unsolved
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                    <li>
                                        <button onclick="showDeleteFormModal({{ $form->id }})"
                                            class="justify-between mb-1 hover:bg-red-500 hover:text-white hover:font-bold">
                                            Delete
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($forms->lastPage() > 1)
            <div class="self-center mt-4 join">
                {{-- Previous --}}
                @if ($forms->onFirstPage())
                    <button class="join-item btn btn-outline btn-disabled">
                        << Previous</button>
                        @else
                            <a href="{{ $forms->previousPageUrl() }}" class="join-item btn btn-outline">
                                << Previous</a>
                @endif
                {{-- Page Numbers --}}
                @foreach ($forms->getUrlRange(1, $forms->lastPage()) as $page => $url)
                    @if ($page == $forms->currentPage())
                        <button class="join-item btn btn-outline btn-disabled">{{ $page }}</button>
                    @else
                        <a href="{{ $url }}" class="join-item btn btn-outline">{{ $page }}</a>
                    @endif
                @endforeach
                {{-- Next --}}
                @if ($forms->hasMorePages())
                    <a href="{{ $forms->nextPageUrl() }}" class="join-item btn btn-outline">
                        Next >></a>
                @else
                    <button class="join-item btn btn-outline btn-disabled">Next >></button>
                @endif
            </div>
        @endif
    </div>

    <!-- Delete Submission Modal -->
    <dialog id="delete_submission_modal" class="text-center modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-balance">Are you sure you want to delete this submission?
            </h3>
            <p class="underline text-discard">This action cannot be undone!</p>
            <div class="flex justify-center gap-4 modal-action">
                {{-- Delete Schedule Item --}}
                <form method="POST" action="{{ route('contact.destroy', ':id') }}" id="delete_submission_form">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('table tbody tr').forEach(row => {
                row.addEventListener('click', function() {
                    window.location.href = row.getAttribute('data-route');
                });
            });
        });

        document.querySelectorAll('.actions-container').forEach(dropdown => {
            dropdown.addEventListener('click', (event) => {
                event.stopPropagation();
            });
        });

        function showDeleteFormModal(id) {
            // Select the delete form directly without using Blade syntax in the selector
            const deleteForm = document.querySelector('#delete_submission_form');

            // Ensure that the action URL contains the placeholder ':id' before replacing
            if (deleteForm.action.includes(':id')) {
                deleteForm.action = deleteForm.action.replace(':id', id); // Replace ':id' with the actual ID
            }

            // Show the modal
            const modal = document.getElementById('delete_submission_modal');
            modal.showModal();
        }
    </script>
@endsection
