<div class="container mx-auto p-4" wire:init="render">

    {{-- Search Form --}}
    <div class="flex flex-col lg:flex-row items-center mx-auto w-full max-w-lg
                space-y-2 lg:space-y-0 lg:space-x-2">

        {{-- Search Input --}}
        <input type="text"
               wire:model.debounce.400ms="search"
               class="rounded lg:rounded-l-none px-3 py-2 w-full lg:w-64
                      focus:outline-none dark:bg-teal-700 dark:text-gray-200
                      bg-gray-200 text-gray-700 focus:ring-2 ring-blue-400 transition-all"
               placeholder="جست‌وجو...">

        <select wire:model="type"
                class="w-full lg:w-auto px-3 py-2 bg-amber-500 text-white hover:bg-amber-600
                       focus:outline-none dark:bg-amber-600 dark:hover:bg-amber-500 transition-all">

            @php
                $types = [
                    "همه"        => "all",
                    "نشریات"    => "Magazine",
                    "نکات"      => "Tip",
                    "مقالات"    => "Article",
                    "رویداد ها" => "Activity",
                ];
            @endphp

            @foreach($types as $title => $value)
                <option value="{{ $value }}">{{ $title }}</option>
            @endforeach

        </select>
    </div>

    <h1 class="text-2xl font-semibold mb-4 text-center mt-5">نتایج جست‌وجو</h1>

    {{-- Loading Skeleton --}}
    <div wire:loading class="text-center py-10 text-gray-500 dark:text-gray-300">
        در حال جستجو...
    </div>

    {{-- Results --}}
    <div wire:loading.remove>

        @if($results->count() === 0)
            <p class="text-center text-gray-600 dark:text-gray-400">هیچ محتوایی پیدا نشد.</p>
        @else

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($results as $item)
                    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">

                        {{-- Image --}}
                        @if($item->image_url)
                            <img src="{{ $item->image_url }}"
                                 alt="{{ $item->title }}"
                                 class="w-full h-48 object-cover rounded mb-4">
                        @else
                            <div class="w-full h-48 bg-gray-300 dark:bg-gray-700 rounded mb-4
                                        flex items-center justify-center">
                                <span class="text-gray-600 dark:text-gray-300 text-sm">بدون تصویر</span>
                            </div>
                        @endif

                        {{-- Title --}}
                        <h2 class="text-lg font-semibold mb-2">{{ $item->title }}</h2>

                        {{-- Category + Type --}}
                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                            دسته‌بندی: {{ $item->categories->first()->name ?? 'بدون دسته' }}
                            | نوع: {{ $item->type_word }}
                        </div>

                        {{-- Body --}}
                        <p class="text-gray-700 dark:text-gray-300">
                            {{ Str::limit($item->body ?? '...', 100) }}
                        </p>

                        {{-- Link --}}
                        <a href="{{ route($item->route_name, $item->slug) }}"
                           class="text-blue-500 dark:text-blue-400 hover:underline mt-4 block">
                            بیشتر
                        </a>

                    </div>
                @endforeach

                {{-- Pagination --}}
                <div class="col-span-full flex justify-center mt-6">
                    {{ $results->links() }}
                </div>
            </div>

        @endif

    </div>
</div>
