<div class="max-w-md mx-auto mt-12">
    <h2 class="text-2xl font-bold mb-4">Login</h2>

    <form wire:submit.prevent="login">
        @csrf

        <div class="mb-4">
            <label>Email</label>
            <input type="email" wire:model.lazy="email" class="w-full border p-2">
            @error('email') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label>Password</label>
            <input type="password" wire:model.lazy="password" class="w-full border p-2">
            @error('password') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Login</button>
    </form>
</div>
