<div class="p-2 h-full flex flex-col gap-3 justify-center ">
    <div class="h-full">
        <div class="flex justify-between items-center ">
            <h3>Update building info :</h3>
            @include('building.partials.confirmation_modale')
        </div>
        <form action="{{ route('building.update', $building) }}" method="post" enctype="multipart/form-data" class="flex flex-col gap-2">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-1">
                <label for="" class='font-medium '>Buinding name</label>
                <input class="rounded-xl input input-bordered" type="text" required value="{{ $building->name }}" placeholder="name" name="name">
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class='font-medium '>Building description</label>
                <input class="rounded-xl input input-bordered " type="text" required value="{{ $building->description }}" placeholder="description" name="description">
            </div>
            <div class="flex  gap-1">
                <label for="Build-audio" class='  font-bolder w-1/2 text-base px-3 py-2 cursor-pointer text-gray-100 bg-alpha hover:text-alpha hover:bg-gray-100 border-2 border-alpha duration-500 rounded-xl flex items-center gap-2'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                    </svg>
                    Change Audio
                </label>
                <input class="rounded-xl hidden" id="Build-audio" type="file" placeholder="audio" name="audio">
                <audio controls class=" w-1/2" id="audio-preview">
                    <source src="{{ asset('storage/audios/' . $building->audio) }}">
                </audio>
            </div>
            <div class="modal-footer w-full">
                <button type="submit" class="p-2 w-full text-gray-100 bg-alpha hover:text-alpha hover:bg-gray-100 border-2 border-alpha rounded-xl duration-500">update info</button>
            </div>
        </form>
        <div class="h-3/5 mt-5">
            <h3>Update building Images :</h3>
            <form action="{{ route('building.store_image', $building) }}" class="w-full flex justify-between gap-2 py-2" enctype="multipart/form-data" method="post">
                @csrf
                <label for="add-buildImage" class='font-bolder w-2/3 text-base px-3 py-2 cursor-pointer text-gray-100 bg-alpha hover:text-alpha hover:bg-gray-100 border-2 border-alpha duration-500 rounded-xl flex gap-2'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    Select image(s)</label>
                <input multiple class="hidden" id="add-buildImage" type="file" name="image[]" required>
                <button type="submit" class="p-2 text-gray-100 bg-alpha hover:text-alpha hover:bg-gray-100 border-2 border-alpha rounded-xl duration-500">Add image</button>
            </form>
            <div class="p-2  h-4/6 overflow-y-scroll ">
                @foreach ($building->images as $image)
                <div class="p-2 flex justify-between ">
                    <div class="w-1/6 rounded-xl">
                        <img class=" rounded-xl selected-img" src="{{ asset('storage/images/' . $image->path) }}" alt="">
                    </div>
                    <div class="flex gap-2 items-center">
                        <form action="{{ route('building.update_image', $image) }}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('PUT')
                            <label for="image-build" class="cursor-pointer p-2  font-semiboldz  text-gray-100 no-underline  bg-alpha  rounded-lg shadow-md hover:shadow-lg hover:text-alpha hover:bg-gray-100 border-2 border-alpha transition duration-500 ">Choose image</label>
                            <input id="image-build" class="hidden " type="file" name="image" accept="image/*">
                            <button class="cursor-pointer p-2 font-semiboldz text-gray-100 no-underline  bg-alpha  rounded-lg shadow-md hover:shadow-lg hover:text-alpha hover:bg-gray-100 border-2 border-alpha transition duration-500 ">update</button>
                        </form>
                        <form class="flex justify-end  h-fit" action="{{ route('building.destory_image', $image) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="cursor-pointer p-2 font-semiboldz text-gray-100 no-underline  bg-red-500  rounded-lg shadow-md hover:shadow-lg hover:text-red-500 hover:bg-gray-100 border-2 border-red-500 transition duration-500 ">delete</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
