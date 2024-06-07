<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Casa Guide') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ config('map_api.api_key') }}&loading=async">
    </script>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex bg-gray-100 ">


        @include('layouts.side_bare')
        <!-- Page Content -->
        <main class="bg-purple-300 w-full overflow-y-auto h-screen">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
