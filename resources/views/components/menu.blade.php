{{-- Navbar Menu Component --}}
<header class="shadow-md bg-background">
    <nav>
        <div class="navbar">
            <div class="flex-1">
                <div class="flex items-center">
                    {{-- Logo --}}
                    <a href="{{ route('home') }}"
                        class="btn text-2xl border-none shadow-none bg-background hover:bg-background hover:text-primary hover:border-none">Whenime</a>
                    <div class="flex-none">
                        {{-- Links --}}
                        <ul class="menu menu-horizontal px-1">
                            <li><x-nav-link route="{{ route('home') }}" text="Home" /></li>
                            <li><x-nav-link route="{{ route('news.latest') }}" text="News" /></li>
                            <li><x-nav-link route="{{ route('faq') }}" text="FAQ" /></li>
                            <li><x-nav-link route="{{ route('contact') }}" text="Contact" /></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="flex-none gap-2">
                <div class="flex-none">
                    {{-- Guest Menu --}}
                    @guest
                        {{-- Login / Register --}}
                        <ul class="menu menu-horizontal px-1 gap-2">
                            <li><a href="{{ route('login') }}" class="btn btn-sm btn-tertiary">Log
                                    In</a></li>
                            <li><a href="{{ route('register') }}"
                                    class="btn btn-sm border-none shadow-none bg-primary text-white hover:bg-primary-hover-dark">Register</a>
                            </li>
                        </ul>
                    @endguest

                    {{-- User Menu --}}
                    @auth
                        <div class="flex items-center">
                            {{-- Links --}}
                            <ul class="menu menu-horizontal px-1 gap-2">
                                <li>
                                    <a class="btn btn-sm border-none btn-ghost">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 22" fill="none" stroke="#000000" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="bevel" class="h-4 w-4 opacity-70">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2">
                                            </rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        My Schedule
                                    </a>
                                </li>
                                <li>
                                    <x-cta-nav-link route="{{ route('home') }}" class="btn-sm font-bold"
                                        text='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 22" fill="none" stroke="#ffffff" stroke-width="3"
                                            stroke-linecap="round" stroke-linejoin="bevel">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        Add Anime' />
                                </li>
                            </ul>
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
                                    <li class="font-bold mb-2">{{ Auth::user()->username }}</li>
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
                                    @admin
                                        <li>
                                            <div class="flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="bevel">
                                                    <rect x="3" y="11" width="18" height="11" rx="2"
                                                        ry="2">
                                                    </rect>
                                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                </svg>
                                                <a class="mb-1" />
                                                Admin Dashboard
                                                </a>
                                            </div>
                                        </li>
                                    @endadmin
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" class="inline">
                                            @csrf
                                            <div class="flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="bevel">
                                                    <path
                                                        d="M10 3H6a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h4M16 17l5-5-5-5M19.8 12H9" />
                                                </svg>
                                                <button type="submit" class="mb-1">
                                                    Logout
                                                </button>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>
