<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            Create Event
        </x-slot>

        <a href="{{route('events.create')}}">
            <button data-modal-target="default-modal" data-modal-toggle="default-modal"
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-alpha dark:hover:bg-alpha dark:focus:ring-blue-800"
            type="button">
            Add Event
        </button>
    </a>
    </x-slot>

    <div class="w-full h-full p-4 sm:p-6 lg:p-8">
        <div class="eventscontainer w-full flex justify-center">
            <div class="eventBody w-[90vw] h-[100vh] bg-gray-100 rounded-xl">
                {{-- Header --}}
                {{-- <div class="eventheader flex flex-row-reverse justify-between px-4"> --}}
                    <!-- Main modal -->
                    {{-- @include('Event.partials.add_event') --}}
                {{-- </div> --}}

                {{-- Card --}}
                <div class="flex flex-wrap py-4">
                    @foreach ($events as $event)
                        <div
                            class="group bg-gray-100 relative shadow-lg rounded-lg overflow-hidden my-4 mr-2 ml-[14px] w-[25vw]">
                            <img class="w-full h-56 object-cover object-center"
                                src='{{ asset('storage/images/' . $event->images[0]->path) }}' alt="event image">

                            <div class="px-4 py-2">
                                <h3>{{ $event->title->en }}</h3>
                                <p>{{ \Carbon\Carbon::parse($event->start)->format('F j \a\t g:i A') }}</p>
                                <div class="flex items-center justify-around mt-2">
                                    <div>
                                        <a href="{{ route('events.show', $event) }}"
                                            class="px-2 py-2 mr-1 border-2 border-alpha/20 text-alpha flex hover:bg-gray-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="#1221afcc" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>


                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ route('events.edit', $event) }}"
                                            class="px-2 py-2 mr-1 border-2 border-alpha/20 flex hover:bg-gray-200"> <svg
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="#1221afcc" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>

                                        </a>
                                    </div>
                                    <div>
                                        <form action={{ route('events.destroy', $event->id) }} method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="px-2 py-2 flex border-2 border-alpha/20 hover:bg-gray-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="#1221afcc"
                                                    class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>

                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>


            </div>
        </div>


    </div>



    <script>
        let markers = [];
        const svgMarkerBuilding = '/storage/markers/building_marker.svg';

        let allEvents = @json($events).map(event => {
            return {
                ...event,
                paths: {
                    lat: Number(event.latitude),
                    lng: Number(event.longitude),
                }
            }
        })

        function initMap() {
            const casablanca = {
                lat: 33.57,
                lng: -7.60
            }
            const map = new google.maps.Map(document.getElementById('event_map'), {
                zoom: 10,
                center: casablanca,
                mapTypeId: google.maps.MapTypeId.HYBRID
            });


            allEvents.forEach(event => {

                const marker = new google.maps.Marker({
                    position: event.paths,
                    map: map,
                    data: {
                        id: event.id,
                    },
                    icon: {
                        scaledSize: new google.maps.Size(45, 45),
                        anchor: new google.maps.Point(20, 45),
                    }
                });

                var infowindow = new google.maps.InfoWindow({
                    content: event.title
                });

                markers.push(marker)
                infowindow.open(map, marker)
            });

            map.addListener('click', function(event) {
                const marker = new google.maps.Marker({
                    position: {
                        lat: event.latLng.lat(),
                        lng: event.latLng.lng()
                    },
                    map: map,
                    icon: {
                        scaledSize: new google.maps.Size(45, 45),
                        anchor: new google.maps.Point(20, 45),
                    }
                });
                document.getElementById('event_lat').value = event.latLng.lat()
                document.getElementById('event_long').value = event.latLng.lng()

                document.getElementById('event_create').click();
            });
        }

        window.onload = initMap;
    </script>
</x-app-layout>
