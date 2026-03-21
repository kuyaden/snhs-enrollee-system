<div class="space-y-4">
    <form wire:submit.prevent="import" class="space-y-4">
        <input type="file" wire:model="file" accept=".xlsx, .xls"
            class="block w-full text-sm border rounded cursor-pointer" />

        @error('file') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

        <div wire:loading wire:target="import" class="text-sm text-gray-500">
            Importing... please wait.
        </div>

        <flux:button type="submit" variant="primary" class="w-full" wire:loading.attr="disabled">
            Import Excel
        </flux:button>
    </form>

    @if (session()->has('success'))
        <div class="text-sm text-green-600">{{ session('success') }}</div>
    @endif
</div>
