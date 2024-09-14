<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                all circuits
            </h2>
        </div>
    </x-slot>
    <div class="w-full flex justify-end px-5 ">
        <a href='{{ route('circuit.create') }}'
            class="text-gray-100 no-underline text-md font-semibold bg-alpha py-2 px-4 rounded-lg shadow-md hover:shadow-lg hover:text-alpha hover:bg-gray-100 hover:border-2 hover:border-alpha transition duration-200 transform-gpu hover:scale-110 ">Create
            New Circuit</a>
    </div>
    <div class="flex flex-wrap gap-x-5 gap-y-3 mx-auto py-5 justify-center min-h-[100vh] bg-gray-200">
        @foreach ($circuits as $circuit)
            <div
                class="border border-white w-[22%] h-fit p-3 hover:bg-white hover:scale-[1.02] shadow-lg rounded-3xl group transi duration-500">
                <div class="h-[10vh] relative ">
                    @if (count($circuit->buildings) > 0)
                        <img class="w-[5vw] h-[5vw] rounded-full absolute hover:z-10"
                            src="{{ asset('storage/images/' . $circuit->buildings[0]->images[0]->path) }}"
                            alt="image_building">
                        @if (count($circuit->buildings) > 2)
                            <img class="absolute top-0 left-8 border-4 border-gray-200 group-hover:border-white duration-500 w-[5vw] h-[5vw] rounded-full"
                                src="{{ asset('storage/images/' . $circuit->buildings[1]->images[0]->path) }}"
                                alt="image_building">
                        @endif
                    @endif
                </div>
                <div class="pt-8">
                    <p class="font-medium text-[1.3rem]">{{ $circuit->name }}</p>
                    <p class=" text-gray-500 text-[1.1rem]">{{ $circuit->description }}</p>
                </div>
                <div class="ms-10 flex justify-end pt-3">
                    <a href="{{ route('circuit.show', $circuit) }}"
                        class="no-underline cursor-pointer border-2 border-gray-600 text-gray-600 rounded-full px-3 py-2 text-[0.8rem] hover:bg-blue-500 hover:text-white transition duration-500 hover:border-blue-500 ">VIEW
                        DETAILS
                    </a>
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
