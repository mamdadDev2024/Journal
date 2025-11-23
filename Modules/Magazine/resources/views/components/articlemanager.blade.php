@props([
    'articles' => [],
    'maxArticles' => 10
])

<div x-data="{
    articleCount: {{ count($articles) ?: 1 }},
    maxArticles: {{ $maxArticles }},

    addArticle() {
        if (this.articleCount >= this.maxArticles) {
            alert(`حداکثر ${this.maxArticles} مقاله می‌توانید اضافه کنید`);
            return;
        }

        const container = this.$refs.articlesContainer;
        const newIndex = this.articleCount;

        // ایجاد فرم مقاله جدید
        const newForm = this.createArticleForm(newIndex);
        container.appendChild(newForm);

        this.articleCount++;
    },

    createArticleForm(index) {
        const div = document.createElement('div');
        div.className = 'article-form border rounded-md p-4 mb-4 bg-gray-100 dark:bg-gray-800 dark:border-gray-700';
        div.innerHTML = `
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        مقاله شماره ${index + 1}
                    </h3>
                    <button type="button"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition-colors"
                            onclick="this.closest('.article-form').remove(); document.dispatchEvent(new CustomEvent('article-removed'))">
                        <x-heroicon-o-trash class="w-4 h-4 inline ml-1" />
                        حذف
                    </button>
                </div>

                <input type="hidden" name="articles[${index}][id]" value="">

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">عنوان مقاله</label>
                            <input type="text" name="articles[${index}][title]"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 dark:bg-gray-700 dark:text-white"
                                placeholder="عنوان مقاله" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">نویسنده</label>
                            <input type="text" name="articles[${index}][author]"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 dark:bg-gray-700 dark:text-white"
                                placeholder="نام نویسنده" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">فایل مقاله</label>
                        <input type="file" name="articles[${index}][addOn]"
                            accept=".pdf,.docx"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 dark:bg-gray-700 dark:text-white"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">چکیده</label>
                        <textarea name="articles[${index}][abstract]"
                                rows="3"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 dark:bg-gray-700 dark:text-white"
                                placeholder="چکیده مقاله" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">متن کامل</label>
                        <textarea name="articles[${index}][body]"
                                rows="6"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 dark:bg-gray-700 dark:text-white"
                                placeholder="متن کامل مقاله" required></textarea>
                    </div>
                </div>
            `;
            return div;
        }
    }">
    <div x-ref="articlesContainer" class="space-y-4">
        @if(count($articles))
            @foreach($articles as $index => $article)
                <x-magazine::article-form
                    :index="$index"
                    :article="$article"
                    :showRemoveButton="$index > 0"
                />
            @endforeach
        @else
            <x-magazine::article-form :index="0" :showRemoveButton="false" />
        @endif
    </div>

    <x-core::form.button
        type="button"
        variant="secondary"
        class="mt-4"
        @click="addArticle()"
        x-bind:disabled="articleCount >= maxArticles"
    >
        <x-heroicon-o-plus class="w-4 h-4 inline ml-1" />
        افزودن مقاله جدید
        <span x-text="`(${articleCount}/${maxArticles})`" class="text-xs mr-2"></span>
    </x-core::form.button>
</div>
