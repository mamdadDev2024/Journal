@props([
    'background' => 'bg-gray-800 bg-opacity-50',
    'zIndex' => 'z-50',
    'spinnerSize' => 'w-8 h-8',
    'spinnerColor' => 'text-white',
    'message' => null
])

<div
    wire:loading.class.remove="hidden"
    class="hidden fixed inset-0 {{ $background }} flex items-center justify-center {{ $zIndex }}"
>
    <div class="text-center">
        <x-loader
            :size="$spinnerSize"
            :color="$spinnerColor"
            :border="'border-b-2'"
        />
        @if($message)
            <p class="mt-2 text-white text-sm">{{ $message }}</p>
        @endif
    </div>
</div>
