<div class="drawer lg:drawer-open">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
    <div class="flex flex-col items-center gap-6 my-16 drawer-content">
        <!-- Page content here -->
        <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">
            Open drawer
        </label>
        @section('content')
        @show
    </div>
    <div class="border-t shadow-md drawer-side">
        <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="min-h-full px-5 py-5 bg-background text-base-content w-80">
            <!-- Sidebar content here -->
            <li class="flex items-center">
                <a href="{{ route('admin-dashboard') }}"
                    class="text-2xl border-none shadow-none btn bg-background hover:bg-background hover:text-primary hover:border-none">Whenime
                    Admin</a>
                {{-- Profile Picture --}}
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button"
                        class="btn btn-ghost btn-circle avatar hover:border-primary hover:bg-primary hover:bg-opacity-50 hover:border-opacity-30">
                        <div class="w-10 rounded-full">
                            <img alt="Tailwind CSS Navbar component"
                                src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('storage/profile_pictures/default-profile-picture.jpg') }}" />
                        </div>
                    </div>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                        <li class="mb-2 font-bold">{{ Auth::user()->username }}</li>
                        <li>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="bevel">
                                    <path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3" />
                                    <circle cx="12" cy="10" r="3" />
                                    <circle cx="12" cy="12" r="10" />
                                </svg>
                                <a href="{{ route('profile', Auth::user()->username) }}" class="justify-between mb-1">
                                    Profile
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="bevel">
                                    <circle cx="12" cy="12" r="3"></circle>
                                    <path
                                        d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                    </path>
                                </svg>
                                <a class="mb-1">
                                    Settings
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="bevel">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
                                    </rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                <a href="{{ route('admin-dashboard') }}" class="mb-1" />
                                Admin Dashboard
                                </a>
                            </div>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="bevel">
                                        <path d="M10 3H6a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h4M16 17l5-5-5-5M19.8 12H9" />
                                    </svg>
                                    <button type="submit" class="mb-1">
                                        Logout
                                    </button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="px-8 py-2">
                <h4 class="admin-nav-link-title">Dashboard</h4>
            </li>
            <li><a href="{{ route('home') }}" class="admin-nav-link">Home</a></li>
            <li><a href="{{ route('admin-dashboard') }}" class="admin-nav-link">Dashboard</a></li>

            <li class="px-8 py-2">
                <h4 class="admin-nav-link-title">Manage</h4>
            </li>
            <li><a href="{{ route('admin-users') }}" class="admin-nav-link">Users</a></li>
            <li><a href="{{ route('news.admin') }}" class="admin-nav-link">News</a></li>
            <li><a href="{{ route('faq.admin') }}" class="admin-nav-link">FAQ</a></li>
            <li><a href="{{ route('contact.unread') }}" class="admin-nav-link">Contact Forms</a></li>

            <li class="px-8 py-2 w-fit">
                <h4 class="admin-nav-link-title">Analytics & Reports</h4>
            </li>
            <li><a class="admin-nav-link">Analytics</a></li>
            <li><a class="admin-nav-link">User Activity</a></li>

            <li class="px-8 py-2 mt-6 border-t">
                <h4 class="admin-nav-link-title">Settings</h4>
            </li>
            <li><a class="admin-nav-link">Profile</a></li>
        </ul>
        </ul>
    </div>
</div>
