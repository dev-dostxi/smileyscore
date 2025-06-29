<div class="max-w-md mx-auto mt-16 p-6 border rounded shadow">
    <h1 class="text-xl font-semibold mb-4">Rate a Section</h1>

    <div class="mb-4">
        <label class="block mb-1 text-sm font-medium">Select Section:</label>
        <select wire:model.live="selectedSection" class="w-full border rounded p-2">
            <option value="">-- Choose a Section --</option>
            @foreach ($sections as $section)
                <option value="{{ $section->id }}">{{ $section->name }}</option>
            @endforeach
        </select>
    </div>

    <button wire:click="rate" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" @disabled(!$selectedSection)>
        Rate
    </button>
</div>
