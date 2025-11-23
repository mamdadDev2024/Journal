@props(['image', 'alt', 'size' => 'w-12 h-12'])

<td class="px-4 py-3 whitespace-nowrap">
    @if($image)
        <img
            src="{{ Storage::url($image) }}"
            alt="{{ $alt }}"
            class="{{ $size }} object-cover rounded-lg"
        >
    @else
        <div class="{{ $size }} bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center">
            <x-heroicon-o-photo class="w-6 h-6 text-gray-400" />
        </div>
    @endif
</td>
