<main class="w-full transition-all flex flex-col gap-8">

    <section class="mx-4">
        <a href="{{ route('activity.index') }}" class="text-4xl font-bold hover:text-blue-600 dark:text-white block mb-4 text-center">رویدادها</a>
        <div class="rounded-xl p-4 bg-blue-300 dark:bg-darkPrimary shadow-lg">
            @if($activities->isNotEmpty())
                <livewire:slider :items="$activities" type="" defaultLink="{{ route('activity.index') }}" containerClass="activity-swiper-container" />
            @else
                <p class="text-center text-gray-500 dark:text-gray-400">رویدادی موجود نیست</p>
            @endif
        </div>
    </section>

    <section class="mx-4">
        <a href="{{ route('tip.index') }}" class="text-4xl font-bold hover:text-blue-600 dark:text-white block mb-4 text-center">نکات</a>
        <div class="rounded-xl p-4 bg-blue-300 dark:bg-darkPrimary shadow-lg">
            @if($tips->isNotEmpty())
                <livewire:slider :items="$tips" type="Event" defaultLink="{{ route('tip.index') }}" containerClass="tip-swiper-container" />
            @else
                <p class="text-center text-gray-500 dark:text-gray-400">نکته ای موجود نیست</p>
            @endif
        </div>
    </section>

    <section class="mx-4">
        <a href="{{ route('magazine.index') }}" class="text-4xl font-bold hover:text-blue-600 dark:text-white block mb-4 text-center">نشریات</a>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">

            <div class="relative rounded-xl p-6 flex flex-col lg:col-span-4 lg:flex-row bg-blue-300 dark:bg-darkPrimary items-center shadow-lg">
                @if(isset($magazines) && $magazines->isNotEmpty())
                    <livewire:slider :items="$magazines" type="Magazine" defaultLink="{{ route('magazine.index') }}" containerClass="magazine-swiper-container" />
                @else
                    <p class="text-center text-gray-500 dark:text-gray-400 w-full">نشریه‌ای موجود نیست</p>
                @endif
            </div>

            <div class="p-4 dark:text-white rounded-xl bg-gray-400 dark:bg-slate-700 shadow-lg">
                <h3 class="text-xl font-bold mb-3">راهنمایی</h3>
                <p class="text-sm">
                    {{ $sections['magazineGuide']['content'] ?? 'راهنمایی موجود نیست' }}
                </p>
            </div>
        </div>
    </section>

</main>
