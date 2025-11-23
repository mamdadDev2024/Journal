@props([
    'size' => 'w-6 h-6',
    'color' => 'text-blue-600',
    'border' => 'border-b-2',
    'additionalClass' => ''
])

<div class="animate-spin rounded-full {{ $size }} {{ $border }} {{ $color }} {{ $additionalClass }}"></div>
