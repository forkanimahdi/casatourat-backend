<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <title>{{ config('app.name', 'Casa Guide') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ config('map_api.api_key') }}&loading=async"></script>

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
                    <div class="mr-3 relative">
                        <svg id="visite_icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                        </svg>
                        <div
                            class="w-4 h-4 bg-red-500 text-white flex justify-center items-center rounded-lg absolute -top-2 -right-2">
                            {{-- <small class="mb-0 text-sm"> <small>{{ $notif->count() }}</small></small> --}}
                        </div>
                        <div id="pop_triangle_map"
                            style='width:0; height:0; border-left: 10px solid transparent;  border-right: 10px solid transparent; border-bottom: 10px solid rgb(229 231 235);'
                            class='hidden absolute right-0 top-6 z-50'></div>
                        <div id="notif_visite"
                            class="hidden absolute top-8 -right-1 bg-gray-200 overflow-auto max-h-[60vh] w-[25vw] gap-2 flex-col p-2 z-50 ">
                            <div id="visite_guide">
                                <div class="bg-white w-full relative p-2 rounded flex gap-1 mb-2 cursor-pointer">
                                    <p>Lionel Messi a demandé une visite guidée</p>
                                </div>
                                <div class="bg-white w-full relative p-2 rounded flex gap-1 mb-2 cursor-pointer">
                                    <p>Lionel Messi a demandé une visite guidée</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 cursor-pointer" id="notif_bell">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                        <div
                            class="{{ $notif->count() == 0 ? 'hidden' : '' }} w-4 h-4 bg-red-500 text-white flex justify-center items-center rounded-lg absolute -top-2 -right-2">
                            <small class="mb-0 text-sm"><small>{{ $notif->count() }}</small></small>
                        </div>
                        <div id="pop_triangle"
                            style='width:0; height:0; border-left: 10px solid transparent;  border-right: 10px solid transparent; border-bottom: 10px solid rgb(229 231 235);'
                            class='hidden absolute right-0 top-6 z-50'></div>
                        <div id="notif_body"
                            class="hidden notif_body bg-gray-200 overflow-auto max-h-[60vh] w-[25vw] absolute gap-2 flex-col p-2 top-8 -right-1 z-40">
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-alpha">
                                    <path fill-rule="evenodd" d="M3.792 2.938A49.069 49.069 0 0 1 12 2.25c2.797 0 5.54.236 8.209.688a1.857 1.857 0 0 1 1.541 1.836v1.044a3 3 0 0 1-.879 2.121l-6.182 6.182a1.5 1.5 0 0 0-.439 1.061v2.927a3 3 0 0 1-1.658 2.684l-1.757.878A.75.75 0 0 1 9.75 21v-5.818a1.5 1.5 0 0 0-.44-1.06L3.13 7.938a3 3 0 0 1-.879-2.121V4.774c0-.897.64-1.683 1.542-1.836Z" clip-rule="evenodd" />
                                  </svg>
                                <select class="bg-gray-50 rounded border-none focus:ring-0" name="filter"
                                    id="mySelect">
                                    <option class="filterOption" selected value="all">All</option>
                                    <option class="filterOption" value="alert">Alert</option>
                                    <option class="filterOption" value="warning">Warning</option>
                                    <option class="filterOption" value="satisfying">Satisfying</option>
                                </select>
                            </div>
                            <div id="notifications">

                            </div>
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
    <div     class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 id="modal-body-head"></h5>
                    <p id="modal-body-content"></p>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
