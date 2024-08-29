<x-app-layout>
    <x-slot name="header">
            <h2 class="text-alpha font-semibold">
                Editing {{$event->title}}
            </h2>
    </x-slot>

    <section class=" w-full flex justify-around bg-gray-100 h-[90vh]">
        <form action="{{ route('events.update', $event) }}" class="px-4" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col py-2 px-3">
                <label for="" class="py-1 px-1">Title:</label>
                <input class="rounded" type="text" id="title" name="title" placeholder="insert name"
                    value="{{ $event->title }}" class="r">
            </div>

            <div class="flex flex-col py-2 px-3">
                <label for="" class="py-1 px-1">Start Date</label>
                <input class="rounded" type="datetime-local" id="start" name="start" placeholder="insert name"
                    value="{{ $event->start }}" class="r">
            </div>

            <div class="flex flex-col py-2 px-3" >
                <label for="" class="py-1 px-1">End Date</label>
                <input class="rounded" type="datetime-local" id="end" name="end" placeholder="insert name"
                    value="{{ $event->end }}" class="r">
            </div>

            <div class="flex flex-col py-2 px-3">
                <label for="" class="py-1 px-1">Description</label>
                <textarea rows="4" type="text" id="description" name="description"
                    class="rounded w-[30vw] h-[20vh]">{{ $event->description }}
                    </textarea>
            </div>


            <div class="flex flex-col py-2 px-3">
                <label class="block text-gray-700" for="addImage">Add an Image: </label>
                <input multiple name="image[]" type="file" id="addImage" accept="image/*" multiple
                    class="mt-2 border-2 rounded w-full bg-white">
            </div>
            <div class="flex justify-center py-2 w-full">
                <button type="submit" class="bg-alpha btn-block py-2 rounded text-white w-full">Save</button>
            </div>
        </form>

        <div class="py-2 h-fit w-[50%] flex flex-wrap">
            {{-- With alpine, the user can preview the image before updating it --}}
            {{-- The code is experimental and not needed. Tell me to delete it if it creates any problems later --}}
            @foreach ($event->images as $index => $image)
                <div class="p-2 flex justify-between relative h-[200px] w-[250px]" x-data="{
                    imagePreview: '{{ asset('storage/images/' . $image->path) }}',
                    file: null,
                    hasImagePreview: {{ $image->path ? 'false' : 'true' }}
                }">

                    <!-- Display the image preview -->
                    <img :src="imagePreview" class="rounded-xl w-full selected-img aspect-square" alt="">

                    <div class="flex gap-2 items-center absolute top-[15px] right-[10px]">
                        {{-- the id is for updating which form --}}
                        <form action="{{ route('building.update_image', $image) }}" class="flex items-center gap-2"
                            id="update_image_{{ $index }}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('PUT')

                            <label for="image-build_{{ $index }}"
                                class="cursor-pointer p-2 font-semibold text-gray-100 no-underline bg-alpha rounded-lg shadow-md hover:shadow-lg hover:text-alpha hover:bg-gray-100 border-2 border-alpha transition duration-500">Change
                                Image</label>

                            {{-- onchange: change the imagePreview to the selected file  --}}
                            <input id="image-build_{{ $index }}" class="hidden" type="file" name="image"
                                accept="image/*"
                                @change="file = $event.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => imagePreview = e.target.result;
                                    reader.readAsDataURL(file);
                                    hasImagePreview = true;
                                }">

                            <button form="update_image_{{ $index }}"
                                :class="{ 'bg-green-500': hasImagePreview, 'hidden': !hasImagePreview }"
                                class="cursor-pointer p-2 font-semibold text-gray-100 no-underline rounded-lg shadow-md ">

                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.5 12.5L10.5 14.5L15.5 9.5" stroke="#FFFFFF" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7"
                                        stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </button>
                        </form>

                        {{-- DELETING AN IMAGE --}}
                        <form class="flex justify-end" action="{{ route('events.delete_image', [$event, $image]) }}"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button
                                class="cursor-pointer p-2 font-semibold text-gray-100 no-underline bg-red-500 rounded-lg shadow-md hover:shadow-lg hover:text-red-500 hover:bg-gray-100 border-2 border-red-500 transition duration-200 ">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M8 3V2h4v1h5v2H3V3h5zm1 0h2V2H9v1zM4 6h12v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm2 0v10h8V6H6z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach


        </div>

    </section>

</x-app-layout>
