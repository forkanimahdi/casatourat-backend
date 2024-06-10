<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <title>{{ config('app.name', 'Casa Guide') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased select-none">
    <div class="min-h-screen flex flex-col bg-gray-100 items-center justify-center">
        <h1 class="text-blue-700 capitalize font-extrabold text-[16rem]">oops!</h1>
        <div class="inline-flex">
            @foreach ([['e', '-translate-y-1/2'], ['r', '-translate-y-1/4 rotate-180 -scale-y-100'], ['ro', '-translate-y-1/2'], ['r', '-translate-y-1/2 rotate-180']] as [$word, $transform])
                <h2 class="uppercase text-9xl text-gray-800 font-bold {{ $transform }}">{{ $word }}</h2>
            @endforeach
        </div>
        {{-- <h6 class="text-lg -translate-y-1/2 text-gray-800">Something went really wrong</h6> --}}
        <a class="mt-4 text-decoration-none font-medium shadow-sm border-[1.75px] border-transparent border-blue-700 text-blue-700 capitalize py-[0.5rem] px-[1rem] rounded-xl text-base"
            href="/">
            return home
        </a>
    </div>

    <div class="fixed size-[600px] bg-sky-700 right-0 -top-1/2 translate-x-1/2 rounded-full"></div>
    <div class="fixed size-[125px] bg-alpha right-0 top-0 translate-x-[12.5%] translate-y-full rounded-full"></div>

    <div class="fixed size-[600px] bg-alpha left-0 bottom-0 -translate-x-[25%] translate-y-1/2 rounded-full"></div>
    <div class="fixed size-[125px] bg-sky-700 left-0 top-1/2 -translate-y-1/2 -translate-x-1/2 rounded-full"></div>
</body>

</html>
