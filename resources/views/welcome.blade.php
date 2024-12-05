<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>{{ config('app.name', 'Casatourat') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class=" text-black/50 ">
        <div class="relative flex flex-col items-center justify-center selection:bg-alpha selection:text-white">
            <div class="relative w-full  lg:px-16 ">
                <header class="flex justify-between items-center sm:gap-2 sm:px-0 px-4  ">
                    <div class="flex  ">
                        <x-application-logo  />
                    </div>
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end font-medium">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="no-underline text-base  rounded-md px-3 py-2 text-alpha ring-1 ring-transparent transition hover:text-alpha/70 focus:outline-none focus-visible:ring-alpha">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="no-underline text-base rounded-md px-3 py-2 text-alpha ring-1 ring-transparent transition hover:text-alpha/70 focus:outline-none focus-visible:ring-alpha">
                                    Log in
                                </a>
                            @endauth
                        </nav>
                    @endif
                </header>

                <main class="">
                    <div class="flex flex-col items-center   text-black sm:px-0 px-2">
                        <h1 class="sm:text-start text-center">Explore Casablanca with Casatourat</h1>
                        <p class="text-lg font-medium text-black/75 lg:text-start text-center">Discover hidden gems, follow curated circuits, and stay updated with local events.</p>
                        <div class="flex justify-center gap-4">
                            <a target="_blank" href="https://www.apple.com/app-store/">
                                <img width="200" class=""
                                    src="{{ asset('assets/images/App_Store_(iOS)-Badge-Logo.wine.png') }}"
                                    alt="">
                            </a>
                            <a target="_blank" href="https://play.google.com/">
                                <img width="200" class=""
                                    src="{{ asset('assets/images/Google_Play-Badge-Logo.wine.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="flex sm:flex-row flex-col gap-4 items-center justify-center">
                        <img src="{{ asset('assets/images/group_1609.png') }}" alt="">
                        <img src="{{ asset('assets/images/Frame 65.png') }}" alt="">
                        <img src="{{ asset('assets/images/Frame 64.png') }}" alt="">
                        <img src="{{ asset('assets/images/group_1608.png') }}" alt="">
                    </div>
                </main>

                <footer class="py-6 font-bold bg-[#ffffff83] text-center text-sm text-alpha">
                    © 2024 By Casamémoire. All rights reserved.
                </footer>
            </div>
        </div>
    </div>
</body>

</html>
