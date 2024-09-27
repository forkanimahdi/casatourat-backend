<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            Update Circuit
        </x-slot>

        <div class="inline-flex gap-2">
            @include('circuit.partials.publish_circuit_modal')
            @include('circuit.partials.confirmation_modale')
        </div>
    </x-slot>

    <div class="flex gap-[1.25rem] p-4 sm:p-6 lg:p-8 lg:min-h-[calc(100vh-86px)]">
        <form action="{{ route('circuits.update', $circuit) }}" method="post" enctype="multipart/form-data"
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
                                value="{{ $circuit->name->en }}" name="name[en]" required>
                        </div>

                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="description_en" class="w-full font-bolder text-base">Text description</label>
                            <textarea class="rounded w-full" placeholder="description" id="description_en" name="description[en]" rows="7">{{ $circuit->description->en }}</textarea>
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
                                    src="{{ asset('storage/audios/' . $circuit->audio->en) }}"></audio>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'Français'">
                    <div class="flex flex-col gap-y-[0.75rem]">
                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="name_fr" class="w-full font-bolder text-base">Nom</label>
                            <input class="rounded w-full" type="text" placeholder="nom" name="name[fr]"
                                id="name_fr" value="{{ $circuit->name->fr }}" required>
                        </div>

                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="description_fr" class="w-full font-bolder text-base">Description texte</label>
                            <textarea class="rounded w-full" placeholder="description" name="description[fr]" id="description_fr" rows="7">{{ $circuit->description->fr }}</textarea>
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
                                    src="{{ asset('storage/audios/' . $circuit->audio->fr) }}"></audio>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'العربية'">
                    <div class="flex flex-col gap-y-[0.75rem] text-end">
                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="name.ar" class="text-base">الاسم</label>
                            <input class="rounded text-end" type="text" placeholder="الاسم" name="name[ar]"
                                id="name.ar" value="{{ $circuit->name->ar }}" required>
                        </div>

                        <div class="flex flex-col gap-[0.5rem]">
                            <label for="description_ar" class="text-base">وصف النص</label>
                            <textarea class="rounded text-end" placeholder="وصف" name="description[ar]" id="description_ar" rows="7">{{ $circuit->description->ar }}</textarea>
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
                                    src="{{ asset('storage/audios/' . $circuit->audio->ar) }}"></audio>
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
            <h5 class="m-0">Circuit images</h5>
            <div style="--gap: 0.75rem; --count: 3;" class="flex flex-wrap gap-[var(--gap)]">
                <div onclick="storeImage.click()"
                    class="w-[calc(calc(100%-calc(calc(var(--count)-1)*var(--gap)))/var(--count))] cursor-pointer aspect-square border-2 border-dashed rounded-lg flex flex-col items-center justify-center">
                    <form action="{{ route('images.store', $circuit->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $circuit->id }}">
                        <input type="hidden" name="type" value="circuit">
                        <input onchange="addImgBtn.click()" multiple name="image[]" type="file" id="storeImage"
                            accept="image/png, image/jpeg" class="mt-2 border-2 rounded w-full bg-white hidden ">
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
                            action="{{ route('images.destroy', $image) }}" method="post">
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

    <div class="p-[1.25rem]  mt-0 m-4 sm:m-6 lg:m-8 bg-white rounded-lg">
        <h5 class="mb-[1rem]">Manage Building Assignments</h5>
        <div style="--count: 2; --gap: 1.25rem" class="flex gap-[var(--gap)]">
            <div
                class="border rounded-md w-[calc(calc(100%-calc(calc(var(--count)-1)*var(--gap)))/var(--count))] py-[0.75rem] px-[1.25rem]">
                <h6 class="mb-[1rem] capitalize text-base font-semibold">Assigned Buildings</h6>
                <div class="flex flex-col gap-2">
                    @foreach ($circuit->buildings as $building)
                        <div
                            class="bg-gray-100 w-full flex justify-between px-[1rem] py-[0.5rem] items-center rounded-lg">
                            <div class="flex items-center gap-x-4">
                                <div class="size-9 rounded-lg border overflow-hidden grid place-items-center">
                                    @if ($building->images?->first()?->path)
                                        <img class="size-full"
                                            src="{{ asset('storage/images/' . $building->images?->first()?->path) }}"
                                            alt="{{ $building->name->en }}">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-3">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                                        </svg>
                                    @endif
                                </div>
                                <h4 class="text-base/none m-0">{{ $building->name->en }}</h4>
                            </div>

                            <form action="{{ route('buildings.unassign', $building) }}" method="post">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="bg-red-500 text-white p-1 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.75" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                    </svg>

                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <div
                class="border rounded-md w-[calc(calc(100%-calc(calc(var(--count)-1)*var(--gap)))/var(--count))] py-[0.75rem] px-[1.25rem]">
                <h6 class="mb-[1rem] capitalize text-base font-semibold">Available Buildings</h6>
                <div class="flex flex-col gap-2">
                    @foreach ($available_buildings as $building)
                        <div
                            class="bg-gray-100 w-full flex justify-between px-[1rem] py-[0.5rem] items-center rounded-lg">
                            <div class="flex items-center gap-x-4">
                                <div class="size-9 rounded-lg border overflow-hidden grid place-items-center">
                                    @if ($building->images?->first()?->path)
                                        <img class="size-full"
                                            src="{{ asset('storage/images/' . $building->images?->first()?->path) }}"
                                            alt="{{ $building->name->en }}">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-3">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                                        </svg>
                                    @endif
                                </div>
                                <h4 class="text-base/none m-0">{{ $building->name->en }}</h4>
                            </div>

                            <form action="{{ route('buildings.assign', $building) }}" method="post">
                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="circuit_id" value="{{ $circuit->id }}">
                                <button type="submit" class="bg-black text-white p-1 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.75" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach

                    @foreach ($draft_buildings as $building)
                        <div
                            class="bg-gray-100 w-full flex justify-between px-[1rem] py-[0.5rem] items-center rounded-lg">
                            <div class="flex items-center gap-x-4">
                                <div class="size-9 rounded-lg border overflow-hidden grid place-items-center">
                                    @if ($building->images?->first()?->path)
                                        <img class="size-full"
                                            src="{{ asset('storage/images/' . $building->images?->first()?->path) }}"
                                            alt="{{ $building->name->en }}">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-3">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                                        </svg>
                                    @endif
                                </div>
                                <h4 class="text-base/none m-0">{{ $building->name->en }}</h4>
                            </div>

                            <div class="bg-gray-400/75 cursor-not-allowed text-white/75 p-1 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.75" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
