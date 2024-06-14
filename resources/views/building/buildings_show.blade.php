<x-app-layout>
    <div class="flex justify-center p-3 ">
        <div class="w-full h-[95vh]  p-3 shadow rounded-2xl">
            <div class="w-full h-full flex gap-4">
                <div class="w-1/2 h-full p-3   flex justify-center items-center  rounded-xl ">
                    @if ($building->images->isNotEmpty())
                        <img id="displayed-image" class="rounded-xl w-full max-h-full " src="{{ asset('storage/images/' . $building->images->first()->path) }}" alt="img" />
                    @else
                    <div class="w-full h-full flex flex-col justify-center items-center">
                        <h4 class="text-gray-500">There no images for this build</h4>
                        <img class="rounded-xl w-2/3 h-1/2 " src="{{ asset('storage/images/upload.jpg') }}" alt="img" />
                    </div>
                    @endif
                </div>
                <div class="h-full  w-1/2">
                    @include('building.partials.update_building_tab')
                </div>
            </div>
        </div>

    </div>

</x-app-layout>