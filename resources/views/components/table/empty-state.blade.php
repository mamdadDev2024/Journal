@props(['colspan', 'message' => 'محتوایی یافت نشد'])

<tr>
    <td colspan="{{ $colspan }}" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
        <x-heroicon-o-document-magnifying-glass class="w-12 h-12 mx-auto mb-4 text-gray-400" />
        <p class="text-lg">{{ $message }}</p>
    </td>
</tr>
