<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                create circuit
            </h2>
        </div>
    </x-slot>

    {{-- <form id="myForm" enctype="multipart/form-data"
        class=" bg-white w-fit absolute top-[25%] left-[18%] px-3 py-4 rounded-xl flex flex-col gap-3 shadow-md">
        @csrf
        <div class="flex flex-col gap-1">
            <label class="text-gray-400 ps-1" for="">Name:</label>
            <input class="rounded-xl border-gray-300 bg-gray-50" required type="text" placeholder="Name"
                id="name" name="name">
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-gray-400 ps-1" for="">Alternative:</label>
            <input class="rounded-xl border-gray-300 bg-gray-50" required type="text" placeholder="Alternative"
                id="alternative" name="alternative">
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-gray-400 ps-1" for="">Description:</label>
            <input class="rounded-xl border-gray-300 bg-gray-50" required type="text" placeholder="Description"
                id="description" name="description">
        </div>

        <div class="flex flex-col gap-1">
            <label for="image" class="block text-gray-700">Add Images:</label>
            <input type="file" name="image[]" id="image" accept="image/png, image/jpeg"
                class="mt-2 border-2 rounded w-full" required multiple>
        </div>

        <div class="flex flex-col gap-1">
            <label class="block text-gray-700" for="audio">Audio:</label>
            <input class="mt-2 border-2 rounded w-full" required type="file" placeholder="Audio" id="audio"
                name="audio" accept="audio/*">
        </div>
        <div class="flex justify-center mt-4">
            <button class="bg-alpha text-white px-4 py-1 rounded-xl font-thin w-fit shadow-lg">submit</button>
        </div>
    </form> --}}
    <div x-data="{
        step: 'Path',
        stepOrder(step) {
            const steps = ['Path', 'Circuit Details', 'Assign Buildings'];
            return steps.indexOf(step);
        }
    }" class="py-5 px-12">
        <div class="flex gap-3 justify-center">

            @foreach (['Path', 'Circuit Details', 'Assign Buildings'] as $key => $item)
                <div class="flex flex-col w-[30%]">
                    <div :class="{
                        'bg-black': step === '{{ $item }}',
                        'bg-alpha': stepOrder('{{ $item }}') < stepOrder(step),
                        'bg-slate-300': stepOrder('{{ $item }}') > stepOrder(step)
                    }"
                        class="h-2"></div>
                    <p class="mx-auto font-bold">{{ $item }} </p>
                </div>
            @endforeach
        </div>
        <div x-show="step == 'Path'" class="p-[1.25rem] bg-white flex flex-col gap-3">
            <div id="map" class="h-[80vh] relative"></div>
            <button @click="step = 'Circuit Details'"
                class="bg-alpha px-3 py-2 w-fit text-white rounded-md">Next</button>
        </div>
        <div x-show="step === 'Circuit Details'" class=" ">
            <div x-data="{ tab: 'English' }" class="flex-[44%] p-[1.25rem] bg-white rounded-sm">
                {{-- <h5 class="mb-[1rem]">Create Building</h5> --}}
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
                                <label for="description_en" class="w-full font-bolder text-base">Text
                                    description</label>
                                <textarea class="rounded w-full" type="text" placeholder="description" id="description_en" required
                                    name="description[en]" rows="5">{{ old('description.en') }}</textarea>
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
                                <label for="description_fr" class="w-full font-bolder text-base">Description
                                    texte</label>
                                <textarea class="rounded w-full" type="text" placeholder="description" name="description[fr]" id="description_fr"
                                    rows="5" required>{{ old('description.fr') }}</textarea>
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
                                    class="hidden" type="file" placeholder="audio" accept="audio/*"
                                    name="audio[fr]" id="audio_fr" value="{{ old('audio.fr') }}" required>
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
                                    rows="5" required>{{ old('description.ar') }}</textarea>
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
                                    class="hidden" type="file" placeholder="audio" accept="audio/*"
                                    name="audio[ar]" id="audio_ar" value="{{ old('audio.ar') }}" required>
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
                        <input onchange="imagesPlaceholder.textContent = [...this.files].map(f => f.name).join(', ')"
                            class="hidden" type="file" placeholder="image" multiple accept="image/*"
                            name="image[]" id="image" required>
                    </div>
                    <div class="flex justify-between py-2">
                        <button @click="step = 'Path'"
                            class="w-fit px-3 py-2 bg-alpha text-gray-100 rounded font-bold hover:shadow border-2 border-transparent hover:border-alpha hover:text-alpha hover:bg-white ">
                            Back
                        </button>
                        <button @click="step = 'Assign Buildings'"
                            class="w-fit px-3 py-2 bg-alpha text-gray-100 rounded font-bold hover:shadow border-2 border-transparent hover:border-alpha hover:text-alpha hover:bg-white ">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div x-show="step === 'Assign Buildings'" class="flex flex-col gap-2 p-3 bg-white">
            @foreach ($buildings as $building)
                <div class="bg-gray-100 w-full flex justify-between p-2 items-center ">
                    <h4>{{ $building->name->en }}</h4>
                    <button class="bg-black text-white px-3 py-2 rounded-md">+ Assign</button>
                </div>
            @endforeach
            <div class="flex justify-between py-3">
                <button @click="step = 'Circuit Details'"
                    class="px-3 py-2 bg-black text-white rounded-md">Back</button>
                <div class="flex gap-3">
                    <button class="px-3 py-2 bg-black text-white rounded-md">Withdraw</button>
                    <button class="px-3 py-2 bg-alpha text-white flex items-center gap-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                        </svg>
                        <span>Publish Circuit</span></button>
                </div>
            </div>
        </div>
    </div>

    @vite(['resources/js/create_circuit_map.js'])
</x-app-layout>
