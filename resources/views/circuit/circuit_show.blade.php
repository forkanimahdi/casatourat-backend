<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                Circuit : {{ $circuit->name }}
            </h2>
        </div>
        @include('circuit.partials.confirmation_modale')
    </x-slot>

    {{-- <div class="flex pt-3 items-start justify-between gap-2 px-3 h-[85vh]">
        <div
            class="relative bg-white shadow-md rounded-xl  max-h-[100%] w-fit px-2 py-1 flex flex-col justify-between items-center ">
            <div
                class="absolute left-0 bottom-0 h-[50%] w-full z-10 rounded-xl bg-gradient-to-t from-white pointer-events-none">
            </div>
            <div class="absolute z-50 bottom-4">
                <a class="px-4 py-2 rounded-full bg-alpha text-white font-thin no-underline"
                    href="{{ route('assign_building.index', $circuit->id) }}">
                    assign building 
                </a>
            </div>
            <p class="text-gray-400 font-bold text-center m-0 py-2">BUILDINGS</p>
            <div class="overflow-y-auto scrollbar-hide [&::-webkit-scrollbar]:hidden max-h-[100%] pb-10">
                @if (count($circuit->buildings) > 0)
                    @foreach ($circuit->buildings as $building)
                        <div class="relative w-[20vw] h-[20vh] mb-3 rounded-xl pointer-events: auto"
                            style="background-image: url('{{ asset('storage/images/' . $building->images[0]->path) }}'); background-size: cover">
                            <div class="absolute inset-0 bg-black/50 h-[20vh] w-[20vw] rounded-xl">
                            </div>
                            <div class="absolute bottom-0 left-0 w-full px-2 pb-3">
                                <div class="flex justify-between rounded-xl items-center">
                                    <div>
                                        </p>
                                        <p class="text-gray-200 text-[0.8rem] font-thin m-0">
                                            {{ Str::limit($building->description, 35, '...') }}</p>
                                    </div>
                                    <form action="{{ route('circuit.unassign_building') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" class="d-none" value="{{ $building->id }}"
                                            name="building_id">
                                        <button
                                            class="border border-white px-3 py-1 rounded-full text-white font-medium">Unassign</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center h-[15vh] w-[20vw] ">
                        <p class="m-0 text-gray-600 text-[1.2rem] font-medium">No buildings assigned</p>
                        <a href="{{ route('assign_building.index', $circuit->id) }}" class="">Assign a
                            Building</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex flex-col w-full bg-white p-2 rounded-xl">
            <div class="h-[40vh] rounded-xl shadow-md" id="map">
            </div>
            <div class="w-full py-4 px-2 flex justify-between gap-6">
                <div class="w-[60%]">
                    <p class="font-medium text-[1.1rem]">{{ $circuit->name }}</p>
                    <p class="text-gray-400  h-[25vh] overflow-auto p-2 w-fit">
                        {{ $circuit->description }}</p>
                </div>
                <div class="w-[40%] flex flex-col justify-between gap-3">
                    <audio controls class=" w-full">
                        <source src="{{ asset('storage/audios/' . $circuit->audio) }}">
                        Your browser does not support the audio element.
                    </audio>
                    <div class="flex justify-between items-center">
                        <form action="{{ route('circuit.update_draft', $circuit) }}" method="post" class="">
                            @method('PUT')
                            @csrf
                            <button
                                class="px-4 py-2 rounded-full  w-[10vw] bg-alpha text-white font-thin">{{ $circuit->published ? 'unpublish' : 'publish' }}
                                circuit
                            </button>
                        </form>
                        <div class="flex gap-1 justify-end w-full">
                            <a class="" href="{{ route('circuit.update_map', $circuit) }}">
                                <button
                                    class="bg-blue-600 px-2 py-1 rounded-md text-white flex items-center justify-center gap-1">
                                    <svg fill="#000000" width="15px" height="15px" viewBox="0 0 24 24"
                                        id="update-alt-2" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg"
                                        class="icon flat-color">
                                        <path id="primary"
                                            d="M21.71,10.29a1,1,0,0,0-1.42,0L19,11.59V7a3,3,0,0,0-3-3H6A1,1,0,0,0,6,6H16a1,1,0,0,1,1,1v4.59l-1.29-1.3a1,1,0,0,0-1.42,1.42l3,3a1,1,0,0,0,1.42,0l3-3A1,1,0,0,0,21.71,10.29Z"
                                            style="fill: rgb(0, 0, 0);"></path>
                                        <path id="secondary"
                                            d="M18,18H8a1,1,0,0,1-1-1V12.41l1.29,1.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42l-3-3a1,1,0,0,0-1.42,0l-3,3a1,1,0,0,0,1.42,1.42L5,12.41V17a3,3,0,0,0,3,3H18a1,1,0,0,0,0-2Z"
                                            style="fill: rgb(44, 169, 188);"></path>
                                    </svg>
                                    <p class="m-0">Update</p>
                                </button>
                            </a>
                            <form action="{{ route('circuit.destroy', $circuit) }}" method="post" class="">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="bg-red-600 px-2 py-1 rounded-md text-white flex items-center justify-center gap-1">
                                    <svg width="15px" height="15px" viewBox="0 0 1024 1024" class="icon"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M779.5 1002.7h-535c-64.3 0-116.5-52.3-116.5-116.5V170.7h768v715.5c0 64.2-52.3 116.5-116.5 116.5zM213.3 256v630.1c0 17.2 14 31.2 31.2 31.2h534.9c17.2 0 31.2-14 31.2-31.2V256H213.3z"
                                            fill="#3688FF" />
                                        <path
                                            d="M917.3 256H106.7C83.1 256 64 236.9 64 213.3s19.1-42.7 42.7-42.7h810.7c23.6 0 42.7 19.1 42.7 42.7S940.9 256 917.3 256zM618.7 128H405.3c-23.6 0-42.7-19.1-42.7-42.7s19.1-42.7 42.7-42.7h213.3c23.6 0 42.7 19.1 42.7 42.7S642.2 128 618.7 128zM405.3 725.3c-23.6 0-42.7-19.1-42.7-42.7v-256c0-23.6 19.1-42.7 42.7-42.7S448 403 448 426.6v256c0 23.6-19.1 42.7-42.7 42.7zM618.7 725.3c-23.6 0-42.7-19.1-42.7-42.7v-256c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v256c-0.1 23.6-19.2 42.7-42.7 42.7z"
                                            fill="#5F6379" />
                                    </svg>
                                    <p class="m-0">Delete</p>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="flex gap-[1.25rem] p-4 sm:p-6 lg:p-8 lg:min-h-[calc(100vh-86px)]">
        <form action="{{ route('buildings.update', $circuit) }}" method="post" enctype="multipart/form-data"
            x-data="{ tab: 'English' }" class="flex-[60%] p-[1.25rem] bg-white rounded-lg">
            @csrf
            @method('PUT')

            <h5 class="mb-[1rem]">Circuit Details</h5>

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
                                value="{{ $circuit->name }}" name="name[en]" required>
                        </div>

                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="description_en" class="w-full font-bolder text-base">Text description</label>
                            <textarea class="rounded w-full" type="text" placeholder="description" id="description_en" required
                                name="description[en]" rows="7">{{ $circuit->description }}</textarea>
                        </div>

                        <div class="flex flex-col gap-[0.5rem]">
                            <p class="text-base m-0">Audio description</p>
                            <div class="flex gap-3 items-center">
                                <label for="audio_en"
                                    class='font-bolder text-base h-fit p-[0.5rem] flex justify-center items-center aspect-square cursor-pointer text-gray-100 border-2 border-alpha  rounded-md gap-2'>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 text-alpha">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                    </svg>
                                </label>
                                <input class="hidden" type="file" placeholder="audio" accept="audio/*"
                                    name="audio[en]" id="audio_en" />
                                <audio controls class="w-full" id="audio_preview_en"
                                    src="{{ asset('storage/audios/' . $circuit->audio) }}"></audio>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'Français'">
                    <div class="flex flex-col gap-y-[0.75rem]">
                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="name_fr" class="w-full font-bolder text-base">Nom</label>
                            <input class="rounded w-full" type="text" placeholder="nom" name="name[fr]"
                                id="name_fr" value="{{ $circuit->name }}" required>
                        </div>

                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="description_fr" class="w-full font-bolder text-base">Description texte</label>
                            <textarea class="rounded w-full" type="text" placeholder="description" name="description[fr]" id="description_fr"
                                rows="7" required>{{ $circuit->description }}</textarea>
                        </div>

                        <div class="flex flex-col gap-[0.5rem]">
                            <p class="text-base m-0">Description audio</p>
                            <div class="flex gap-3 items-center">
                                <label for="audio_fr"
                                    class='font-bolder text-base h-fit p-[0.5rem] flex justify-center items-center aspect-square cursor-pointer text-gray-100 border-2 border-alpha  rounded-md gap-2'>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 text-alpha">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                    </svg>
                                </label>
                                <input class="hidden" type="file" placeholder="audio" accept="audio/*"
                                    name="audio[fr]" id="audio_fr" />
                                <audio controls class="w-full" id="audio_preview_fr"
                                    src="{{ asset('storage/audios/' . $circuit->audio) }}"></audio>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'العربية'">
                    <div class="flex flex-col gap-y-[0.75rem] text-end">
                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="name.ar" class="text-base">الاسم</label>
                            <input class="rounded text-end" type="text" placeholder="الاسم" name="name[ar]"
                                id="name.ar" value="{{ $circuit->name }}" required>
                        </div>

                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="description_ar" class="text-base">وصف النص</label>
                            <textarea class="rounded text-end" type="text" placeholder="وصف" name="description[ar]" id="description_ar"
                                rows="7" required>{{ $circuit->description }}</textarea>
                        </div>

                        <div class="flex flex-col gap-[0.5rem]">
                            <p class="text-base m-0">وصف الصوت</p>
                            <div class="flex gap-3 items-center flex-row-reverse">
                                <label for="audio_ar"
                                    class='font-bolder text-base h-fit p-[0.5rem] flex justify-center items-center aspect-square cursor-pointer text-gray-100 border-2 border-alpha  rounded-md gap-2'>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 text-alpha">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                    </svg>
                                </label>
                                <input class="hidden" type="file" placeholder="audio" accept="audio/*"
                                    name="audio[ar]" id="audio_ar" />
                                <audio controls class="w-full" id="audio_preview_ar"
                                    src="{{ asset('storage/audios/' . $circuit->audio) }}"></audio>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="self-end mt-[0.75rem]">

                    <button type="submit"
                        class="flex items-center justify-center gap-2 py-2 px-3.5 bg-alpha text-[#fff] rounded font-bold hover:shadow border-2 border-transparent hover:border-alpha hover:text-alpha hover:bg-white duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        <span>Update Information</span>
                    </button>
                </div>
            </div>
        </form>

        <div class="flex-[40%] p-[1.25rem] bg-white rounded-lg flex flex-col gap-y-[1rem]">
            <h5 class="m-0">Building images</h5>
            <div style="--gap: 0.75rem; --count: 3;" class="flex flex-wrap gap-[var(--gap)]">
                <div onclick="storeImage.click()"
                    class="w-[calc(calc(100%-calc(calc(var(--count)-1)*var(--gap)))/var(--count))] cursor-pointer aspect-square border-2 border-dashed rounded-lg flex flex-col items-center justify-center">
                    <form action="{{ route('buildings.store_image', $circuit) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input onchange="addImgBtn.click()" multiple name="image[]" type="file" id="storeImage"
                            accept="image/png, image/jpeg" multiple
                            class="mt-2 border-2 rounded w-full bg-white hidden ">
                        <button class="hidden" id="addImgBtn">confirm</button>
                    </form>
                    <label class="block text-gray-700">Add an Image: </label>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>

                @foreach ($circuit->images as $index => $image)
                    <div
                        class="w-[calc(calc(100%-calc(calc(var(--count)-1)*var(--gap)))/var(--count))] relative group">
                        <img class="w-full aspect-square object-cover rounded border"
                            src="{{ asset('storage/images/' . $image->path) }}" alt="">
                        <form class="flex justify-end absolute top-2 right-2"
                            action="{{ route('buildings.destory_image', $image) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button
                                class="cursor-pointer hidden group-hover:block p-[0.25rem] font-semibold text-gray-100 no-underline bg-red-500 rounded-lg hover:text-red-500 hover:bg-[#fff] border-2 border-red-500 transition duration-200 ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="px-4 pb-7 ">
        <div class="bg-white p-[1.25rem]  rounded-lg">
            <h5>Assigned Building</h5>
            <!-- Button trigger modal -->
            <button type="button" class="bg-alpha flex items-center gap-2 px-3 py-2 text-white rounded-md"
                data-bs-toggle="modal" data-bs-target="#assignBuild">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                </svg>
                Assign Building
            </button>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="assignBuild" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal- flex justify-between p-3">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Assign Building to Circuit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select class="w-full rounded-lg" name="" id="">
                        <option class="rounded-lg" selected disabled value="">Select a build</option>
                        @foreach ($buildings as $build)
                            <option class="rounded-lg" value="{{ $build->name->en }}">{{ $build->name->en }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>


    <script>
        let circuit_path = @json($circuit->paths).map(path => {
            return {
                ...path,
                lat: Number(path.latitude),
                lng: Number(path.longitude),
            }
        })

        let circuit_buildings = @json($circuit->buildings).map(building => {
            return {
                ...building,
                path: {
                    lat: Number(building.latitude),
                    lng: Number(building.longitude),
                }
            }
        })
    </script>
    @vite(['resources/js/show_circuit_map.js'])
</x-app-layout>
