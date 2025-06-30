<div class="flex items-center justify-center min-h-[calc(100vh-6rem)] px-4">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg ring-1 ring-gray-300 dark:ring-gray-700">
        <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">
            Rate a Section
        </h1>

        <div class="mb-6">
            <label class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">
                Select Section
            </label>
            <select wire:model.live="selectedSection" class="w-full text-base px-4 py-3 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-600">
                <option value="">Choose a Section</option>
                @foreach ($sections as $section)
                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            </select>
        </div>

        <button wire:click="rate"
                class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                @disabled(!$selectedSection)>
            Rate
        </button>
    </div>
</div>
