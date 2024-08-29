<div class="p-2 h-full flex flex-col gap-3 justify-center ">
    <div class="h-full">
        {{-- TODO: Delete function for a building --}}
        <div class="flex justify-between items-center ">
            <h3>Update building info :</h3>
            @include('building.partials.confirmation_modale')
        </div>
        <form action="{{ route('building.update', $building) }}" method="post" enctype="multipart/form-data"
            class="flex flex-col gap-2">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-1">
                <label for="" class='font-medium '>Buinding name</label>
                <input class="rounded-xl" type="text" required value="{{ $building->name }}" placeholder="name"
                    name="name">
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class='font-medium '>Building description</label>
                <input class="rounded-xl " type="text" required value="{{ $building->description }}"
                    placeholder="description" name="description">
            </div>
            <div class="flex  gap-1">
                <label for="Build-audio"
                    class='  font-bolder w-1/2 text-base px-3 py-2 cursor-pointer text-gray-100 bg-alpha hover:text-alpha hover:bg-gray-100 border-2 border-alpha duration-500 rounded-xl flex items-center gap-2'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                    </svg>
                    Change Audio
                </label>
                <input class="rounded-xl hidden" id="Build-audio" type="file" placeholder="audio" name="audio">
                <audio controls class=" w-1/2" id="audio-preview">
                    <source src="{{ asset('storage/audios/' . $building->audio) }}">
                </audio>
            </div>
            <div class="flex flex-col py-2 px-3">
                <label class="block text-gray-700" for="addImage">Add an Image: </label>
                <input multiple name="image[]" type="file" id="addImage" accept="image/png, image/jpeg" multiple
                    class="mt-2 border-2 rounded w-full bg-white">
            </div>
            <div class="modal-footer w-full">
                <button type="submit"
                    class="p-2 w-full text-gray-100 bg-alpha hover:text-alpha hover:bg-gray-100 border-2 border-alpha rounded-xl duration-500">update
                    info</button>
            </div>
        </form>
        <div class="mt-5">
            <h3>Update building Images :</h3>
            <div class="p-2 flex gap-2 flex-wrap ">
                @foreach ($building->images as $index => $image)
                    <div class="p-2 flex justify-between relative h-[200px] w-[250px]" x-data="{
                        imagePreview: '{{ asset('storage/images/' . $image->path) }}',
                        file: null,
                        hasImagePreview: {{ $image->path ? 'false' : 'true' }}
                    }">

                        <!-- Display the image preview -->
                        <img :src="imagePreview" class="rounded-xl w-full selected-img aspect-square" alt="">

                        <div class="flex gap-2 items-center absolute top-[15px] right-[10px]">
                            {{-- Form for updating the image --}}
                            <form action="{{ route('building.update_image', $image) }}" class="flex items-center gap-2"
                                id="update_image_{{ $index }}" enctype="multipart/form-data" method="post">
                                @csrf
                                @method('PUT')

                                <label for="image-build_{{ $index }}"
                                    class="cursor-pointer p-2 font-semibold text-gray-100 no-underline bg-alpha rounded-lg shadow-md hover:shadow-lg hover:text-alpha hover:bg-gray-100 border-2 border-alpha transition duration-500">Change
                                    Image</label>

                                <input id="image-build_{{ $index }}" class="hidden" type="file" name="image"
                                    accept="image/png, image/jpeg"
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

                            {{-- Form for deleting the image --}}
                            <form class="flex justify-end" action="{{ route('building.destory_image', $image) }}"
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
        </div>
    </div>
</div>
