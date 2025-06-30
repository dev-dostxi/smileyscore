<div class="max-w-md mx-auto mt-12 bg-white dark:bg-gray-900 p-6 rounded-xl shadow-md ring-1 ring-gray-300 dark:ring-gray-700">
    <div class="text-center">
        <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900 dark:text-gray-200">
            Sign In
        </h2>
    </div>

    @if (session()->has('status'))
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit.prevent="login">
        @csrf

        <div class="mt-6">
            <label for="email" class="block text-sm font-medium text-blue-700 dark:text-blue-300">Email</label>
            <input
                id="email"
                type="email"
                wire:model="email"
                required
                autofocus
                autocomplete="email"
                class="mt-1 py-2 px-4 block w-full rounded-md border-0 text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-800 sm:text-sm dark:bg-gray-800 dark:text-gray-200 dark:ring-gray-600 dark:placeholder-gray-400"
            >
            @error('email') <span class="text-red-600 text-xs font-semibold">{{ $message }}</span> @enderror
        </div>

        <div class="mt-6" x-data="{ show: false }">
            <label for="password" class="block text-sm font-medium text-blue-700 dark:text-blue-300">Password</label>
            <div class="relative">
                <input
                    :type="show ? 'text' : 'password'"
                    id="password"
                    wire:model="password"
                    required
                    autocomplete="current-password"
                    class="mt-1 py-2 px-4 block w-full rounded-md border-0 text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-800 sm:text-sm dark:bg-gray-800 dark:text-gray-200 dark:ring-gray-600 dark:placeholder-gray-400"
                >
                <button
                    type="button"
                    @click="show = !show"
                    class="absolute inset-y-0 right-0 px-3 flex items-center text-blue-600 dark:text-blue-300"
                    :aria-label="show ? 'Hide password' : 'Show password'"
                >
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                    </svg>
                </button>
            </div>
            @error('password') <span class="text-red-600 text-xs font-semibold">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4 flex items-center">
            <input type="checkbox" id="remember_me" wire:model="remember"
                   class="text-blue-600 dark:bg-gray-800 dark:border-gray-600 dark:ring-offset-gray-900 focus:ring-blue-500 rounded" />
            <label for="remember_me" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Remember me</label>
        </div>

        <div class="mt-6">
            <button type="submit"
                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Log In
            </button>
        </div>
    </form>
</div>
