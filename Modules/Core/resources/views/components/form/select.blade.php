<div
    x-data="{{ $rule }}"
    class="mb-6"
>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>

    <select
        data-rules="{{ $rule }}"
        name="{{ $name }}{{ $multiple ? '[]' : '' }}"
        id="{{ $name }}"
        @if($multiple) multiple @endif
        @if($required) required @endif
        {{ $attributes->merge([
            'class' => 'mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md p-3 dark:bg-gray-800 dark:text-white ' . ($errors->has($name) ? 'border-red-500' : '')
        ]) }}
    >
        @foreach($options as $value => $text)
            <option value="{{ $value }}"
                @if($multiple)
                    {{ in_array($value, old($name, $selected)) ? 'selected' : '' }}
                @else
                    {{ old($name, $selected) == $value ? 'selected' : '' }}
                @endif
            >
                {{ $text }}
            </option>
        @endforeach
    </select>

    <!-- نمایش لیست شروط -->
    <ul class="mt-2 text-sm text-gray-500 dark:text-gray-400 space-y-1">
        <template x-for="item in parsed">
            <li x-text="item"></li>
        </template>
    </ul>

    @error($name)
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
