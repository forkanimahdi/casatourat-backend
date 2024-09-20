<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight  font-semibold text-xl">
                Update Building
            </h2>
            @include('building.partials.confirmation_modale')
        </div>
    </x-slot>
    <div class="p-3">
        @include('building.partials.update_building_tab')
    </div>

</x-app-layout>
