@props([
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'accept' => null,
    'multiple' => false,
    'error' => null,
    'rule' => null,      // مورد مهم: این همون text rule هست
])

<div class="mb-6">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        wire:model.lazy="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) required @endif
        @if($accept) accept="{{ $accept }}" @endif
        @if($multiple) multiple @endif

        {{ $attributes->merge([
            'class' =>
                'mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md p-3
                focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-white '
                . ($errors->has($name) ? 'border-red-500' : '')
        ]) }}

        x-data
        @isset($rule)
            x-init="$el.dataset.rules = @js($rule)"
            data-rules
        @endisset
    >

    @isset($rule)
        <div x-data="ruleViewer($el.previousElementSibling)" class="mt-2">
            <template x-for="rule in rules">
                <div class="text-xs text-gray-500 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>
                    <span x-text="rule"></span>
                </div>
            </template>
        </div>
    @endisset

    @error($name)
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
