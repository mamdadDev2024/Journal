@props([
    'items',
    'title',
    'editRoute' => null,
    'deleteRoute' => null,
    'viewRoute' => null,
    'showImage' => false,
    'showBody' => false,
    'showFiles' => false
])

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
    {{-- Table Header --}}
    <x-table.header
        :title="$title"
        :count="$items->count() ? $items->total() : null"
    />

    {{-- Table Content --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    @if($showImage)
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">تصویر</th>
                    @endif
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">عنوان</th>
                    @if($showBody)
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">محتوا</th>
                    @endif
                    @if($showFiles)
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">فایل‌ها</th>
                    @endif
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">تاریخ ایجاد</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">عملیات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($items as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        {{-- Image Column --}}
                        @if($showImage)
                            <x-table.image-column
                                :image="$item->image"
                                :alt="$item->title"
                            />
                        @endif

                        {{-- Title Column --}}
                        <td class="px-4 py-3">
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ \Illuminate\Support\Str::limit($item->title, 50) }}
                            </div>
                        </td>

                        {{-- Body Column --}}
                        @if($showBody)
                            <td class="px-4 py-3">
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item->content ?? $item->description), 80) }}
                                </div>
                            </td>
                        @endif

                        {{-- Files Column --}}
                        @if($showFiles)
                            <td class="px-4 py-3">
                                <x-table.file-download :filePath="$item->file_path" />
                            </td>
                        @endif

                        {{-- Date Column --}}
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ \jdate($item->created_at)->format('Y/m/d') }}
                        </td>

                        {{-- Actions Column --}}
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                            <x-table.action
                                :editRoute="$editRoute"
                                :deleteRoute="$deleteRoute"
                                :viewRoute="$viewRoute"
                                :itemId="$item->id"
                            />
                        </td>
                    </tr>
                @empty
                    <x-table.empty-state
                        :colspan="($showImage ? 1 : 0) + ($showBody ? 1 : 0) + ($showFiles ? 1 : 0) + 3"
                    />
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($items->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
            {{ $items->links() }}
        </div>
    @endif
</div>
