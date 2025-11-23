@props(['editRoute', 'deleteRoute', 'itemId', 'viewRoute' => null])

<div class="flex items-center gap-2">
    {{-- Edit Button --}}
    @if($editRoute)
        <a
            href="{{ route($editRoute, $itemId) }}"
            class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 transition-colors"
            title="ویرایش"
        >
            <x-heroicon-o-pencil-square class="w-5 h-5" />
        </a>
    @endif

    {{-- Delete Button --}}
    @if($deleteRoute)
        <form
            action="{{ route($deleteRoute, $itemId) }}"
            method="POST"
            class="inline"
            onsubmit="return confirm('آیا از حذف این آیتم اطمینان دارید؟')"
        >
            @csrf
            @method('DELETE')
            <button
                type="submit"
                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition-colors"
                title="حذف"
            >
                <x-heroicon-o-trash class="w-5 h-5" />
            </button>
        </form>
    @endif

    {{-- View Button --}}
    @if($viewRoute)
        <a
            href="{{ route($viewRoute, $itemId) }}"
            class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition-colors"
            title="مشاهده"
        >
            <x-heroicon-o-eye class="w-5 h-5" />
        </a>
    @else
        <a
            href="#"
            class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition-colors"
            title="مشاهده"
        >
            <x-heroicon-o-eye class="w-5 h-5" />
        </a>
    @endif
</div>
