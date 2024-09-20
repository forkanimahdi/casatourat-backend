<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                Create a building
            </h2>
        </div>
    </x-slot>
    <div class="flex gap-3 bg-[#ffffffb2]">
        {{-- mapppppppp --}}
        <div id="map" class="w-[60%] h-[85vh] ">
        </div>
        <div class="w-[40%] p-4 ">
            <h5>Create Building</h5>
            <div id="tabsBtn" class="flex bg-gray-200 w-full justify-between gap-2 p-1 rounded-lg">
                <button id="btnEnglish" type="button"
                    class="w-1/3 rounded-md font-medium p-1 langueBtn">English</button>
                <button id="btnFrench" type="button"
                    class="w-1/3 rounded-md font-medium p-1 langueBtn">Français</button>
                <button id="btnArabic" type="button"
                    class="w-1/3 rounded-md font-medium p-1 langueBtn">العربية</button>
            </div>
            <form action="{{ route('building.store') }}" class="flex flex-col gap-2 p" method="post"
                enctype="multipart/form-data">
                @csrf
                <div id="english_version" class="block">
                    <div class="flex flex-col w-full">
                        <label for="" class="w-full font-bolder text-base">Name</label>
                        <input class="rounded w-full" type="text" placeholder="name" name="name">
                    </div>
                    <div class="flex flex-col w-full ">
                        <label for="" class="w-full font-bolder text-base">Description</label>
                        <input class="rounded w-full" type="text" placeholder="description" name="description">
                    </div>
                    <span>Audio</span>
                    <div
                        class="flex flex-col py-2 cursor-pointer items-center border-[1.5px] border-gray-500 rounded w-full">
                        <label for="audio" class="w-full font-bolder text-base flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                            </svg>
                            Upload Audio
                        </label>
                        <input id="audio" class="rounded w-full d-none" type="file" placeholder="audio"
                            name="audio" accept="audio/*">
                    </div>
                </div>
                <div id="french_version" class="hidden">
                    <div class="flex flex-col w-full">
                        <label for="" class="w-full font-bolder text-base">Nom</label>
                        <input class="rounded w-full" type="text" placeholder="Etrez Nom" name="name">
                    </div>
                    <div class="flex flex-col w-full ">
                        <label for="" class="w-full font-bolder text-base">Description</label>
                        <input class="rounded w-full" type="text" placeholder="description" name="description">
                    </div>
                    <span>Audio</span>
                    <div
                        class="flex flex-col py-2 cursor-pointer items-center border-[1.5px] border-gray-500 rounded w-full">
                        <label for="audio" class="w-full font-bolder text-base flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                            </svg>
                            Upload Audio
                        </label>
                        <input id="audio" class="rounded w-full d-none" type="file" placeholder="audio"
                            name="audio" accept="audio/*">
                    </div>
                </div>
                <div id="arabic_version" class="hidden">
                    <div class="flex flex-col text-right w-full">
                        <label for="" class="w-full font-bolder text-base">الاسم</label>
                        <input class="rounded w-full text-right" type="text" placeholder="الاسم" name="name">
                    </div>
                    <div class="flex flex-col text-right w-full ">
                        <label for="" class="w-full font-bolder text-base">الوصف</label>
                        <input class="rounded w-full text-right" type="text" placeholder="الوصف" name="description">
                    </div>

                    <p class="text-right m-0">الصوت</p>
                    <div
                        class="flex flex-col  py-2 cursor-pointer items-center border-[1.5px] border-gray-500 rounded w-full">
                        <label for="audio" class="w-full font-bolder items-end flex-row-reverse text-base flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                            </svg>
                            Upload Audio
                        </label>
                        <input id="audio" class="rounded w-full d-none" type="file" placeholder="audio"
                            name="audio" accept="audio/*">
                    </div>
                </div>

                <div class="flex flex-col w-full gap-2 ">
                    <label class="w-full font-bolder text-base" for="latitude">Latitude</label>
                    <input type="text" class="rounded w-full" id="latitude" placeholder="latitude" name="latitude">
                </div>
                <div class="flex flex-col w-full ">
                    <label class="w-full font-bolder text-base" for="longitude">Longtitude</label>
                    <input type="text" class="rounded w-full" id="longitude" placeholder="longitude"
                        name="longitude">
                </div>
                <div class="flex flex-col gap-2">
                    <span>Images</span>
                    <div
                        class="flex flex-col py-2 cursor-pointer items-center border-[1.5px] border-gray-500 rounded w-full">
                        <label for="image" class="w-full font-bolder text-base flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            Upload Image
                        </label>
                        <input id="image" class="rounded w-full d-none" type="file" placeholder="image" multiple
                            name="image[]" accept="image/*">
                    </div>
                </div>
                <button
                    class="flex items-center justify-center gap-2 p-2 bg-alpha text-gray-100 rounded w-full font-bold hover:shadow hover:border-2 hover:border-alpha hover:text-alpha hover:bg-gray-100 duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    Create Building</button>
            </form>
        </div>
    </div>

    @include('building.partials.add_building_modal')
    {{-- @include('building.partials.delete_building_modal') --}}



    <script>
        let markers = [];
        const svgMarkerBuilding = '/storage/markers/building_marker.svg';

        let allBuildings = @json($buildings).map(building => {
            return {
                ...building,
                paths: {
                    lat: Number(building.latitude),
                    lng: Number(building.longitude),
                }
            }
        })

        function initMap() {
            let allCicruits = [];
            const casablanca = {
                lat: 33.57,
                lng: -7.60
            }
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: casablanca,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            });


            allBuildings.forEach(building => {

                const marker = new google.maps.Marker({
                    position: building.paths,
                    map: map,
                    data: {
                        id: building.id
                    },
                    icon: {
                        url: svgMarkerBuilding,
                        scaledSize: new google.maps.Size(45, 45),
                        anchor: new google.maps.Point(20, 45),
                    }
                });

                var infowindow = new google.maps.InfoWindow({
                    content: building.name
                });

                infowindow.open(map, marker)
                marker.addListener('click', function() {
                    try {
                        console.log(marker.data);
                        const response = axios.delete(`/building/destroy/` + marker.data.id, {
                            headers: {
                                'x-access-token': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            },
                        }).then(response => console.log(response))
                    } catch (error) {
                        console.log(error);
                    }
                })
            });

            map.addListener('click', function(event) {

                const marker = new google.maps.Marker({
                    position: {
                        lat: event.latLng.lat(),
                        lng: event.latLng.lng()
                    },
                    map: map,
                    icon: {
                        url: svgMarkerBuilding,
                        scaledSize: new google.maps.Size(45, 45),
                        anchor: new google.maps.Point(20, 45),
                    }
                });
                // document.getElementById('submit').click()

                const modal = document.getElementById('staticBackdrop');

                document.getElementById('longitude').value = event.latLng.lng()
                document.getElementById('latitude').value = event.latLng.lat()

                modal.addEventListener('hidden.bs.modal', function(event) {
                    marker.setMap(null)
                    markers = markers.filter(m => m !== marker);
                });

                markers.push(marker);
            });
        }

        window.onload = initMap;
    </script>
</x-app-layout>
