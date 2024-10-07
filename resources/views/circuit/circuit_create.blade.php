<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            add new circuit
        </x-slot>
    </x-slot>

    <form action="{{ route('circuits.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div x-data="{
            step: 'Path',
            stepOrder(step) {
                const steps = ['Path', 'Circuit Details', 'Assign Buildings'];
                return steps.indexOf(step);
            }
        }" class="p-4 sm:p-6 lg:p-8">
            <div class="pt-10 pb-6 px-12 bg-white rounded-lg flex flex-col gap-3.5">
                <div class="flex gap-3 justify-center">
                    @foreach (['Path', 'Circuit Details', 'Assign Buildings'] as $key => $item)
                        <div class="flex flex-col w-[30%]">
                            <div :class="{
                                'bg-gray-800': step === '{{ $item }}',
                                'bg-alpha': stepOrder('{{ $item }}') < stepOrder(step),
                                'bg-gray-300': stepOrder('{{ $item }}') > stepOrder(step)
                            }"
                                class="h-1 mb-2"></div>
                            <p :class="{
                                'text-gray-800': step === '{{ $item }}',
                                'text-alpha': stepOrder('{{ $item }}') < stepOrder(step),
                                'text-gray-300': stepOrder('{{ $item }}') > stepOrder(step)
                            }"
                                class="mx-auto font-bold">{{ $item }}</p>
                        </div>
                    @endforeach
                </div>

                <div x-show="step === 'Path'" class="flex flex-col gap-3">
                    <div id="map" class="rounded h-[62vh] aspect-square"></div>
                    <input type="hidden" name="coordinates" id="coordinates" required>
                    <button id="nextBtn" type="button" @click="step = 'Circuit Details'" disabled
                        class="bg-alpha px-4 py-2 w-fit text-[#fff] border-[1.5px] border-alpha rounded-md transition-colors text-sm font-medium ml-auto flex items-center justify-center gap-2 disabled:bg-gray-300 disabled:border-gray-300 disabled:text-gray-500 disabled:opacity-50 disabled:pointer-events-none">
                        <span>Next</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75"
                            stroke="currentColor" class="size-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>

                <div x-data="{ nameInput: { en: false, ar: false, fr: false } }" x-show="step === 'Circuit Details'">
                    <div x-data="{ tab: 'English' }" class="flex-[44%] bg-white rounded-sm">
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
                                        <input @input="nameInput.en = name_en.value !== ''" class="rounded w-full"
                                            type="text" id="name_en" placeholder="name"
                                            value="{{ old('name.en') }}" name="name[en]" required>
                                    </div>

                                    <div class="flex flex-col gap-[0.5rem]">
                                        <label for="description_en" class="w-full font-bolder text-base">Text
                                            description</label>
                                        <textarea class="rounded w-full" placeholder="description" id="description_en" name="description[en]" rows="5">{{ old('description.en') }}</textarea>
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
                                            class="hidden" type="file" placeholder="audio" accept="audio/*"
                                            name="audio[en]" id="audio_en" value="{{ old('audio.en') }}">
                                    </div>
                                </div>
                            </div>

                            <div x-show="tab === 'Français'">
                                <div class="flex flex-col gap-y-[0.75rem]">
                                    <div class="flex flex-col gap-[0.5rem]">
                                        <label for="name_fr" class="w-full font-bolder text-base">Nom</label>
                                        <input @input="nameInput.fr = name_fr.value !== ''" class="rounded w-full"
                                            type="text" placeholder="nom" name="name[fr]" id="name_fr"
                                            value="{{ old('name.fr') }}" required>
                                    </div>

                                    <div class="flex flex-col gap-[0.5rem]">
                                        <label for="description_fr" class="w-full font-bolder text-base">Description
                                            texte</label>
                                        <textarea class="rounded w-full" type="text" placeholder="description" name="description[fr]"
                                            id="description_fr" rows="5">{{ old('description.fr') }}</textarea>
                                    </div>

                                    <div class="flex flex-col gap-[0.5rem]">
                                        <p class="text-base m-0">Description audio</p>
                                        <label for="audio_fr"
                                            class="p-[0.75rem] cursor-pointer flex gap-2 items-center border-[1.5px] border-gray-500 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                            </svg>
                                            <span id="audioFrPlaceholder" class="text-base text-gray-500">
                                                télécharger l'audio
                                            </span>
                                        </label>
                                        <input
                                            onchange="audioFrPlaceholder.textContent = [...this.files].map(f => f.name).join(', ')"
                                            class="hidden" type="file" placeholder="audio" accept="audio/*"
                                            name="audio[fr]" id="audio_fr" value="{{ old('audio.fr') }}">
                                    </div>
                                </div>
                            </div>

                            <div x-show="tab === 'العربية'">
                                <div class="flex flex-col gap-y-[0.75rem] text-end">
                                    <div class="flex flex-col gap-[0.5rem]">
                                        <label for="name_ar" class="text-base">الاسم</label>
                                        <input @input="nameInput.ar = name_ar.value !== ''" class="rounded text-end"
                                            type="text" placeholder="الاسم" name="name[ar]" id="name_ar"
                                            value="{{ old('name.ar') }}" required>
                                    </div>

                                    <div class="flex flex-col gap-[0.5rem]">
                                        <label for="description_ar" class="text-base">وصف النص</label>
                                        <textarea class="rounded text-end" type="text" placeholder="وصف" name="description[ar]" id="description_ar"
                                            rows="5">{{ old('description.ar') }}</textarea>
                                    </div>

                                    <div class="flex flex-col gap-[0.5rem]">
                                        <p class="text-base m-0">وصف الصوت</p>
                                        <label for="audio_ar"
                                            class="p-[0.75rem] cursor-pointer flex flex-row-reverse gap-2 items-center border-[1.5px] border-gray-500 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                            </svg>
                                            <span id="audioArPlaceholder" class="text-base text-gray-500">
                                                تحميل الصوت
                                            </span>
                                        </label>
                                        <input
                                            onchange="audioArPlaceholder.textContent = [...this.files].map(f => f.name).join(', ')"
                                            class="hidden" type="file" placeholder="audio" accept="audio/*"
                                            name="audio[ar]" id="audio_ar" value="{{ old('audio.ar') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col gap-2">
                                <p class="text-base m-0">Images</p>
                                <label for="image"
                                    class="p-[0.75rem] cursor-pointer flex gap-2 items-center border-[1.5px] border-gray-500 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                    <span id="imagesPlaceholder" class="text-base text-gray-500">
                                        upload images
                                    </span>
                                </label>
                                <input
                                    onchange="imagesPlaceholder.textContent = [...this.files].map(f => f.name).join(', ')"
                                    class="hidden" type="file" placeholder="image" multiple accept="image/*"
                                    name="image[]" id="image">
                            </div>
                            
                            <div class="flex flex-col gap-2">
                                <p class="text-base m-0">Video</p>
                                <label for="video"
                                    class="p-[0.75rem] cursor-pointer flex gap-2 items-center border-[1.5px] border-gray-500 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>
                                    <span id="videosPlaceholder" class="text-base text-gray-500">
                                        upload videos
                                    </span>
                                </label>
                                <input
                                    onchange="videosPlaceholder.textContent = [...this.files].map(f => f.name).join(', ')"
                                    class="hidden" type="file" placeholder="video" multiple accept="video/*"
                                    name="video[]" id="video">
                            </div>

                            <div class="flex justify-between mt-3.5">
                                <button type="button" @click="step = 'Path'"
                                    class="bg-white px-4 py-2 w-fit text-alpha border-[1.5px] border-alpha rounded-md text-sm font-medium flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 19.5 8.25 12l7.5-7.5" />
                                    </svg>
                                    <span>Previous</span>
                                </button>

                                <button type="button" @click="step = 'Assign Buildings'"
                                    :disabled="!(nameInput.en && nameInput.ar && nameInput.fr)"
                                    class="bg-alpha px-4 py-2 w-fit text-[#fff] border-[1.5px] border-alpha rounded-md transition-colors text-sm font-medium flex items-center justify-center gap-2 disabled:bg-gray-300 disabled:text-gray-500 disabled:border-gray-300 disabled:opacity-50 disabled:pointer-events-none">
                                    <span>Next</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.75" stroke="currentColor" class="size-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="step === 'Assign Buildings'" class="flex flex-col gap-2">
                    @foreach ($buildings as $building)
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


                            <label x-data="{ checked: false }" for="building_{{ $building->id }}"
                                class="group flex items-center gap-1 text-white rounded-md px-3.5 cursor-pointer select-none py-1.5"
                                :class="checked ? 'bg-red-500' : 'bg-black'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        :d="checked ? 'M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z' :
                                            'M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'" />
                                </svg>
                                <span x-text="checked ? 'Unassign' : 'Assign'" class="font-medium"></span>
                                <input type="checkbox" class="hidden" name="buildings[]"
                                    id="building_{{ $building->id }}" value="{{ $building->id }}"
                                    @change="checked = building_{{ $building->id }}.checked; building_{{ $building->id }}.value = building_{{ $building->id }}.checked ? '{{ $building->id }}' : ''">
                            </label>
                        </div>
                    @endforeach

                    <div class="flex justify-between mt-3.5 py-3">
                        <button type="button" @click="step = 'Circuit Details'"
                            class="bg-white px-4 py-2 w-fit text-alpha border-[1.5px] border-alpha rounded-md text-sm font-medium flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                            <span>Previous</span>
                        </button>

                        <button type="submit"
                            class="bg-alpha px-4 py-2 w-fit text-[#fff] border-[1.5px] border-alpha rounded-md transition-colors text-sm font-medium flex items-center justify-center gap-2">
                            <span>Create Circuit</span>
                        </button>
                    </div>
                </div>
            </div>
    </form>

    @vite(['resources/js/create_circuit_map.js'])
</x-app-layout>
