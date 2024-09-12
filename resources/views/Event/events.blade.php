<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha font-semibold">
                Create Event
            </h2>
            <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-alpha dark:hover:bg-alpha dark:focus:ring-blue-800"
                type="button">
                Add Event
            </button>
        </div>


    </x-slot>

    <div class="w-full h-full">

        <div class="eventscontainer w-full flex justify-center">
            <div class="eventBody w-[90vw] h-[100vh] bg-gray-100 rounded-xl">
                {{-- Header --}}
                <div class="eventheader flex flex-row-reverse justify-between px-4">


                    <!-- Main modal -->

                    @include('Event.partials.add_event')


                </div>

                {{-- Card --}}
                <div class="flex flex-wrap py-4">
                    @foreach ($events as $event)
                        <div
                            class="group bg-gray-100 relative shadow-lg rounded-lg overflow-hidden my-4 mr-2 ml-[14px] w-[25vw]">
                            <img class="w-full h-56 object-cover object-center"
                                src='{{ asset('storage/images/' . $event->images[0]->path) }}' alt="event image">
                            <div class="absolute bottom-0 flex justify-around bg-black/50 py-2 w-full items-center gap-4">
                                <p
                                    class=" m-0 text-white font-semibold text-lg bg-alpha px-2 py-1 rounded-lg h-fit w-[75%] text-center truncate group-hover:whitespace-normal group-hover:overflow-visible">
                                    {{ $event->title }}
                                </p>

                                <p
                                    class="m-0 text-white font-semibold text-lg bg-alpha px-2 py-1 rounded-lg w-fit">
                                    {{ substr($event->start, 6, 4) }}
                                </p>
                            </div>

                            <div
                                class="w-full absolute top-0 left-0 z-10 group-hover:h-[30%] h-[0%] duration-150 flex items-center">

                                <div class="w-full group-hover:flex items-center justify-between px-2 hidden ">

                                    <form method="POST">
                                        @csrf
                                        <a href="{{ route('events.show', $event) }}"
                                            class="px-2 py-2 mr-1 bg-alpha rounded-full text-white flex">
                                            <svg fill="#ffffff" width="800px" class="h-5 w-5" viewBox="0 0 32 32"
                                                version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                <title>See Event</title>
                                                <path
                                                    d="M0 16q0.064 0.128 0.16 0.352t0.48 0.928 0.832 1.344 1.248 1.536 1.664 1.696 2.144 1.568 2.624 1.344 3.136 0.896 3.712 0.352 3.712-0.352 3.168-0.928 2.592-1.312 2.144-1.6 1.664-1.632 1.248-1.6 0.832-1.312 0.48-0.928l0.16-0.352q-0.032-0.128-0.16-0.352t-0.48-0.896-0.832-1.344-1.248-1.568-1.664-1.664-2.144-1.568-2.624-1.344-3.136-0.896-3.712-0.352-3.712 0.352-3.168 0.896-2.592 1.344-2.144 1.568-1.664 1.664-1.248 1.568-0.832 1.344-0.48 0.928zM10.016 16q0-2.464 1.728-4.224t4.256-1.76 4.256 1.76 1.76 4.224-1.76 4.256-4.256 1.76-4.256-1.76-1.728-4.256zM12 16q0 1.664 1.184 2.848t2.816 1.152 2.816-1.152 1.184-2.848-1.184-2.816-2.816-1.184-2.816 1.184l2.816 2.816h-4z">
                                                </path>
                                            </svg>

                                        </a>
                                    </form>
                                    <div class="flex items-center gap-2">
                                        <form method="POST" class="mr-1">
                                            @csrf
                                            <a href="{{ route('events.edit', $event) }}"
                                                class="px-2 py-2 mr-1 bg-alpha rounded-full text-white flex"> <svg
                                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg></a>
                                        </form>

                                        <form action={{ route('events.destroy', $event->id) }} method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="px-2 py-2 bg-red-500 rounded-full text-white flex"> <svg
                                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M8 3V2h4v1h5v2H3V3h5zm1 0h2V2H9v1zM4 6h12v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm2 0v10h8V6H6z" />
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
