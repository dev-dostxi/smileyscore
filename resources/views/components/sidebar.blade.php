<aside class="bg-white dark:bg-gray-900 w-64 px-2 h-full border-r border-gray-200 dark:border-gray-700
              fixed z-40 top-0 left-0 transform lg:translate-x-0 transition-transform duration-300 ease-in-out"
       :class="{ '-translate-x-full': !sidebarOpen }"
       x-cloak>
       <div class="flex justify-center mt-8">
        <x-application-logo class="h-8 w-auto" />
    </div>

    <nav class="mt-8 space-y-6 text-sm font-medium text-gray-700 dark:text-gray-200">
        <div class="space-y-1">
            <label class="px-3 text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Home</label>
            <a href="{{ url('dashboard') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-md transition-colors
               {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-800 dark:bg-blue-500 dark:text-white' : 'hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-800 dark:hover:text-white' }}">
                <span>Dashboard</span>
            </a>
        </div>

        <div x-data="{ open: true }" class="space-y-1">
            <label class="px-3 text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Results</label>
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-3 py-2 rounded-md transition-colors hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-800 dark:hover:text-white">
                <span class="flex items-center gap-2">
                    <span>Sections</span>
                </span>
                <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>

            <div x-show="open" x-cloak class="space-y-1 ml-6">
                @foreach ($sections as $section)
                    <a href="{{ url('results') . '?section=' . $section->slug }}"
                       class="block px-3 py-2 rounded-md transition-colors text-gray-600 dark:text-gray-300 hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-800 dark:hover:text-white">
                        {{ strtoupper($section->name) }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="space-y-1">
            <label class="px-3 text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Reports</label>
            <a href="{{ url('statistics') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-md transition-colors
               {{ request()->routeIs('statistics.index') ? 'bg-blue-100 text-blue-800 dark:bg-blue-500 dark:text-white' : 'hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-800 dark:hover:text-white' }}">
                <span>Statistics</span>
            </a>
        </div>

        <div class="mt-10 border-t border-gray-200 dark:border-gray-700 pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center px-3 py-2 rounded-lg text-left text-gray-600 dark:text-blue-300 hover:bg-red-100 hover:text-red-800 dark:hover:bg-red-500 dark:hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                    </svg>
                    <span class="text-sm font-medium mr-4">Logout</span>
                </button>
            </form>
        </div>
    </nav>
</aside>
