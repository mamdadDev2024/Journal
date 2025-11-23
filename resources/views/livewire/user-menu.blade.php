<div class="relative" x-data="{ open: false }">
    <button x-click="open = !open" aria-haspopup="true" aria-expanded="false" class="rounded-lg dark:bg-teal-600 bg-white text-gray-800 dark:text-gray-100 py-2 max-md:py-1 max-md:px-3 px-6 transition-all">
        منو
    </button>
    <div id="menu_section" x-show="open" class="absolute right-0 opacity-0 mt-2 w-48 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg transition-opacity duration-300 invisible">
            <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">پروفایل</a>
        @role("super admin")
            <a href="{{ route('admin.panel') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">تغییر صفحه اصلی و ابزار ها</a>
            <a href="{{ route('admin.index_users') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">کاربران</a>
        @endrole
        @role('admin|super admin')
            <a href="{{ route('admin.index_contacts') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">فرم های تماس</a>
            <a href="{{ route('writer.magazine.create') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">نوشتن نشریه</a>
            <a href="{{ route('writer.new.create') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">نوشتن خبر</a>
            <a href="{{ route('writer.event.create') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">نوشتن رویداد</a>
            <a href="{{ route('admin.index_comments') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">کامنت‌ها</a>
            <a href="{{ route('admin.index_contents') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">مدیریت محتوا ها</a>
        @endrole

        @role('user')
            <a href="{{ route('user.create') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">ارسال مقاله</a>
        @endrole

        <a href="{{ route('auth.logout') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">خروج از حساب</a>
    </div>
</div>