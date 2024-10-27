<header class="shadow-md bg-background">
    <nav>
        <div class="navbar">
            <div class="flex-1">
                <a href="{{ route("home") }}"
                    class="btn text-2xl border-none shadow-none bg-background hover:bg-background hover:text-primary hover:border-none">Whenime</a>
                <div class="flex-none">
                    <ul class="menu menu-horizontal px-1">
                        <li><a href="{{ route("home") }}" class="btn nav-link btn-tertiary">Home</a></li>
                        <li><a href="{{ route("about") }}" class="btn nav-link btn-tertiary">About</a></li>
                        <li><a href="{{ route("faq") }}" class="btn nav-link btn-tertiary">FAQ</a></li>
                    </ul>
                </div>
            </div>

            <div class="flex-none gap-2">
                <div class="flex-none">
                    <ul class="menu menu-horizontal px-1 gap-2">
                        <li><a href="{{ route("login") }}"
                                class="btn btn-sm btn-tertiary">Log
                                In</a></li>
                        <li><a href="{{ route("register") }}"
                                class="btn btn-sm border-none shadow-none bg-primary text-white hover:bg-primary-hover-dark">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
