<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full ">
            <h2 class="text-alpha font-semibold">
                {{ $event->title }}
            </h2>
        </div>


    </x-slot>

    <div class="bg-gray-100 p-4">
        <div>
            {{-- Image Header Info --}}
            <div class="relative">
                <img class="h-[400px] w-full rounded-xl aspect-square "
                    src="{{ asset('storage/images/' . $event->images->first()->path) }}" alt="event poster">

                <div class="absolute inset-0 bg-black/40 rounded-xl"></div>

                <div class="absolute bottom-0 right-0 text-white px-4">
                    <h1>{{ $event->title }}</h1>
                    <p class="tracking-wider">{{ $event->description }}</p>
                </div>

            </div>

            {{-- Icons Info --}}
            <div class="flex items-center justify-around mt-3">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="#1221af" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    <p class="m-0">location here?</p>
                </div>

                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="#1221af" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    <p class="m-0">{{ \Carbon\Carbon::parse($event->start)->format('F j \a\t g:i A') }}</p>
                </div>

                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="#1221af" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>

                    <p class="m-0">total attendees</p>
                </div>

                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="#1221af" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>

                    <p class="m-0">location here?</p>
                </div>

            </div>

            {{-- Table Info --}}
            <div class="mt-4 bg-white rounded">
                <h2 class="underline mb-4 p-2">People Attending: </h2>
                <table class="table table-striped ">
                    <thead>
                        <tr class="font-bold">
                            <td>Name</td>
                            <td>Email</td>
                            <td>Gender</td>
                            <td>Booked At</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event->bookings as $key => $visitor)
                            <tr class="h-[7vh]">
                                <td>{{ $visitor->full_name }}</td>
                                <td>{{ $visitor->email }}</td>
                                <td>{{ $visitor->gender }}</td>
                                <td>{{ \Carbon\Carbon::parse($visitor->pivot->created_at)->format('F j, Y \a\t g:i A') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</x-app-layout>
