<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen bg-white">
    {{-- Toast Notifications --}}

    {{-- Success --}}
    @if (session('success'))
        <div id="toast" class="flex toast toast-end">
            <div class="alert">
                <span class="flex items-center justify-center gap-2"><svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10B981"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    {{ session('success') }}
                </span>
            </div>
        </div>

        {{-- Info --}}
    @elseif (session('status'))
        <div id="toast" class="flex toast toast-end">
            <div class="alert">
                <span class="flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="#4A90E2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    {{ session('status') }}
                </span>
            </div>
        </div>

        {{-- Warning --}}
    @elseif (session('warning'))
        <div id="toast" class="flex toast toast-end">
            <div class="alert">
                <span class="flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="#FFA500" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                        </path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                    {{ session('warning') }}
                </span>
            </div>
        </div>

        {{-- Error --}}
    @elseif (session('error'))
        <div id="toast" class="flex toast toast-end">
            <div class="alert">
                <span class="flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="#EF4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    {{ session('error') }}
                </span>
            </div>
        </div>
    @endif

    <main class="flex-grow">
        @include('components.admin-sidebar')
    </main>
    <script>
        function showToast() {
            const toast = document.getElementById('toast');
            toast.style.display = 'flex';
            setTimeout(hideToast, 5000); // Hide after 5 seconds
        }

        function hideToast() {
            const toast = document.getElementById('toast');
            toast.style.display = 'none';
        }

        // Call showToast if there is a status in the session
        document.addEventListener("DOMContentLoaded", function() {
            if ("{{ session('success') }}") {
                showToast();
            }
        })
    </script>
</body>
@include('components.footer')

</html>
