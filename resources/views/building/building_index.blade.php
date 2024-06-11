<x-app-layout>
    <div class="grid grid-cols-2 gap-4">

        <div class="">
            <h1>assigned buildings</h1>
            @foreach ($assigned_buildings as $building)
                <div class="border border-black">
                    <div>
                        <p>name : {{ $building->name }}</p>
                        <p>description : {{ $building->description }}</p>
                        <p>assinged to circuit : {{ $building->circuit->name }}</p>
                    </div>
                    <div>
                        <form action="{{ route('building.destroy', $building->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">delete building</button>
                        </form>

                        <form action="{{ route('circuit.unassign_building') }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="text" class="d-none" name="building_id" value="{{ $building->id }}">
                            <button class="btn btn-danger">unassign building</button>
                        </form>
                        @include('building.partials.update_building_tab')

                    </div>
                </div>
            @endforeach
        </div>
        <div>
            <h1>unassigned buildings</h1>
            @foreach ($unassigned_buildings as $building)
                <div class="border border-black">
                    <div>
                        <p>name : {{ $building->name }}</p>
                        <p>description : {{ $building->description }}</p>

                    </div>
                    <div>
                        <form action="{{ route('building.destroy', $building->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">delete building</button>
                        </form>
                        @include('building.partials.update_building_tab')
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
