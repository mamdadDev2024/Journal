<!DOCTYPE html>
<html lang="fa" dir="rtl"
      x-data="{ dark: localStorage.getItem('dark') === 'true' }"
      x-init="$watch('dark', val => localStorage.setItem('dark', val))"
      :class="{ 'dark': dark }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? __($title) : __(config('app.name')) }}</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite('resources/css/app.css')
    @else
        <link rel="stylesheet" href="{{ asset('assets/app1.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/app2.css') }}">
    @endif
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}">
    {{ $styles ?? '' }}

    <style>
        @media not all and (min-width: 1024px) { .h-82 { height: 22rem; } }
        .sticky-header { position: fixed; top: 0; left: 0; width: 100%; z-index: 50; }
        @font-face {
            font-family: "vasir";
            src: url({{ asset("assets/fonts/vasir.woff")}}) format("woff");
            font-weight: normal;
            font-style: normal;
        }
        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3490dc;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>

    {!! ToastMagic::styles() !!}

    @livewireStyles
</head>

<body class="transition-all duration-200 font-vasir flex flex-col bg-gradient-to-b dark:from-slate-700 from-slate-200 dark:to-slate-800 to-slate-300 min-h-screen">
    <x-header id="header"/>

    <main class="flex-1">
        {{ $slot }}
    </main>

    <x-footer
        :titleFooter="$footerData['titleFooter']"
        :aboutUs="$footerData['aboutUs']"
        :contactUs="$footerData['contactUs']"
        :links="$footerData['links']"
    />

    <script>
        window.addEventListener('scroll', function () {
            const header = document.getElementById('header');
            if (header) {
                if (window.scrollY > 200) header.classList.add('sticky-header');
                else header.classList.remove('sticky-header');
            }
        });
    </script>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite('resources/js/app.js')
    @else
        <script src="{{ asset('assets/app.js') }}"></script>
    @endif

    {{ $scripts ?? '' }}

    <x-overlay />

    {!! ToastMagic::scripts() !!}
    @livewireScripts
</body>
</html>
