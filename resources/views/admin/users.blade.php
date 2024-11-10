@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
    <div class="flex flex-col self-start w-full gap-4 px-24">
        <h1 class="text-4xl font-bold">Manage Users</h1>
        <div class="flex items-center justify-between">
            <p class="stat-desc">Retrieved {{ $users->total() }} users</p>
            {{-- Update Item --}}
            <button class="flex items-center gap-1 text-white border-none shadow-none bg-primary btn btn-sm hover:bg-primary"
                onclick="showAddUserModal()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <line x1="20" y1="8" x2="20" y2="14"></line>
                    <line x1="23" y1="11" x2="17" y2="11"></line>
                </svg>
                <p>Create new user</p>
            </button>
        </div>
        <div>
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <!-- row -->
                        <tr>
                            <td>
                                <p class="text-xs text-discard">{{ $user->id }}</p>
                            </td>
                            {{-- Username --}}
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="w-12 h-12 mask mask-squircle">
                                            <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/default-profile-picture.jpg') }}"
                                                alt="Avatar Tailwind CSS Component" />
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        @if ($user->is_admin)
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
                                        <x-link route="{{ route('profile', $user->username) }}"
                                            text="{{ $user->username }}" />
                                    </div>
                                </div>
                            </td>

                            {{-- Email --}}
                            <td>
                                <p>{{ $user->email }}</p>
                            </td>

                            {{-- Registered --}}
                            <td>{{ str_replace(' ', ' @ ', substr($user->created_at, 0, -3)) }}</td>
                            <td>{{-- Profile Picture --}}
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
                                        <li class="mb-2 font-bold">Actions for {{ $user->username }}</li>
                                        <li>
                                            <a href="{{ route('profile.edit', $user->username) }}"
                                                class="justify-between mb-1">
                                                Edit profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="justify-between mb-1">
                                                Edit account
                                            </a>
                                        </li>
                                        <li></li>
                                        <li>
                                            <a href="" class="justify-between mb-1">
                                                Ban
                                            </a>
                                        </li>
                                        @if ($user->is_admin)
                                            <li>
                                                <form action="{{ route('admin-users.toggleAdmin', $user) }}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="justify-between mb-1">
                                                        Demote from admin
                                                    </button>
                                                </form>
                                            </li>
                                        @else
                                            <li>
                                                <form action="{{ route('admin-users.toggleAdmin', $user) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="justify-between mb-1">
                                                        Promote to admin
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                        <li></li>
                                        <li>
                                            <button onclick="showDeleteUserModal({{ $user->id }})"
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
        @if ($users->lastPage() > 1)
            <div class="self-center mt-4 join">
                {{-- Previous --}}
                @if ($users->onFirstPage())
                    <button class="join-item btn btn-outline btn-disabled">
                        << Previous</button>
                        @else
                            <a href="{{ $users->previousPageUrl() }}" class="join-item btn btn-outline">
                                << Previous</a>
                @endif
                {{-- Page Numbers --}}
                @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                    @if ($page == $users->currentPage())
                        <button class="join-item btn btn-outline btn-disabled">{{ $page }}</button>
                    @else
                        <a href="{{ $url }}" class="join-item btn btn-outline">{{ $page }}</a>
                    @endif
                @endforeach
                {{-- Next --}}
                @if ($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}" class="join-item btn btn-outline">
                        Next >></a>
                @else
                    <button class="join-item btn btn-outline btn-disabled">Next >></button>
                @endif
            </div>
        @endif
    </div>

    <!-- Create New User Modal -->
    <dialog id="add_user_modal" class="text-center modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <form method="dialog">
                <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
            </form>
            <h3 class="text-2xl font-bold">Add new user</h3>

            <form method="POST" action="{{ route('admin-users.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- Username -->
                <div class="flex flex-col w-3/4 gap-1 m-auto">
                    <div class="label">
                        <span class="label-text">Username <em>*</em></span>
                    </div>
                    <label class="flex items-center gap-2 input input-bordered">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="w-4 h-4 opacity-70">
                            <path
                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
                        </svg>
                        <input type="text" name="username" class="border-none grow focus:ring-transparent"
                            placeholder="Username" value="{{ old('username') }}" required autofocus
                            autocomplete="username" />
                    </label>
                    @error('username')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror

                    <!-- Email -->
                    <div class="label">
                        <span class="label-text">Email <em>*</em></span>
                    </div>
                    <label class="flex items-center gap-2 input input-bordered">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="w-4 h-4 opacity-70">
                            <path
                                d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                            <path
                                d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                        </svg>
                        <input type="text" name="email" class="border-none grow focus:ring-transparent"
                            placeholder="Email" value="{{ old('email') }}" required autocomplete="email" />
                    </label>
                    @error('email')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror

                    <!-- Password -->
                    <div class="label">
                        <span class="label-text">Password <em>*</em></span>
                    </div>
                    <label class="flex items-center gap-2 input input-bordered">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="w-4 h-4 opacity-70">
                            <path fill-rule="evenodd"
                                d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                                clip-rule="evenodd" />
                        </svg>
                        <input type="password" name="password" class="border-none grow focus:ring-transparent"
                            placeholder="Password" required />
                    </label>
                    @error('password')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror

                    <!-- Repeat Password -->
                    <div class="label">
                        <span class="label-text">Repeat Password <em>*</em></span>
                    </div>
                    <label class="flex items-center gap-2 input input-bordered">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="w-4 h-4 opacity-70">
                            <path fill-rule="evenodd"
                                d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                                clip-rule="evenodd" />
                        </svg>
                        <input type="password" name="password_confirmation"
                            class="border-none grow focus:ring-transparent" placeholder="Repeat Password" required />
                    </label>
                    @error('password_confirmation')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror

                    <!-- Date of Birth -->
                    <div class="label">
                        <span class="label-text">Date of Birth</span>
                    </div>
                    <label class="flex items-center gap-2 input input-bordered">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="bevel" class="w-4 h-4 opacity-70">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <input type="date" name="date_of_birth" class="border-none grow focus:ring-transparent"
                            value="{{ old('date_of_birth') }}" autocomplete="bday-day" />
                    </label>
                    @error('date_of_birth')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror

                    <!-- Profile Picture -->
                    <div class="label">
                        <span class="label-text">Upload Profile Picture</span>
                    </div>
                    <input type="file" name="profile_picture"
                        class="w-full max-w-xs border file-input file-input-sm file-input-bordered" />
                    @error('profile_picture')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="mt-6 text-white border-none outline-none btn btn-sm bg-success hover:bg-success-hover">Create
                    User</button>
            </form>
        </div>
    </dialog>

    <!-- Delete User Modal -->
    <dialog id="delete_user_modal" class="text-center modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-balance">Are you sure you want to delete this user?
            </h3>
            <p class="underline text-discard">This action cannot be undone!</p>
            <div class="flex justify-center gap-4 modal-action">
                {{-- Delete Schedule Item --}}
                <form method="POST" action="{{ route('admin-users.destroy', ':id') }}" id="delete_user_form">
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
        function showAddUserModal() {
            // Show the modal
            const modal = document.getElementById('add_user_modal');
            modal.showModal();
        }

        function showDeleteUserModal(userId) {
            // Select the delete form directly without using Blade syntax in the selector
            const deleteForm = document.querySelector('#delete_user_form');

            // Ensure that the action URL contains the placeholder ':id' before replacing
            if (deleteForm.action.includes(':id')) {
                deleteForm.action = deleteForm.action.replace(':id', userId); // Replace ':id' with the actual ID
            }

            // Show the modal
            const modal = document.getElementById('delete_user_modal');
            modal.showModal();
        }
    </script>
@endsection
