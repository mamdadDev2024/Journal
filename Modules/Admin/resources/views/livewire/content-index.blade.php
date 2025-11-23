<section class="p-4 sm:p-6 rounded-lg shadow-md border border-slate-300 bg-white dark:bg-gray-800 dark:border-gray-700 m-2 sm:m-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-100">لیست محتواها</h1>
    </div>

    <div class="container mx-auto mb-8">
        <h3 class="font-semibold text-lg sm:text-xl mb-3 text-gray-700 dark:text-gray-200">نشریات</h3>
        <x-content-table
            :items="$magazines"
            title="نشریات"
            :deleteRoute="'magazine.delete'"
            :editRoute="'magazine.edit'"
            :showImage="true"
            :showBody="false"
            :showFiles="false"
        />

    </div>

    <div class="container mx-auto mb-8">
        <h3 class="font-semibold text-lg sm:text-xl mb-3 text-gray-700 dark:text-gray-200">رویدادها</h3>
        <x-content-table
            :items="$tips"
            title="رویدادها"
            :editRoute="'tip.edit'"
            :deleteRoute="'tip.delete'"
            :showImage="true"
            :showBody="true"
            :showFiles="false"
        />
    </div>

    <div class="container mx-auto mb-8">
        <h3 class="font-semibold text-lg sm:text-xl mb-3 text-gray-700 dark:text-gray-200">اخبار</h3>
        <x-content-table
            :items="$activities"
            title="اخبار"
            :editRoute="'activity.edit'"
            :deleteRoute="'activity.delete'"
            :showImage="true"
            :showBody="true"
            :showFiles="false"
        />
    </div>

    <div class="container mx-auto mb-8">
        <h3 class="font-semibold text-lg sm:text-xl mb-3 text-gray-700 dark:text-gray-200">مقالات ارسالی</h3>
        <x-content-table
            :items="$recommends"
            title="مقالات ارسالی"
            :deleteRoute="'core.recommend.delete'"
            :showImage="false"
            :showBody="false"
            :showFiles="true"
        />
    </div>
</section>
