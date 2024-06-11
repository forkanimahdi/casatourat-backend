<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                Manage Users
            </h2>

            <button onclick="addModeratorAdmin.show()"
                class="bg-alpha text-[#fff] px-[1.75rem] py-[0.5rem] rounded-xl font-medium border-2 border-alpha hover:bg-transparent hover:font-semibold hover:text-alpha transition-all duration-600">
                Add admin
            </button>
            @include('visitors.partials.create_moderator_modal')
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 text-alpha ">
        <div class="bg-white overflow- shadow-sm sm:rounded-lg px-6 py-3">
            <div class="flex mb-3 items-center justify-between">
                <div class="w-1/3 flex items-center bg-gray-100 rounded-lg pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                            clip-rule="evenodd" />
                    </svg>
                    <input placeholder="search by name or email" type="search" name="search" id="search"
                        class="border-none bg-transparent w-full placeholder:text-alpha outline-none focus:border-none focus:ring-0 focus:outline-none text-sm">
                </div>

                <div class="relative">
                    <button id="sortbtn" class="flex items-center gap-1">
                        <div>sort by: <span id="sortby" class="text-blue-500 font-medium"></span></div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.75"
                            stroke="currentColor" class="size-3 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <dialog id="sortdialog"
                        class="top-full bg-white shadow-md py-1.5 rounded-lg text-alpha font-medium left-auto mt-1">
                        @foreach (['name', 'email', 'gender', 'role', 'joined'] as $item)
                            <div data-name="{{ $item }}"
                                class="sortitem lowercase pl-[2rem] pr-[3rem] py-1 cursor-pointer">{{ $item }}
                            </div>
                        @endforeach
                    </dialog>
                </div>
            </div>

            <table class="w-full">
                <thead>
                    <tr class="flex justify-around py-2">
                        @foreach (['name' => 'flex-[100%]', 'email' => 'flex-[100%]', 'gender' => 'flex-[50%]', 'role' => 'flex-[50%]', 'joined' => 'flex-[50%]'] as $item => $flex)
                            <th class="{{ $flex }} capitalize">{{ $item }}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody id="table"></tbody>
            </table>
        </div>
    </div>
</x-app-layout>

@vite('resources/js/search.js')
