<div class="flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
    <form wire:submit.prevent='save' class="bg-slate-800 rounded-2xl shadow-xl w-full max-w-md p-6 space-y-6">
        @csrf
        <h2 class=" text-lg font-bold text-white flex justify-center">تماس باما</h2>
        <x-core::form.text-input
            name="number"
            type="text"
            label="شماره تلفن"
            placeholder="شماره تلفن خود را وارد کنید"
        />
        <x-core::form.textarea
            name="body"
            label="متن"
            placeholder="متن خود را وارد کنید"
            required
            :value="old('body')"
        />
        <x-captcha/>
        <button type="submit" class="w-full py-3 text-white font-semibold bg-gradient-to-r from-blue-900 to-amber-600 hover:from-blue-800 hover:to-amber-500 transition-colors rounded-xl">ثبت</button>
    </form>
</div>
