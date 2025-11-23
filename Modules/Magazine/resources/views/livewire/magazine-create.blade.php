<div class="container mx-auto px-4 py-8" data-aos="fade-up">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">ایجاد نشریه جدید</h1>

    <form wire:submit="save" enctype="multipart/form-data" class="space-y-6">
        {{-- عنوان --}}
        <x-core::form.text-input
            name="title"
            label="عنوان نشریه"
            placeholder="عنوان نشریه را وارد کنید"
            required
            :rule="$rules['title']"
            :error="$errors->first('title')"
        />

        {{-- توضیحات --}}
        <x-core::form.textarea
            name="desc"
            label="توضیحات نشریه"
            placeholder="توضیحات نشریه را وارد کنید"
            rows="3"
            required
            :error="$errors->first('desc')"
        />

        {{-- تصویر نشریه --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                تصویر نشریه (JPEG یا JPG)
            </label>
            <input
                type="file"
                wire:model="image"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300"
                accept=".jpg,.jpeg,.png"
            >
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            @if ($image)
                <p class="mt-1 text-sm text-gray-500">فایل انتخاب شده: {{ $image->getClientOriginalName() }}</p>
            @endif
        </div>

        {{-- فایل PDF/DOCX --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                فایل نشریه (PDF یا DOCX)
            </label>
            <input
                type="file"
                wire:model="addOn"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 dark:file:bg-green-900 dark:file:text-green-300"
                accept=".pdf,.docx"
            >
            @error('addOn') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            @if ($addOn)
                <p class="mt-1 text-sm text-gray-500">فایل انتخاب شده: {{ $addOn->getClientOriginalName() }}</p>
            @endif
        </div>

        {{-- دسته‌بندی‌ها --}}
        <x-core::form.select
            name="categories"
            label="دسته‌بندی‌ها"
            :options="$categoryOptions"
            multiple
            required
            :error="$errors->first('categories')"
        />

        {{-- مقالات --}}
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">مقالات</h3>

            @foreach($articles as $index => $article)
                <div class="border rounded-lg p-4 bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-medium text-gray-800 dark:text-white">مقاله شماره {{ $index + 1 }}</h4>
                        @if($index > 0)
                            <button
                                type="button"
                                wire:click="removeArticle({{ $index }})"
                                class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300"
                            >
                                <x-heroicon-o-trash class="w-5 h-5" />
                            </button>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        {{-- عنوان مقاله --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                عنوان مقاله
                            </label>
                            <input
                                type="text"
                                wire:model="articles.{{ $index }}.title"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 dark:bg-gray-700 dark:text-white"
                                placeholder="عنوان مقاله"
                            >
                            @error("articles.{$index}.title")
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- نویسنده مقاله --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                نویسنده مقاله
                            </label>
                            <input
                                type="text"
                                wire:model="articles.{{ $index }}.author"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 dark:bg-gray-700 dark:text-white"
                                placeholder="نویسنده مقاله"
                            >
                            @error("articles.{$index}.author")
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- فایل مقاله --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            فایل مقاله
                        </label>
                        <input
                            type="file"
                            wire:model="articles.{{ $index }}.addOn"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 dark:bg-gray-700"
                            accept=".pdf,.docx"
                        >
                        @error("articles.{$index}.addOn")
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        @if ($articles[$index]['addOn'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                            <p class="mt-1 text-sm text-gray-500">فایل انتخاب شده: {{ $articles[$index]['addOn']->getClientOriginalName() }}</p>
                        @endif
                    </div>

                    {{-- چکیده مقاله --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            چکیده مقاله
                        </label>
                        <textarea
                            wire:model="articles.{{ $index }}.abstract"
                            rows="3"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 dark:bg-gray-700 dark:text-white"
                            placeholder="چکیده مقاله"
                        ></textarea>
                        @error("articles.{$index}.abstract")
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- متن مقاله --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            متن مقاله
                        </label>
                        <textarea
                            wire:model="articles.{{ $index }}.body"
                            rows="6"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 dark:bg-gray-700 dark:text-white"
                            placeholder="متن مقاله"
                        ></textarea>
                        @error("articles.{$index }.body")
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endforeach

            <button
                type="button"
                wire:click="addArticle"
                class="flex items-center gap-2 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
            >
                <x-heroicon-o-plus class="w-5 h-5" />
                افزودن مقاله جدید
            </button>
        </div>

        {{-- دکمه ثبت --}}
        <div class="flex gap-4 pt-6">
            <x-core::form.button
                type="submit"
                variant="primary"
                class="flex-1"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove wire:target="save">ثبت نشریه</span>
                <span wire:loading wire:target="save" class="flex items-center gap-2">
                    <x-loader size="w-4 h-4" />
                    در حال ثبت...
                </span>
            </x-core::form.button>

            <x-core::form.button
                type="button"
                variant="secondary"
                onclick="window.history.back()"
            >
                انصراف
            </x-core::form.button>
        </div>
    </form>

    {{-- Loading Overlay --}}
    <x-overlay wire:loading.flex />
</div>
