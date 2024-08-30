<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                {{-- {{ $circuit->name }} --}}
                customize circuit
            </h2>
        </div>
    </x-slot>
    <div>
        <form action="{{ route('customize.store') }}" method="post" class="flex flex-col w-[50%] p-8">
            @csrf
            {{-- @method('POST') --}}
            <label for="">name</label>
            <input name="name" type="text">
            <label for="">visitor id</label>
            <input name="visitor_id" type="number">
            <h1>buildings</h1>
            <div class="flex gap-3 py-3">
                @foreach ($buildings as $building)
                    <label value=''>{{ $building->name }}</label>
                    <input type="checkbox" value={{ $building->id }} name='buildings[]'>
                @endforeach
            </div>
            </select>
            <button class="bg-purple-300">create</button>
        </form>
        <div>
            @foreach ($customizeCircuits as $customizeCircuit)
                @foreach ($customizeCircuit->buildings as $build)
                    <h1>{{ $build->name }}</h1>
                @endforeach
            @endforeach
        </div>
    </div>
</x-app-layout>
