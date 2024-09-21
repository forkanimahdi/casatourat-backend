<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            add new building
        </x-slot>
    </x-slot>

    <form action="{{ route('building.store') }}" method="post" enctype="multipart/form-data"
        class="flex gap-[1.25rem] p-4 sm:p-6 lg:p-8 lg:min-h-[calc(100vh-86px)]">
        @csrf

        <div class="flex-[55%] p-[1.25rem] bg-white rounded-lg flex flex-col gap-y-[1rem]">
            <h5 class="m-0">Choose location</h5>

            <div class="flex items-start gap-[1rem]">
                <div class="flex flex-col w-full">
                    <label class="w-full font-bolder text-base/none mb-[0.5rem]" for="latitude">Latitude</label>
                    <input type="text" class="rounded w-" id="latitude" placeholder="latitude"
                        value="{{ old('latitude') }}" name="latitude" required>
                </div>

                <div class="flex flex-col w-full">
                    <label class="w-full font-bolder text-base/none mb-[0.5rem]" for="longitude">Longtitude</label>
                    <input type="text" class="rounded w-full" id="longitude" placeholder="longitude"
                        value="{{ old('longitude') }}" name="longitude" required>
                </div>
            </div>

            <div id="map" class="flex-1 rounded"></div>
        </div>

        <div x-data="{ tab: 'English' }" class="flex-[44%] p-[1.25rem] bg-white rounded-lg">
            <h5 class="mb-[1rem]">Create Building</h5>

            <div class="flex bg-gray-200 w-full justify-between gap-2 p-1 rounded-lg">
                @foreach (['English', 'Français', 'العربية'] as $language)
                    <button @click="tab = '{{ $language }}'"
                        :class="{ 'bg-white text-black': tab === '{{ $language }}', 'bg-transparent text-black': tab !== '{{ $language }}' }"
                        type="button" class="w-1/3 rounded-md font-medium p-1">
                        {{ $language }}
                    </button>
                @endforeach
            </div>

            <div class="flex flex-col gap-2 mt-[1rem]">
                <div x-show="tab === 'English'">
                    <div class="flex flex-col gap-y-[0.75rem]">
                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="name_en" class="w-full font-bolder text-base">Name</label>
                            <input class="rounded w-full" type="text" id="name_en" placeholder="name"
                                value="{{ old('name.en') }}" name="name[en]" required>
                        </div>

                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="description_en" class="w-full font-bolder text-base">Text description</label>
                            <textarea class="rounded w-full" type="text" placeholder="description" id="description_en" required
                                value="{{ old('description.en') }}" name="description[en]" rows="5"></textarea>
                        </div>

                        <div class="flex flex-col gap-[0.5rem]">
                            <p class="text-base m-0">Audio description</p>
                            <label for="audio_en"
                                class="p-[0.75rem] cursor-pointer flex gap-2 items-center border-[1.5px] border-gray-500 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                </svg>
                                <span id="audioEnPlaceholder" class="text-base text-gray-500">
                                    upload audio
                                </span>
                            </label>
                            <input
                                onchange="audioEnPlaceholder.textContent = [...this.files].map(f => f.name).join(', ')"
                                class="hidden" type="file" placeholder="audio" accept="audio/*" name="audio[en]"
                                id="audio_en" value="{{ old('audio.en') }}" required>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'Français'">
                    <div class="flex flex-col gap-y-[0.75rem]">
                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="name_fr" class="w-full font-bolder text-base">Nom</label>
                            <input class="rounded w-full" type="text" placeholder="nom" name="name[fr]"
                                id="name_fr" value="{{ old('name.fr') }}" required>
                        </div>

                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="description_fr" class="w-full font-bolder text-base">Description texte</label>
                            <textarea class="rounded w-full" type="text" placeholder="description" name="description[fr]" id="description_fr"
                                rows="5" value="{{ old('description.fr') }}" required></textarea>
                        </div>

                        <div class="flex flex-col gap-[0.5rem]">
                            <p class="text-base m-0">Description audio</p>
                            <label for="audio_fr"
                                class="p-[0.75rem] cursor-pointer flex gap-2 items-center border-[1.5px] border-gray-500 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                </svg>
                                <span id="audioFrPlaceholder" class="text-base text-gray-500">
                                    télécharger l'audio
                                </span>
                            </label>
                            <input
                                onchange="audioFrPlaceholder.textContent = [...this.files].map(f => f.name).join(', ')"
                                class="hidden" type="file" placeholder="audio" accept="audio/*" name="audio[fr]"
                                id="audio_fr" value="{{ old('audio.fr') }}" required>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'العربية'">
                    <div class="flex flex-col gap-y-[0.75rem] text-end">
                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="name.ar" class="text-base">الاسم</label>
                            <input class="rounded text-end" type="text" placeholder="الاسم" name="name[ar]"
                                id="name.ar" value="{{ old('name.ar') }}" required>
                        </div>

                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="description_ar" class="text-base">وصف النص</label>
                            <textarea class="rounded text-end" type="text" placeholder="وصف" name="description[ar]" id="description_ar"
                                rows="5" value="{{ old('description.ar') }}" required></textarea>
                        </div>

                        <div class="flex flex-col gap-[0.5rem]">
                            <p class="text-base m-0">وصف الصوت</p>
                            <label for="audio_ar"
                                class="p-[0.75rem] cursor-pointer flex flex-row-reverse gap-2 items-center border-[1.5px] border-gray-500 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                </svg>
                                <span id="audioArPlaceholder" class="text-base text-gray-500">
                                    تحميل الصوت
                                </span>
                            </label>
                            <input
                                onchange="audioArPlaceholder.textContent = [...this.files].map(f => f.name).join(', ')"
                                class="hidden" type="file" placeholder="audio" accept="audio/*" name="audio[ar]"
                                id="audio_ar" value="{{ old('audio.ar') }}" required>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <p class="text-base m-0">Images</p>
                    <label for="image"
                        class="p-[0.75rem] cursor-pointer flex gap-2 items-center border-[1.5px] border-gray-500 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor"
                            class="size-6 flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <span id="imagesPlaceholder" class="text-base text-gray-500">
                            upload images
                        </span>
                    </label>
                    <input onchange="imagesPlaceholder.textContent = [...this.files].map(f => f.name).join(', ')"
                        class="hidden" type="file" placeholder="image" multiple accept="image/*" name="image[]"
                        id="image" required>
                </div>

                <button
                    class="mt-[0.75rem] flex items-center justify-center gap-2 p-2 bg-alpha text-gray-100 rounded w-full font-bold hover:shadow border-2 border-transparent hover:border-alpha hover:text-alpha hover:bg-white duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    Create Building
                </button>
            </div>
        </div>
    </form>

    <script>
        // let markers = [];

        // let allBuildings = @json($buildings).map(building => {
        //     return {
        //         ...building,
        //         paths: {
        //             lat: Number(building.latitude),
        //             lng: Number(building.longitude),
        //         }
        //     }
        // })

        function initMap() {
            let allCicruits = [];

            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: {
                    lat: 33.57,
                    lng: -7.59
                },
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            });

            // allBuildings.forEach(building => {
            //     const marker = new google.maps.Marker({
            //         position: building.paths,
            //         map: map,
            //         data: {
            //             id: building.id
            //         },
            //         icon: {
            //             url: svgMarkerBuilding,
            //             scaledSize: new google.maps.Size(45, 45),
            //             anchor: new google.maps.Point(20, 45),
            //         }
            //     });

            //     var infowindow = new google.maps.InfoWindow({
            //         content: building.name
            //     });

            //     infowindow.open(map, marker)
            //     marker.addListener('click', function() {
            //         try {
            //             console.log(marker.data);
            //             const response = axios.delete(`/building/destroy/` + marker.data.id, {
            //                 headers: {
            //                     'x-access-token': document.querySelector('meta[name="csrf-token"]')
            //                         .content
            //                 },
            //             }).then(response => console.log(response))
            //         } catch (error) {
            //             console.log(error);
            //         }
            //     })
            // });

            let marker;

            map.addListener('click', function(event) {
                if (marker) {
                    marker.setMap(null)
                }

                marker = new google.maps.Marker({
                    position: {
                        lat: event.latLng.lat(),
                        lng: event.latLng.lng()
                    },
                    map: map,
                    icon: {
                        url: '/storage/markers/building_marker.svg',
                        scaledSize: new google.maps.Size(45, 45),
                        anchor: new google.maps.Point(20, 45),
                    }
                });

                document.getElementById('longitude').value = event.latLng.lng()
                document.getElementById('latitude').value = event.latLng.lat()
            });
        }

        window.onload = initMap;
    </script>
</x-app-layout>
