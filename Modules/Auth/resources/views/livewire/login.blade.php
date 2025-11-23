
    <div class="flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
        <form wire:submit.prevent="login" class="bg-slate-800 rounded-2xl shadow-xl w-full max-w-md p-6 space-y-6">
            @csrf
            <x-core::form.text-input
                label="ایمیل"
                name="email"
                type="email"
                wire="email"
                placeholder="ایمیل خود را وارد کنید"
            />
            <x-core::form.text-input
                label="رمز عبور"
                name="password"
                type="password"
                wire="password"
                placeholder="رمز عبور خود را وارد کنید"
            />
            <div class="flex items-center justify-between">
                <x-core::link
                    href="{{ route('register') }}"
                    text="ثبت نام"
                    class="text-sm font-medium text-blue-400 hover:text-blue-300"
                />

                <x-core::link
                    href="{{ route("forgot-password") }}"
                    text="فراموشی رمز عبور"
                    class="text-sm font-medium text-blue-400 hover:text-blue-300"
                />
            </div>
            <x-captcha/>
            <button type="submit" class="w-full py-3 text-white font-semibold bg-gradient-to-r from-blue-900 to-amber-600 hover:from-blue-800 hover:to-amber-500 transition-colors rounded-xl">ورود</button>
        </form>
    </div>
