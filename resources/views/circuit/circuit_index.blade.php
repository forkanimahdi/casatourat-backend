<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                all circuits
            </h2>

            <a href='{{ route('circuit.create') }}'
                class="bg-alpha text-[#fff] no-underline px-[1.75rem] py-[0.5rem] rounded-xl font-medium border-2 border-alpha hover:bg-transparent hover:font-semibold hover:text-alpha transition-all duration-600">
                {{-- class="text-gray-100 no-underline text-md font-semibold bg-alpha py-2 px-4 rounded-lg shadow-md hover:shadow-lg hover:text-alpha hover:bg-gray-100 hover:border-2 hover:border-alpha transition duration-200 transform-gpu hover:scale-110 "> --}}
                Create New Circuit
            </a>
        </div>
    </x-slot>

    <div class="flex flex-wrap gap-x-5 gap-y-3 p-[1.75rem] min-h-[calc(100vh-94.24px)] bg-gray-200">
        @foreach ($circuits as $circuit)
            <div class="w-[calc(calc(100%-2.5rem)/3)] relative h-fit rounded-lg aspect-square bg-white overflow-hidden">
                <img class="size-full absolute" src="{{ asset('assets/images/old_casa.jpg') }}" alt="">
                <div
                    class="px-[1.5rem] py-[1.25rem] after:absolute after:size-full after:bg-black/50 after:inset-0 after:blur after:rounded-t-lg text-white absolute bottom-0 left-0 w-full">
                    <div class="z-10 relative bottom-0">
                        <h1 class="text-xl/none">{{ $circuit->name }}</h1>
                        <p class="truncate leading-none m-0">{{ $circuit->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>


{{-- <div class="fles flex-col gap-2">
    <form action="{{ route('circuit.destroy', $circuit) }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">delete</button>
    </form>
    <a class="btn btn-primary" href="{{ route('assign_building.index', $circuit->id) }}">assign building
        to the circuit</a>
    <form action="{{ route('circuit.update_draft', $circuit) }}" method="post">
        @method('PUT')
        @csrf
        <button
            class="border px-2 py-1 rounded-md test-[1.2rem] bg-gray-500 text-white">{{ $circuit->published ? 'unpublish' : 'publish' }}
            the circuit</button>
    </form>
    <a class="btn btn-primary" href="{{ route('circuit.update_map', $circuit) }}">update circuit</a>
</div> --}}
