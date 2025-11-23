@props([
    'name',
    'label',
    'value' => '',
    'accept' => null,
    'required' => false,
    'help' => null,
    'multiple' => false,
    'rule' => null
])

<div class="mb-4" x-data="{ fileName: '' }">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>

    <div class="flex items-center gap-3">
        <label for="{{ $name }}"
               class="cursor-pointer bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
            <x-heroicon-o-cloud-arrow-up class="w-5 h-5 inline ml-1" />
            انتخاب فایل
        </label>

        <span x-text="fileName || 'هیچ فایلی انتخاب نشده'"
              class="text-sm text-gray-500 dark:text-gray-400 flex-1"></span>
    </div>

    <input
        type="file"
        name="{{ $name }}"
        id="{{ $name }}"
        class="hidden"
        @if($accept) accept="{{ $accept }}" @endif
        @if($required) required @endif
        @if($multiple) multiple @endif

        x-on:change="fileName = $event.target.files[0]?.name || ''"

        @isset($rule)
            x-data
            x-init="$el.dataset.rules = @js($rule)"
            data-rules
        @endisset

        {{ $attributes }}
    >

    {{-- نمایش لیست rule‌ها --}}
    @isset($rule)
        <div x-data="ruleViewer($el.previousElementSibling)" class="mt-2">
            <template x-for="rule in rules">
                <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>
                    <span x-text="rule"></span>
                </div>
            </template>
        </div>
    @endisset

    @if($help)
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $help }}</p>
    @endif

    @error($name)
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
