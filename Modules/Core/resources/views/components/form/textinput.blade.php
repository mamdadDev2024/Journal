<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-white">{{ $label }}</label>
    <div class="mt-1">
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            wire:model.lazy="{{ $wire }}"
            id="{{ $name }}"
            class="transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 px-3 py-2 text-white bg-slate-700 rounded-lg w-full placeholder-gray-300"
            placeholder="{{ $placeholder }}"
            value="{{ old($name) }}"
            required
        >
    </div>
    @error($name)
    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
    @enderror
</div>
