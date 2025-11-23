@props(['title', 'count'])

<div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $title }}</h4>
    @if($count)
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            تعداد: {{ $count }}
        </p>
    @endif
</div>
