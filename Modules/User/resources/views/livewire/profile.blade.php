<main class="flex justify-center py-8">
    <form wire:submit.prevent='updateUser' enctype="multipart/form-data"
          class="container flex flex-col gap-6 p-8 bg-white shadow-lg rounded-lg dark:bg-gray-800">

        {{-- تصویر پروفایل --}}
        @if(!empty($user['image']))
            <img src="{{ asset($user['image']) }}" alt="{{ $user['username'] ?? 'User' }}"
                 class="shadow-lg object-cover mx-auto shadow-black rounded-3xl h-64 w-64">
        @else
            <img src="{{ asset('images/default.png') }}" alt="Default User"
                 class="shadow-lg object-cover mx-auto shadow-black rounded-3xl h-64 w-64">
        @endif

        {{-- نام کاربری --}}
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">نام کاربری</label>
            <input disabled value="{{ $user['username'] ?? '' }}" type="text" id="username"
                   class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 cursor-not-allowed">
        </div>

        {{-- نام و نام خانوادگی --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                نام و نام خانوادگی
            </label>


            <input wire:model="name" type="text" id="name"
                   class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white transition duration-200
                          @error('name') border-red-500 @enderror">

            @error('name')
                <div class="text-red-500 text-sm mt-1 flex items-center gap-1">
                    <x-heroicon-o-exclamation-circle class="w-4 h-4" />
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- شماره تماس --}}
        <div>
            <label for="number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                شماره تماس
            </label>


            <input wire:model="number" type="tel" id="number"
                   class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white transition duration-200
                          @error('number') border-red-500 @enderror"
                   placeholder="09xxxxxxxxx">

            @error('number')
                <div class="text-red-500 text-sm mt-1 flex items-center gap-1">
                    <x-heroicon-o-exclamation-circle class="w-4 h-4" />
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- ایمیل --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                ایمیل
            </label>


            <input wire:model="email" type="email" id="email"
                   class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white transition duration-200
                          @error('email') border-red-500 @enderror">

            @error('email')
                <div class="text-red-500 text-sm mt-1 flex items-center gap-1">
                    <x-heroicon-o-exclamation-circle class="w-4 h-4" />
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                تعویض عکس پروفایل
            </label>

            <input wire:model="image" type="file" accept="image/png,image/jpeg" id="image"
                   class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 transition duration-200
                          @error('image') border-red-500 @enderror">

            @error('image')
                <div class="text-red-500 text-sm mt-1 flex items-center gap-1">
                    <x-heroicon-o-exclamation-circle class="w-4 h-4" />
                    {{ $message }}
                </div>
            @enderror

            {{-- پیش‌نمایش تصویر --}}
            @if ($image)
                <div class="mt-2">
                    <p class="text-sm text-gray-600 dark:text-gray-400">پیش‌نمایش:</p>
                    <img src="{{ $image->temporaryUrl() }}" class="mt-1 h-20 w-20 object-cover rounded-lg">
                </div>
            @endif
        </div>

        {{-- حذف حساب کاربری --}}
        @if(!auth()->user()->hasRole("super-admin"))
            <div class="flex gap-2 items-center p-4 border border-red-200 dark:border-red-800 rounded-lg bg-red-50 dark:bg-red-900/20">
                <input wire:model="delete" type="checkbox" id="delete"
                       class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="delete" class="text-red-600 dark:text-red-400 font-bold">حذف حساب کاربری</label>
            </div>
        @endif

        <x-core::link :href="route('reset-password')"
           class="text-sm font-medium text-blue-500 hover:text-blue-400 dark:text-blue-400 dark:hover:text-blue-300 transition duration-200"
           text=' تغییر رمز عبور'
           />

        <x-captcha />

        <div>
            <button type="submit"
                    wire:loading.attr="disabled"
                    class="w-full bg-blue-500 text-white font-semibold p-2 rounded-md hover:bg-blue-600 disabled:bg-blue-300 dark:disabled:bg-blue-700 transition duration-200 flex items-center justify-center gap-2">
                <span wire:loading.remove wire:target="updateUser">ثبت تغییرات</span>
                <span wire:loading wire:target="updateUser" class="flex items-center gap-2">
                    <x-loader size="w-4 h-4" />
                    در حال ثبت...
                </span>
            </button>
        </div>
    </form>
</main>
