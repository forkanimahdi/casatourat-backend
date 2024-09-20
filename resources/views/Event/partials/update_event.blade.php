<x-app-layout>
    <x-slot name="header">
        <h2 class="text-alpha font-semibold">
            Editing {{ $event->title }}
        </h2>
    </x-slot>

    <section class=" w-full flex justify-around gap-2 p-2 bg-gray-100 h-[90vh]">
        <div x-data="{ tab: 'english' }" class="w-[60%] flex flex-col gap-3 border rounded-lg p-4 bg-white">
            <h1>Event Details</h1>
            <div id="tabsBtn" class="flex bg-gray-200 w-full justify-between gap-2 p-1 rounded-lg">
                <button @click="tab = 'english'"
                    :class="{ 'bg-white text-black': tab === 'english', 'bg-transparent text-black': tab !== 'english' }"
                    type="button" class="w-1/3 rounded-md font-medium p-1 langueBtn">
                    English
                </button>
                <button @click="tab = 'french'"
                    :class="{ 'bg-white text-black': tab === 'french', 'bg-transparent text-black': tab !== 'french' }"
                    type="button" class="w-1/3 rounded-md font-medium p-1 langueBtn">
                    Français
                </button>
                <button @click="tab = 'arabic'"
                    :class="{ 'bg-white text-black': tab === 'arabic', 'bg-transparent text-black': tab !== 'arabic' }"
                    type="button" class="w-1/3 rounded-md font-medium p-1 langueBtn">
                    العربية
                </button>
            </div>

            <form action="{{ route('events.update', $event) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div x-show="tab === 'english'" x-transition>
                    <div class="flex flex-col py-2 px-3">
                        <label for="" class="py-1 px-1">Title:</label>
                        <input class="rounded" type="text" id="title" name="title" placeholder="insert name"
                            value="{{ $event->title }}" class="r">
                    </div>


                    <div class="flex flex-col py-2 px-3">
                        <label for="" class="py-1 px-1">Description</label>
                        <textarea rows="4" type="text" id="description" name="description" class="rounded h-[20vh]">{{ $event->description }}
                            </textarea>
                    </div>

                </div>

                <div x-show="tab === 'french'" x-transition>
                    <div class="flex flex-col py-2 px-3">
                        <label for="" class="py-1 px-1">Titre:</label>
                        <input class="rounded" type="text" id="title" name="title" placeholder="insert name"
                            value="{{ $event->title }}" class="r">
                    </div>

                    <div class="flex flex-col py-2 px-3">
                        <label for="" class="py-1 px-1">Description:</label>
                        <textarea rows="4" type="text" id="description" name="description" class="rounded h-[20vh]">{{ $event->description }}
                            </textarea>
                    </div>

                </div>

                <div x-show="tab === 'arabic'" x-transition>
                    {{-- <form action="{{ route('events.update', $event) }}"  method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT') --}}
                    <div class="flex flex-col py-2 px-3">
                        <label for="" class="py-1 px-1 self-end">العنوان</label>
                        <input class="rounded" type="text" id="title" name="title"
                            placeholder="insert name" value="{{ $event->title }}" class="r">
                    </div>

                    <div class="flex flex-col py-2 px-3">
                        <label for="" class="py-1 px-1 self-end">الوصف</label>
                        <textarea rows="4" type="text" id="description" name="description" class="rounded h-[20vh]">{{ $event->description }}
                            </textarea>
                    </div>





                    {{-- <div class="flex flex-col py-2 px-3">
                        <label class="block text-gray-700" for="addImage">Add an Image: </label>
                        <input multiple name="image[]" type="file" id="addImage" accept="image/*" multiple
                            class="mt-2 border-2 rounded w-full bg-white">
                    </div> --}}
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
                <div class="flex justify-center py-2 w-full">
                    <button type="submit" class="bg-alpha btn-block py-2 rounded text-white w-full">Save</button>
                </div>
            </form>
        </div>


        <div class="w-[40%] border p-4 rounded-lg flex flex-col gap-2 bg-white">
            <h1>Event Images</h1>
            <div class="flex flex-wrap gap-3">
                <div onclick="storeImage.click()"
                    class="w-[30%] cursor-pointer aspect-square border-2 border-dashed rounded-lg flex flex-col items-center justify-center">
                    <form action="{{ route('building.store_image', $event) }}" method="post"
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
                            action="{{ route('building.destory_image', [$event, $image]) }}" method="post">
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
