<!-- Button trigger modal -->
<button id="submit" type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#addbuilding">
    submit circuit
</button>

<!-- Modal -->
<div class="modal fade" id="addbuilding" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('building.store') }}" class="flex flex-col items-center gap-2" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col w-full items-center">
                        <label for="" class="w-3/4 font-bolder text-base">Name</label>
                        <input class="rounded w-3/4" type="text" placeholder="name" name="name">
                    </div>
                    <div class="flex flex-col w-full items-center">
                        <label for="" class="w-3/4 font-bolder text-base">Description</label>
                        <input class="rounded w-3/4" type="text" placeholder="description" name="description">
                    </div>
                    <div class="flex flex-col py-2 cursor-pointer items-center bg-alpha rounded text-gray-100 w-3/4">
                        <label for="audio" class="w-3/4 font-bolder text-base flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                            </svg>
                            Upload Audio
                        </label>
                        <input id="audio" class="rounded w-3/4 d-none" type="file" placeholder="audio" name="audio" accept="audio/*" >
                    </div>
                    <div class="flex flex-col py-2 cursor-pointer items-center bg-alpha rounded text-gray-100 w-3/4">
                        <label for="image" class="w-3/4 font-bolder text-base flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            Upload Image
                        </label>
                        <input id="image" class="rounded w-3/4 d-none" type="file" placeholder="image" multiple name="image[]" accept="image/*">
                    </div>
                    <div class="d-none">
                        <input type="text" id="latitude" placeholder="latitude" name="latitude">
                    </div>
                    <div class="d-none ">
                        <input type="text" id="longitude" placeholder="longitude" name="longitude">
                    </div>
                    <button class="p-2 bg-alpha text-gray-100 rounded w-3/4 font-bold hover:shadow hover:border-2 hover:border-alpha hover:text-alpha hover:bg-gray-100 duration-200">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
