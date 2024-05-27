<x-app-layout>
    <div>
        @foreach ($circuits as $circuit)
            <div>
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
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
