@props(['filePath', 'label' => 'دانلود فایل'])

@if($filePath)
    <a
        href="{{ Storage::url($filePath) }}"
        target="_blank"
        class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full text-sm hover:bg-blue-200 transition-colors"
    >
        <x-heroicon-o-arrow-down-tray class="w-4 h-4 ml-1" />
        {{ $label }}
    </a>
@else
    <span class="text-sm text-gray-500 dark:text-gray-400">بدون فایل</span>
@endif
