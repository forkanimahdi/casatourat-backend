<x-app-layout>
    <div class="flex justify-center p-5">
        <div class="w-full p-4 shadow rounded-2xl">
            <div class="w-full flex">
                <div class="bg-red-100 w-1/2 h-[80vh] rounded-xl ">

                </div>
                <div class=" p-3 w-1/2">
                    @include('building.partials.update_building_tab')
                </div>
            </div>
        </div>

        <!-- <div class="">
                <div class="border border-black">
                    <div>
                        <p>name : {{ $building->name }}</p>
                        <p>description : {{ $building->description }}</p>
                        @if ($building->circuit)
                            <p>assinged to circuit : {{ $building->circuit->name }}</p>
                        @endif
                    </div>
                    <div>
                        <form action="{{ route('building.destroy', $building->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">delete building</button>
                        </form>

                    

                    </div>
                </div>
            </div> -->
    </div>
</x-app-layout>