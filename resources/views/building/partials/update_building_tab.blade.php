<div>
    <div class="flex justify-between min-h-screen gap-2 ">
        <div class="w-[60%] flex flex-col gap-3 border rounded-lg p-4 bg-white">
            <h1>Building Details</h1>
            <div id="tabsBtn" class="flex bg-gray-200 w-full justify-between gap-2 p-1 rounded-lg">
                <button id="btnEnglish" type="button" class="w-1/3 rounded-md font-medium p-1 langueBtn">English</button>
                <button id="btnFrench" type="button" class="w-1/3 rounded-md font-medium p-1 langueBtn">Français</button>
                <button id="btnArabic" type="button"
                    class="w-1/3 rounded-md font-medium p-1 langueBtn">العربية</button>
            </div>
            <form id="english_version" class="block" action="{{ route('building.update', $building) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-2">
                    <label class="font-medium" for="bname">Building Name</label>
                    <input class="rounded-md" type="text" name="name" id="bname" required
                        value="{{ $building->name }}" placeholder="Enter building name">
                </div>
                <div class="flex flex-col gap-2">
                    <label class="font-medium" for="desc">Building Description</label>
                    <textarea class="rounded-md" name="description" placeholder="Enter building description" id="desc" cols="30"
                        rows="10" required>{{ $building->description }}</textarea>
                </div>
                <div class="flex flex-col gap-2 ">
                    <label class="font-medium">Audio Description</label>
                    <div class="flex gap-3 items-center">
                        <label for="Build-audio"
                            class='font-bolder text-base h-fit p-[0.5rem] flex justify-center items-center aspect-square cursor-pointer text-gray-100 border-2 border-alpha  rounded-md gap-2'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 text-alpha">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                            </svg>
                        </label>
                        <input class="rounded-md hidden" id="Build-audio" type="file" placeholder="audio"
                            name="audio"> <audio controls class=" w-full" id="audio-preview">
                            <source src="{{ asset('storage/audios/' . $building->audio) }}">
                        </audio>
                    </div>
                </div>
                <div class="flex justify-end pt-6">
                    <button type="submit" class="bg-alpha px-3 py-2 text-white rounded-lg">Update
                        Information</button>
                </div>
            </form>
            <form id="french_version" class="hidden" action="" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-2">
                    <label class="font-medium" for="bname">Nom du bâtiment</label>
                    <input class="rounded-md" type="text" name="name" id="bname" required
                        placeholder="Entrez le nom de bâtiment">
                </div>
                <div class="flex flex-col gap-2">
                    <label class="font-medium" for="desc">Description du bâtiment</label>
                    <textarea class="rounded-md" name="description" placeholder="Entrez la description du bâtiment" id="desc"
                        cols="30" rows="10" required></textarea>
                </div>
                <div class="flex flex-col gap-2 ">
                    <label class="font-medium">Description audio</label>
                    <div class="flex gap-3 items-center">
                        <label for="Build-audio"
                            class='font-bolder text-base h-fit p-[0.5rem] flex justify-center items-center aspect-square cursor-pointer text-gray-100 border-2 border-alpha  rounded-md gap-2'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 text-alpha">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                            </svg>
                        </label>
                        <input class="rounded-md hidden" id="Build-audio" type="file" placeholder="audio"
                            name="audio"> <audio controls class=" w-full" id="audio-preview">
                            <source src="">
                        </audio>
                    </div>
                </div>
                <div class="flex justify-end pt-6">
                    <button type="submit" class="bg-alpha px-3 py-2 text-white rounded-lg">Update
                        Information</button>
                </div>
            </form>
            <form id="arabic_version" class="hidden" action="" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-col text-right gap-2">
                    <label class="font-medium" for="bname">اسم المبنى</label>
                    <input class="rounded-md text-right" type="text" name="name" id="bname" required
                        value="" placeholder="أدخل اسم المبنى ">
                </div>
                <div class="flex flex-col text-right gap-2">
                    <label class="font-medium" for="desc">وصف المبنى</label>
                    <textarea class="rounded-md text-right" name="description" placeholder="أدخل وصف المبنى" id="desc"
                        cols="30" rows="10" required></textarea>
                </div>
                <div class="flex flex-col gap-2 text-right">
                    <label class="font-medium">الوصف الصوتي</label>
                    <div class="flex gap-3 items-center flex-row-reverse">
                        <label for="Build-audio"
                            class='font-bolder text-base h-fit p-[0.5rem] flex justify-center items-center aspect-square cursor-pointer text-gray-100 border-2 border-alpha  rounded-md gap-2'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 text-alpha">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                            </svg>
                        </label>
                        <input class="rounded-md hidden" id="Build-audio" type="file" placeholder="audio"
                            name="audio"> <audio controls class=" w-full" id="audio-preview">
                            <source src="">
                        </audio>
                    </div>
                </div>
                <div class="flex justify-end pt-6">
                    <button type="submit" class="bg-alpha px-3 py-2 text-white rounded-lg">Update
                        Information</button>
                </div>
            </form>
        </div>
        <div class="w-[40%] border p-4 rounded-lg flex flex-col gap-2 bg-white">
            <h1>Building Images</h1>
            <div class="flex flex-wrap gap-3">
                <div onclick="storeImage.click()"
                    class="w-[30%] cursor-pointer aspect-square border-2 border-dashed rounded-lg flex flex-col items-center justify-center">
                    <form action="{{ route('building.store_image', $building) }}" method="post"
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
                @foreach ($building->images as $index => $image)
                    <div class="w-[30%] relative group">
                        <img class="w-full aspect-square object-cover rounded border"
                            src="{{ asset('storage/images/' . $image->path) }}" alt="">
                        <form class="flex justify-end absolute top-2 right-2"
                            action="{{ route('building.destory_image', $image) }}" method="post">
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

</div>
