<div class="p-2 flex flex-col gap-3 justify-center ">
    <div class="">
        <form action="{{ route('building.update', $building) }}" method="post" enctype="multipart/form-data" class="flex flex-col gap-3">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-1">
                <label for="" class='font-medium '>name</label>
                <input class="rounded-xl" type="text" required value="{{ $building->name }}" placeholder="name" name="name">
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class='font-medium '>description</label>
                <input class="rounded-xl " type="text" required value="{{ $building->description }}" placeholder="description" name="description">
            </div>
            <div class="flex flex-col gap-1">
                <label for="Build-audio" class='font-bolder text-base px-3 py-2 cursor-pointer text-gray-100 bg-alpha hover:text-alpha hover:bg-gray-100 hover:border-2 hover:border-alpha duration-75 rounded-xl flex gap-2'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                    </svg>
                    Add Audio
                </label>
                <input class="rounded-xl hidden" id="Build-audio" type="file" placeholder="audio" name="audio">
            </div>
            <div>
                <form action="{{ route('building.store_image', $building) }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <label for="">add image</label>
                    <input multiple type="file" name="image[]">
                    <button class="btn btn-primary">Add image</button>
                </form>
                @foreach ($building->images as $image)
                <div class="border border-blue-500 flex">
                    <img src="{{ asset('storage/images/' . $image->path) }}" width="50" alt="">
                    <form action="{{ route('building.destory_image', $image) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">delete</button>
                    </form>
                    <form action="{{ route('building.update_image', $image) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <input type="file" name="image">
                        <button class="btn btn-secondary">update</button>
                    </form>
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="submit" class="p-2 text-gray-100 bg-alpha hover:text-alpha hover:bg-gray-100 hover:border-2 hover:border-alpha rounded-xl duration-75">update</button>
            </div>
        </form>
    </div>
</div>