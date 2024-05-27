<x-app-layout>
    <div>
        @foreach ($circuits as $circuit)
            <div class="border border-red-700 grid grid-cols-2">
                <div>
                    <p>name : {{ $circuit->name }}</p>
                    <p>assigned buildings</p>
                    <ul>
                        @foreach ($circuit->buildings as $building)
                            <p>name : {{ $building->name }}</p>
                            <p>description : {{ $building->description }}</p>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <form action="{{ route('circuit.destroy', $circuit) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">delete</button>
                    </form>
                    <a href="{{ route('assign_building.index', $circuit->id) }}">assign building to the circuit</a>
                    <form action="{{ route('circuit.update_draft', $circuit) }}" method="post">
                        @method('PUT')
                        @csrf
                        <button
                            class="border px-2 py-1 rounded-md test-[1.2rem] bg-gray-500 text-white">{{ $circuit->published ? 'unpublish' : 'publish' }}
                            the circuit</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
