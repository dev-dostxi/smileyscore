<div class="max-w-5xl mx-auto space-y-6 p-4">
    <div class="flex gap-4 items-end mb-4">
        <div>
            <label class="block text-sm text-gray-600 dark:text-gray-300">Start Date</label>
            <input type="date" wire:model="startDate" class="rounded-md text-sm px-1 border-gray-300 dark:bg-gray-800 dark:text-white">
        </div>
        <div>
            <label class="block text-sm text-gray-600 dark:text-gray-300 ">End Date</label>
            <input type="date" wire:model="endDate" class="rounded-md text-sm px-1 border-gray-300 dark:bg-gray-800 dark:text-white">
        </div>
        <div>
            <button wire:click="applyFilters" class="px-2 py-1 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Filter
            </button>
        </div>
    </div>

    @if ($startDate || $endDate)
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-300">
            Showing results 
            @if ($startDate) from <strong>{{ $this->formattedStartDate }}</strong> @endif
            @if ($startDate && $endDate) to @endif
            @if ($endDate) <strong>{{ $this->formattedEndDate }}</strong> @endif
        </div>
    @endif

    @if ($section)
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white uppercase">
                    {{ $section }}
                </h3>
            </div>

            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($ratings as $rating)
                    <li class="px-6 py-4 text-gray-700 dark:text-gray-300">
                        <div class="flex justify-between items-center mb-1">
                            <span class="font-medium text-blue-600 dark:text-blue-400">Rating: {{ $rating->rating }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $rating->created_at->format('M d, Y') }}</span>
                        </div>

                        @if ($rating->nickname)
                            <div class="text-sm text-gray-600 dark:text-gray-400 italic">
                                Nickname: {{ $rating->nickname }}
                            </div>
                        @endif

                        @if ($rating->comment)
                            <div class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                                “{{ $rating->comment }}”
                            </div>
                        @endif
                    </li>
                @empty
                    <li class="px-6 py-3 text-gray-500 italic dark:text-gray-400">
                        No ratings yet.
                    </li>
                @endforelse
            </ul>

            <div class="px-6 py-4">
                {{ $ratings->links() }}
            </div>
        </div>
    @else
        <div class="p-4 bg-yellow-50 border border-yellow-300 text-yellow-800 rounded-lg text-sm dark:bg-yellow-200 dark:text-yellow-900 dark:border-yellow-400">
            No section selected or assigned.
        </div>
    @endif
</div>
