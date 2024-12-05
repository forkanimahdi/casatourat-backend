<x-app-layout>
    <x-slot name="header">
        <h2 class="text-alpha font-semibold">
            Editing {{ $event->title->en }}
        </h2>
    </x-slot>

    <section class=" w-full flex sm:flex-row flex-col justify-around gap-2 p-2 bg-gray-100 sm:h-[90vh]">
        <div x-data="{ tab: 'English' }" class="sm:w-[60%] flex flex-col gap-3 border rounded-lg p-4 bg-white">
            <h1>Event Details</h1>
            <div id="tabsBtn" class="flex bg-gray-200 w-full justify-between gap-2 p-1 rounded-lg">
                @foreach (['English', 'Français', 'العربية'] as $language)
                    <button @click="tab = '{{ $language }}'"
                        :class="{ 'bg-white text-black': tab === '{{ $language }}', 'bg-transparent text-black': tab !== '{{ $language }}' }"
                        type="button" class="w-1/3 rounded-md font-medium p-1">
                        {{ $language }}
                    </button>
                @endforeach
            </div>

            <form action="{{ route('events.update', $event) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div x-show="tab === 'English'">
                    <div class="flex flex-col py-2 px-3">
                        <label for="title_en" class="w-full font-bolder text-base">Name</label>
                        <input class="rounded" type="text" id="title_en" name="title[en]" placeholder="Event Name..."
                            value="{{ $event->title->en }}" class="r">
                    </div>


                    <div class="flex flex-col py-2 px-3">
                        <label for="description_en" class="py-1 px-1">Description</label>
                        <textarea rows="4" type="text"
                        id="description_en" name="description[en]"
                        placeholder="Description..."
                        class="rounded h-[20vh]">{{ $event->description->en }}
                            </textarea>
                    </div>

                </div>

                <div x-show="tab === 'Français'">
                    <div class="flex flex-col py-2 px-3">
                        <label for="title_fr" class="py-1 px-1">Titre:</label>
                        <input class="rounded" type="text" id="title_fr" name="title[fr]" placeholder="insert name"
                            value="{{ $event->title->fr }}" class="r">
                    </div>

                    <div class="flex flex-col py-2 px-3">
                        <label for="description_fr" class="py-1 px-1">Description:</label>
                        <textarea rows="4" type="text" id="description_fr" name="description[fr]" class="rounded h-[20vh]">{{ $event->description->fr }}
                            </textarea>
                    </div>

                </div>

                <div x-show="tab === 'العربية'">

                    <div class="flex flex-col py-2 px-3">
                        <label for="title_ar" class="py-1 px-1 self-end">العنوان</label>
                        <input class="rounded" type="text" id="title_ar" name="title[ar]" placeholder="insert name"
                            value="{{ $event->title->ar }}" class="r">
                    </div>

                    <div class="flex flex-col py-2 px-3">
                        <label for="description_ar" class="py-1 px-1 self-end">الوصف</label>
                        <textarea rows="4" type="text" id="description_ar" name="description[ar]" class="rounded h-[20vh]">{{ $event->description->ar }}
                            </textarea>
                    </div>

                </div>

                <div class="flex flex-col py-2 px-3">
                    <label for="" class="py-1 px-1">Start Date</label>
                    <input class="rounded" type="datetime-local" id="start" name="start" placeholder="insert name"
                        value="{{ $event->start }}" class="r">
                </div>

                <div class="flex flex-col py-2 px-3">
                    <label for="" class="py-1 px-1">End Date</label>
                    <input class="rounded" type="datetime-local" id="end" name="end" placeholder="insert name"
                        value="{{ $event->end }}" class="r">
                </div>
                <div class="flex justify-center py-2 px-3 sm:w-full">
                    <button type="submit" class="bg-alpha btn-block py-2 rounded text-white w-full">Save</button>
                </div>
            </form>
        </div>


        <div class="sm:w-[40%] border p-4 rounded-lg flex flex-col gap-2 bg-white">
            <h1>Event Images</h1>
            <div class="flex flex-wrap gap-3">
                <div onclick="storeImage.click()"
                    class="w-[30%] cursor-pointer aspect-square border-2 border-dashed rounded-lg flex flex-col items-center justify-center">
                    <form action="{{ route('event.store_image', $event) }}" method="post"
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
                @foreach ($event->images as $index => $image)
                    <div class="w-[30%] relative group">
                        <img class="w-full aspect-square object-cover rounded border"
                            src="{{ asset('storage/images/' . $image->path) }}" alt="">
                        <form class="flex justify-end absolute top-2 right-2"
                            action="{{ route('buildings.destory_image', [$event, $image]) }}" method="post">
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

    </section>

</x-app-layout>
