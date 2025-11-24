<div class="w-full bg-slate-400 dark:bg-slate-500 overflow-hidden">
    @php
        // Consider moving this to controller or service
        $section = \Modules\Core\Models\Section::where("name", "titleHeader")->first();
    @endphp

    @if ($section && $section->content)
        <a href="{{ route('home') }}" class="block w-full">
            <img
                src="{{ Storage::url($section->content) }}" {{-- Use Storage::url for better asset handling --}}
                alt="Title Header"
                class="block w-full max-w-full object-cover h-16 md:h-24" {{-- Fixed height for consistency --}}
                loading="lazy" {{-- Lazy loading for better performance --}}
            >
        </a>
    @endif
</div>

<header id="header" class="max-md:flex md:px-4 max-md:px-2 py-3 z-50 bg-blue-500 dark:bg-teal-700 backdrop-blur-lg bg-opacity-95 dark:bg-opacity-50 flex justify-between items-center text-gray-800 dark:text-gray-100 transition-all duration-300 shadow-md">

    {{-- User Menu --}}
    @auth
        <div class="relative" x-data="{ show_menu: false }">
            <button
                @click="show_menu = !show_menu"
                @click.outside="show_menu = false"
                @mouseenter="if (window.innerWidth > 768) show_menu = true"
                @mouseleave="if (window.innerWidth > 768) show_menu = false"
                aria-haspopup="true"
                aria-expanded="false"
                class="rounded-lg dark:bg-teal-600 bg-white text-gray-800 dark:text-gray-100 py-2 max-md:py-1 max-md:px-3 px-4 transition-all hover:bg-gray-100 dark:hover:bg-teal-500 flex items-center gap-2"
            >
                <x-heroicon-o-bars-3 class="w-5 h-5" />
                <span>منو</span>
            </button>

            <div
                x-show="show_menu"
                @mouseenter="if (window.innerWidth > 768) show_menu = true"
                @mouseleave="if (window.innerWidth > 768) show_menu = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-50"
                style="display: none;"
            >
                {{-- User Links --}}
                <a href="{{ route('user.profile') }}" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    <x-heroicon-o-user class="w-4 h-4 ml-2" />
                    پروفایل
                </a>

                {{-- Super Admin Links --}}
                @role("super-admin")
                    <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>
                    <a href="{{ route('admin.settings') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <x-heroicon-o-cog-6-tooth class="w-4 h-4 ml-2" />
                        تنظیمات صفحه اصلی
                    </a>
                    <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <x-heroicon-o-users class="w-4 h-4 ml-2" />
                        مدیریت کاربران
                    </a>
                @endrole

                {{-- Admin & Super Admin Links --}}
                @role('admin|super-admin')
                    <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>
                    <a href="{{ route('admin.contacts') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <x-heroicon-o-envelope class="w-4 h-4 ml-2" />
                        فرم‌های تماس
                    </a>
                    <a href="{{ route('admin.comments') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <x-heroicon-o-chat-bubble-left-right class="w-4 h-4 ml-2" />
                        مدیریت نظرات
                    </a>
                    <a href="{{ route('admin.contents') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <x-heroicon-o-document-text class="w-4 h-4 ml-2" />
                        مدیریت محتوا
                    </a>

                    <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>
                    <a href="{{ route('activity.create') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <x-heroicon-o-calendar class="w-4 h-4 ml-2" />
                        نوشتن رویداد
                    </a>
                    <a href="{{ route('magazine.create') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <x-heroicon-o-book-open class="w-4 h-4 ml-2" />
                        نوشتن نشریه
                    </a>
                    <a href="{{ route('tip.create') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <x-heroicon-o-light-bulb class="w-4 h-4 ml-2" />
                        نوشتن نکته
                    </a>
                @endrole

                {{-- Regular User Links --}}
                @role('user')
                    <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>
                    <a href="{{ route('core.recommend') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <x-heroicon-o-plus-circle class="w-4 h-4 ml-2" />
                        ارسال مقاله
                    </a>
                @endrole

                {{-- Logout --}}
                <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex items-center px-4 py-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900 rounded-lg transition-colors">
                    <x-heroicon-o-arrow-left-on-rectangle class="w-4 h-4 ml-2" />
                    خروج از حساب
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    @else
        <a href="{{ route('login') }}" class="rounded-lg py-2 px-4 max-md:py-1 max-md:px-3 bg-green-500 text-white hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-500 transition-all flex items-center gap-2">
            <x-heroicon-o-arrow-right-on-rectangle class="w-4 h-4" />
            ورود
        </a>
    @endauth

    <nav class="md:flex gap-3 max-lg:gap-1 items-center sm:text-lg text-sm">
        <a href="{{ route('activity.index') }}" class="hover:bg-blue-100 dark:hover:bg-blue-800 px-3 py-2 rounded-md transition-all flex items-center gap-1">
            <x-heroicon-o-calendar class="w-4 h-4" />
            رویدادها
        </a>
        <a href="{{ route('magazine.index') }}" class="hover:bg-blue-100 dark:hover:bg-blue-800 px-3 py-2 rounded-md transition-all flex items-center gap-1">
            <x-heroicon-o-book-open class="w-4 h-4" />
            نشریات
        </a>
        <a href="{{ route('tip.index') }}" class="hover:bg-blue-100 dark:hover:bg-blue-800 px-3 py-2 rounded-md transition-all flex items-center gap-1">
            <x-heroicon-o-light-bulb class="w-4 h-4" />
            نکات
        </a>
        <a href="{{ route('core.contact') }}" class="hover:bg-blue-100 dark:hover:bg-blue-800 px-3 py-2 rounded-md transition-all max-sm:hidden flex items-center gap-1">
            <x-heroicon-o-envelope class="w-4 h-4" />
            تماس با ما
        </a>
    </nav>

    <form method="GET" class="hidden lg:flex items-center" action="{{ route('core.search') }}">
        <input
            name="search"
            type="text"
            value="{{ request('search', '') }}"
            placeholder="جستجو..."
            class="rounded-r-lg px-3 py-2 w-64 focus:outline-none dark:bg-gray-700 dark:text-gray-200 bg-gray-200 text-gray-700 focus:ring-2 ring-blue-400 transition-all border border-gray-300 dark:border-gray-600"
        >
        <input type="hidden" value="all" name="type">
        <button type="submit" class="ml-2 shadow-lg rounded-l-lg bg-blue-500 text-white px-4 py-2 hover:bg-blue-600 transition-all flex items-center gap-2">
            <x-heroicon-o-magnifying-glass class="w-4 h-4" />
            جستجو
        </button>
    </form>

    <button
        @click="dark = !dark"
        class="rounded-lg dark:bg-teal-600 bg-white text-gray-800 dark:text-gray-100 py-2 max-md:py-1 max-md:px-3 px-4 transition-all hover:bg-gray-200 dark:hover:bg-teal-500 flex items-center gap-2"
        :aria-label="dark ? 'Switch to light mode' : 'Switch to dark mode'"
    >
        <x-heroicon-o-moon x-show="dark" class="w-5 h-5"/>
        <x-heroicon-o-sun x-show="!dark" class="w-5 h-5"/>
    </button>
</header>
