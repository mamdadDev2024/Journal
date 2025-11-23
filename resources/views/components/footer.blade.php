@props([
    'titleFooter',
    'aboutUs',
    'contactUs',
    'links'
])

<footer data-aos="fade-up"
        class="w-full flex flex-col mt-3 min-h-96 rounded-t-xl text-white bg-sky-600 dark:bg-gray-700">

    <div data-aos="fade-down" class="w-full overflow-hidden bg-transparent">
        @if ($titleFooter)
            <a href="{{ route('home') }}" class="block w-full">
                <img
                    src="{{ asset($titleFooter) }}"
                    alt="Footer"
                    data-aos="fade-up"
                    class="block w-full max-w-full h-auto object-cover">
            </a>
        @endif
    </div>

    <div>
        <div class="px-6 pt-8 pb-5 grid lg:grid-cols-3 gap-4 md:grid-cols-2 sm:grid-cols-1">

            {{-- لینک‌های مفید --}}
            <div class="flex flex-col mx-3">
                <h3 class="font-bold text-lg mb-2">لینک های مفید</h3>

                @foreach ($links as $link)
                    @php
                        $url = preg_match('/^(http|https):\/\//', $link->link)
                            ? $link->link
                            : 'http://' . $link->link;
                    @endphp
                    <a href="{{ $url }}" class="text-white underline-offset-1 underline">
                        {{ $link->name }}
                    </a>
                @endforeach
            </div>

            {{-- درباره ما --}}
            <div class="flex flex-col mx-3">
                <h3 class="font-bold text-lg mb-2">درباره ما</h3>
                <p class="text-gray-100 dark:text-gray-300">
                    {{ $aboutUs }}
                </p>
            </div>

            {{-- تماس با ما --}}
            <div class="flex flex-col mx-3">
                <h3 class="font-bold text-lg mb-2">تماس با ما</h3>
                <p class="text-gray-100 dark:text-gray-300">
                    {{ $contactUs }}
                </p>
            </div>

        </div>

        <div class="text-lg flex justify-center py-4 bg-sky-700 dark:bg-gray-800 w-full text-center">
            تمامی حقوق نشر و کپی‌رایت برای مدرسه معصومیه (سلام الله علیها) محفوظ می‌باشد.
        </div>
    </div>
</footer>
