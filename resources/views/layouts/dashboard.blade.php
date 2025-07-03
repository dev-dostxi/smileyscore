<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }"
      :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <link rel="icon" href="{{ asset('/favicon1.ico') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased dark:bg-gray-800" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">

        <aside
            class="z-40 w-64 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700
                   transform transition-transform duration-300 ease-in-out
                   fixed inset-y-0 left-0 lg:static lg:translate-x-0"
            :class="{ '-translate-x-full': !sidebarOpen }"
            x-cloak>
            <x-sidebar :sections="auth()->user()->sections" />
        </aside>

        <div x-show="sidebarOpen"
             class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"
             @click="sidebarOpen = false"
             x-cloak></div>

        <div class="flex-1 flex flex-col overflow-y-auto overflow-x-hidden relative">

            <div class="flex items-center justify-between p-4 bg-blue-50 dark:bg-gray-800">
                <div class="lg:hidden p-4">
                    <button @click="sidebarOpen = true"
                            class="p-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white rounded-md shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 6.75h15m-15 5.25h15m-15 5.25h15"/>
                        </svg>
                    </button>
                </div>
                <div class="ml-auto">
                    <div class="relative ml-auto mr-2 mt-2">
                        <button aria-label="Toggle Dark Mode" onclick="toggleDarkMode()" class="p-2 rounded-full text-gray-600 dark:text-gray-200 bg-blue-200 dark:bg-gray-700">
                            <svg id="light-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 hidden dark:block">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                            </svg>
                            <svg id="dark-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 dark:hidden">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <main class="grow flex justify-center p-2 bg-blue-50 dark:bg-gray-800">
                <div class="w-full transition-all duration-700 mb-24">
                        
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    @stack('modals')
    @livewireScripts
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
<script>
function toggleDarkMode() {
    document.documentElement.classList.toggle('dark');
    localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
}

if (localStorage.getItem('theme') === 'dark') {
    document.documentElement.classList.add('dark');
}
</script>