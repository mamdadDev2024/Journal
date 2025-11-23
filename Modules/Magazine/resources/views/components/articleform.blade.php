@props([
    'index' => 0,
    'article' => null,
    'showRemoveButton' => true
])

<div class="article-form border rounded-md p-4 mb-4 bg-gray-100 dark:bg-gray-800 dark:border-gray-700"
     data-index="{{ $index }}"
     x-data="{ articleIndex: {{ $index }} }"
>
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
            مقاله شماره <span x-text="articleIndex + 1"></span>
        </h3>

        @if($showRemoveButton)
            <x-core::form.button
                type="button"
                variant="danger"
                size="small"
                class="remove-article"
                @click="removeArticle($el)"
            >
                <x-heroicon-o-trash class="w-4 h-4" />
                حذف
            </x-core::form.button>
        @endif
    </div>

    <input type="hidden" name="articles[{{ $index }}][id]" value="{{ $article['id'] ?? '' }}">

    {{-- عنوان مقاله --}}
    <x-core::form.text-input
        name="articles[{{ $index }}][title]"
        label="عنوان مقاله"
        value="{{ $article['title'] ?? '' }}"
        placeholder="عنوان مقاله را وارد کنید"
        required
        class="mb-4"
    />

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        {{-- نویسنده مقاله --}}
        <x-core::form.text-input
            name="articles[{{ $index }}][author]"
            label="نویسنده مقاله"
            value="{{ $article['author'] ?? '' }}"
            placeholder="نام نویسنده"
            required
        />

        {{-- فایل مقاله --}}
        <x-core::form.file-input
            name="articles[{{ $index }}][addOn]"
            label="فایل مقاله"
            accept=".pdf,.docx"
            help="فایل‌های PDF و DOCX قابل قبول هستند"
            required
        />
    </div>

    {{-- چکیده مقاله --}}
    <x-core::form.textarea
        name="articles[{{ $index }}][abstract]"
        label="چکیده مقاله"
        placeholder="چکیده مقاله را وارد کنید..."
        rows="3"
        value="{{ $article['abstract'] ?? '' }}"
        class="mb-4"
        required
    />

    {{-- متن کامل مقاله --}}
    <x-core::form.textarea
        name="articles[{{ $index }}][body]"
        label="متن کامل مقاله"
        placeholder="متن کامل مقاله را وارد کنید..."
        rows="6"
        value="{{ $article['body'] ?? '' }}"
        required
    />
</div>

@push('scripts')
<script>
function removeArticle(button) {
    const articleForm = button.closest('.article-form');
    articleForm.remove();

    // بازسازی ایندکس‌ها
    rebuildArticleIndexes();
}

function rebuildArticleIndexes() {
    const articleForms = document.querySelectorAll('.article-form');

    articleForms.forEach((form, newIndex) => {
        const oldIndex = form.dataset.index;
        form.dataset.index = newIndex;

        const title = form.querySelector('h3 span');
        if (title) {
            title.textContent = newIndex + 1;
        }

        updateFieldNames(form, oldIndex, newIndex);
    });
}

function updateFieldNames(form, oldIndex, newIndex) {
    const fields = form.querySelectorAll('[name]');

    fields.forEach(field => {
        const name = field.getAttribute('name');
        if (name && name.includes(`articles[${oldIndex}]`)) {
            const newName = name.replace(
                `articles[${oldIndex}]`,
                `articles[${newIndex}]`
            );
            field.setAttribute('name', newName);
        }
    });
}

// برای استفاده در Alpine.js
document.addEventListener('alpine:init', () => {
    Alpine.data('articleForm', (index) => ({
        articleIndex: index,

        init() {
            this.$watch('articleIndex', (value) => {
                this.updateFieldNames(value);
            });
        },

        updateFieldNames(newIndex) {
            const fields = this.$el.querySelectorAll('[name]');
            const oldIndex = this.articleIndex;

            fields.forEach(field => {
                const name = field.getAttribute('name');
                if (name && name.includes(`articles[${oldIndex}]`)) {
                    const newName = name.replace(
                        `articles[${oldIndex}]`,
                        `articles[${newIndex}]`
                    );
                    field.setAttribute('name', newName);
                }
            });
        }
    }));
});
</script>
@endpush
