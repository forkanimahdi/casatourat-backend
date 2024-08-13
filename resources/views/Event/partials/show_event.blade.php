<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full ">
            <h2 class="text-alpha font-semibold">
                {{ $event->title }}
            </h2>
        </div>


    </x-slot>

    <div class="bg-gray-100">
        <div class="flex items-center justify-center gap-3">
            <img class="h-[200px] w-[400px] rounded-xl aspect-square"
                src="{{ asset('storage/images/' . $event->images->first()->path) }}" alt="">
            <div>
                <p class="font-bold text-xl">{{ $event->title }}</p>
                <p>{{ $event->description }}</p>
                <p>{{ \Carbon\Carbon::parse($event->start)->format('F j \a\t g:i A') }} -
                    {{ \Carbon\Carbon::parse($event->end)->format('F j \a\t g:i A') }}
                </p>
            </div>
        </div>
        <div class=" px-8">
            <p
                class="text-2xl h-[10vh] font-extralight text-black rounded-full w-[35%] flex items-center justify-center">
                See The People Attending:
            </p>
        </div>

        <div>
            <table class="table">
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
                        <tr>
                            <td>{{$visitor->full_name}}</td>
                            <td>{{$visitor->email}}</td>
                            <td>{{$visitor->gender}}</td>
                            {{-- <td>{{$visitor->pivot->created_at}}</td> --}}
                            <td>{{ \Carbon\Carbon::parse($visitor->pivot->created_at)->format('F j, Y \a\t g:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>
