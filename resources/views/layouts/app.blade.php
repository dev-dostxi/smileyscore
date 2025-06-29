<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'CSF Rating')</title>

    <!-- Inter font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">

    <style> body, html { font-family: 'Inter', sans-serif; } </style>
    
    @livewireStyles
</head>
<body>
    @yield('content')
    {{ $slot }}
    <script src="//unpkg.com/alpinejs" defer></script>
    @livewireScripts

    @stack('scripts')
</body>
</html>
