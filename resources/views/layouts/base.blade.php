<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@include('components.menu')


<body class="bg-white flex flex-col min-h-screen">
    <main class="flex-grow">
        @yield('content')
    </main>
</body>
@include("components.footer")
</html>