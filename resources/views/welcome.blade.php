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
    <div class=" text-black/50">
        
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-alpha selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <x-application-logo />
                    </div>
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="no-underline text-base rounded-md px-3 py-2 text-alpha ring-1 ring-transparent transition hover:text-alpha/70 focus:outline-none focus-visible:ring-alpha">
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

                <main class="mt-6">
                </main>

                <footer class="py-16 text-center text-sm text-alpha">
                    By Casamémoire (2024)
                </footer>
                <x-card bold="true" >
                    la7ya
                </x-card>

            </div>
        </div>
    </div>
</body>

</html>
