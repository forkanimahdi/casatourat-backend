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

        <!-- Side Bar -->
        @include('layouts.side_bare')

        <div class="flex flex-col w-full overflow-y-auto h-screen">
            <!-- Page Heading -->
            @if (isset($header))
                <header style="padding: 10px;" class="bg-white flex items-center justify-between">
                    <div class="max-w-7xl py-[1rem] px-4 sm:px-6 lg:px-8 w-full">
                        {{ $header }}
                    </div>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 cursor-pointer" id="notif_bell">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                        <div
                            class="w-4 h-4 bg-red-500 text-white flex justify-center items-center rounded-lg absolute -top-2 -right-2">
                            <small class="mb-0 text-sm"> <small>{{ $notif->count() }}</small></small>
                        </div>
                        <div id="notif_body"
                            class="hidden notif_body bg-gray-200 overflow-auto max-h-[60vh] w-[25vw] absolute gap-2 flex-col p-2 right-2 z-50">
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                                </svg>
                                <form action="">
                                    <select class="bg-transparent border-none focus:ring-0" name="filter"
                                        id="mySelect">
                                        {{-- <option value="">Choose a status</option> --}}
                                        {{-- <option class="filterOption" selected value="all">All</option> --}}
                                        <option class="filterOption" value="alert">Alert</option>
                                        <option class="filterOption" value="warning">Warning</option>
                                        <option class="filterOption" value="satisfying">Satisfying</option>
                                    </select>
                                    <button class="bg-alpha px-2 py-1 text-white rounded">Filtrer</button>
                                </form>
                            </div>
                            <div id="notifications">

                            </div>
                            {{-- @foreach ($reviews as $review)
                                <a href="{{ route('notif.show', $review) }}" class="no-underline">
                                    <div
                                        class="{{ $review->mark_read ? 'bg-white' : ' bg-indigo-100' }} w-full relative p-2 rounded flex gap-1 cursor-pointer no-underline decoration-black text-black">
                                        <div
                                            class="{{ $review->status == 'alert' ? 'bg-red-700' : ($review->status == 'satisfying' ? 'bg-emerald-700' : 'bg-amber-500') }} w-2 absolute left-0 top-0 h-[4.9rem]  rounded-l">
                                        </div>
                                        <div class="w-full px-2">
                                            <div class="flex justify-between items-center w-full">
                                                <p class="mb-0">
                                                    <span class="font-bold">Lionel Messi</span> added a review for
                                                    <span class="font-bold">Mahkama</span>
                                                </p>
                                                <div class="flex justify-start items-center ">
                                                    <form action="{{ route('update.notif', $review) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button
                                                            class="p-1 hover:bg-gray-100 hover:p-1 hover:rounded-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-3 cursor-pointer">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m4.5 12.75 6 6 9-13.5" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('notif.delete', $review) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            class=" p-1 hover:bg-gray-100 hover:p-1 hover:rounded-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-3 cursor-pointer">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M6 18 18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <p class="truncate max-w-[20vw]">{{ $review->content }}</p>
                                        </div>
                                    </div>
                                    </a>
                            @endforeach --}}
                        </div>
                    </div>
                    <div class="hidden sm:flex {{ isset($header) ? '' : 'sm:ml-auto' }}">
                        <!-- Settings Dropdown -->
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 ml-7 py-2 text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

                </header>
            @endif

            <!-- Page Content -->
            <main class="">
                {{ $slot }}
            </main>
        </div>

        {{-- <!-- Page Content -->
        <main class="w-full overflow-y-auto h-screen">
            {{ $slot }}
        </main> --}}
    </div>
    <div id="test"></div>
</body>
<script>
    const reviews = @json($reviews)
</script>
</html>
