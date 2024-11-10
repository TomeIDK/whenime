@extends('layouts.admin')

@section('title', 'Manage News')

@section('content')
    <div class="flex flex-col self-start w-full gap-4 px-24">
        <h1 class="text-4xl font-bold">Manage News Items</h1>
        <div class="flex items-center justify-between">
            <p class="stat-desc">Retrieved {{ $news->total() }} news items</p>
            {{-- Update Item --}}
            <a href="{{ route('news.create') }}" class="flex items-center gap-1 text-white border-none shadow-none bg-primary btn btn-sm hover:bg-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                    <path d="M14 3v5h5M12 18v-6M9 15h6" />
                </svg>
                <p>Create News Item</p>
            </a>
        </div>
        <div>
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $item)
                        <!-- row -->
                        <tr>
                            <td>
                                <p class="text-xs text-discard">{{ $item->id }}</p>
                            </td>
                            {{-- Title --}}
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center gap-1">
                                        @if ($item->is_admin)
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                stroke="#4a90e2" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M16.2451 8.29289C16.6356 7.90237 17.2688 7.90237 17.6593 8.29289C18.0498 8.68342 18.0498 9.31658 17.6593 9.70711L11.9043 15.4611C11.1232 16.242 9.85696 16.242 9.07596 15.461L7.29288 13.6779C6.90235 13.2874 6.90235 12.6542 7.29288 12.2637C7.6834 11.8732 8.31657 11.8732 8.70709 12.2637L9.78359 13.3402C10.1741 13.7307 10.8073 13.7307 11.1978 13.3402L16.2451 8.29289Z"
                                                        fill="#0F0F0F"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12 1.00195C11.0268 1.00195 10.3021 1.39456 9.68627 1.72824C9.54287 1.80594 9.40536 1.88044 9.27198 1.94605C8.49696 2.32729 7.32256 2.78014 4.93538 2.94144C3.36833 3.04732 1.97417 4.32298 2.03666 6.03782C2.13944 8.85853 2.46666 11.7444 3.12474 14.1763C3.76867 16.5559 4.78826 18.7274 6.44528 19.8321C8.02992 20.8885 9.33329 21.8042 10.2053 22.4293C11.276 23.1969 12.724 23.1969 13.7947 22.4293C14.6667 21.8042 15.97 20.8885 17.5547 19.8321C19.2117 18.7274 20.2313 16.5559 20.8752 14.1763C21.5333 11.7445 21.8605 8.8586 21.9633 6.03782C22.0258 4.32298 20.6316 3.04732 19.0646 2.94144C16.6774 2.78014 15.503 2.32729 14.728 1.94605C14.5946 1.88045 14.4571 1.80596 14.3138 1.72828C13.6979 1.39459 12.9732 1.00195 12 1.00195ZM5.07021 4.93689C7.70274 4.75901 9.13306 4.24326 10.1548 3.74068C10.4467 3.5971 10.6724 3.47746 10.8577 3.37923C11.3647 3.11045 11.5694 3.00195 12 3.00195C12.4305 3.00195 12.6352 3.11045 13.1423 3.37923C13.3276 3.47746 13.5533 3.5971 13.8452 3.74068C14.8669 4.24326 16.2972 4.75901 18.9298 4.93689C19.5668 4.97993 19.9826 5.47217 19.9646 5.965C19.865 8.70066 19.5487 11.4218 18.9447 13.6539C18.3265 15.9383 17.4653 17.4879 16.4453 18.1679C14.8385 19.2392 13.5162 20.1681 12.6294 20.8038C12.2553 21.072 11.7447 21.072 11.3705 20.8038C10.4837 20.1681 9.1615 19.2392 7.55469 18.1679C6.53465 17.4879 5.67349 15.9383 5.0553 13.6538C4.45127 11.4217 4.13502 8.70059 4.03533 5.965C4.01738 5.47217 4.43314 4.97993 5.07021 4.93689Z"
                                                        fill="#0F0F0F"></path>
                                                </g>
                                            </svg>
                                        @endif
                                        <x-link route="{{ route('news.show', $item->id) }}"
                                            text="{{ $item->title }}" />
                                    </div>
                                </div>
                            </td>

                            {{-- Published --}}
                            <td>{{ str_replace(' ', ' @ ', substr($item->created_at, 0, -3)) }}</td>
                            <td>{{-- Actions --}}
                                <div class="dropdown dropdown-end">
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
                                        <li>
                                            <a href="{{ route('news.edit', $item->id) }}"
                                                class="justify-between mb-1">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button onclick="showDeleteNewsItemModal({{ $item->id }})"
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
        </div>
        @if ($news->lastPage() > 1)
            <div class="self-center mt-4 join">
                {{-- Previous --}}
                @if ($news->onFirstPage())
                    <button class="join-item btn btn-outline btn-disabled">
                        << Previous</button>
                        @else
                            <a href="{{ $news->previousPageUrl() }}" class="join-item btn btn-outline">
                                << Previous</a>
                @endif
                {{-- Page Numbers --}}
                @foreach ($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                    @if ($page == $news->currentPage())
                        <button class="join-item btn btn-outline btn-disabled">{{ $page }}</button>
                    @else
                        <a href="{{ $url }}" class="join-item btn btn-outline">{{ $page }}</a>
                    @endif
                @endforeach
                {{-- Next --}}
                @if ($news->hasMorePages())
                    <a href="{{ $news->nextPageUrl() }}" class="join-item btn btn-outline">
                        Next >></a>
                @else
                    <button class="join-item btn btn-outline btn-disabled">Next >></button>
                @endif
            </div>
        @endif
    </div>

    <!-- Delete User Modal -->
    <dialog id="delete_news_item_modal" class="text-center modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-balance">Are you sure you want to delete this news item?
            </h3>
            <p class="underline text-discard">This action cannot be undone!</p>
            <div class="flex justify-center gap-4 modal-action">
                {{-- Delete Schedule Item --}}
                <form method="POST" action="{{ route('news.destroy', ':id') }}" id="delete_news_item_form">
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
        function showDeleteNewsItemModal(id) {
            // Select the delete form directly without using Blade syntax in the selector
            const deleteForm = document.querySelector('#delete_news_item_form');

            // Ensure that the action URL contains the placeholder ':id' before replacing
            if (deleteForm.action.includes(':id')) {
                deleteForm.action = deleteForm.action.replace(':id', id); // Replace ':id' with the actual ID
            }

            // Show the modal
            const modal = document.getElementById('delete_news_item_modal');
            modal.showModal();
        }
    </script>

@endsection
