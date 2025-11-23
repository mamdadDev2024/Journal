@props([
    'name',
    'label',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'rows' => 4,
    'rule' => null
])

<div class="mb-6">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) required @endif
        @isset($rule)
            data-rules="{{ $rule ?? '' }}"
        @endisset
        {{ $attributes->merge([
            'class' => 'mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md p-3 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-white ' . ($errors->has($name) ? 'border-red-500' : '')
        ]) }}
    >{{ old($name, $value) }}</textarea>

    @error($name)
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
