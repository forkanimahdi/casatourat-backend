<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full ">
            <h2 class="text-alpha font-semibold">
                Event editor
            </h2>
        </div>


    </x-slot>

    <div class="bg-gray-100">
        <div class=" px-8">
            <p class="text-2xl h-[10vh] font-extralight text-black rounded-full w-[35%] flex items-center justify-center">You are editing : <span class=" font-extralight px-1 text-alpha"><b>{{ $event->title }}</b> </span> </p>
        </div>

    <section class=" w-full flex justify-around">
        <form action="{{ route("events.update" , $event) }}" class="px-4 py-4" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col py-2 px-3">
                <label for="" class="py-1 px-1">Name</label>
                <input type="text" name="title" placeholder="insert name" value="{{ $event->title }}" class="rounded-xl border border-alpha w-[30vw]">
            </div>

            <div class="flex flex-col py-2 px-3">
                <label for="" class="py-1 px-1">Start Date</label>
                <input type="datetime-local" name="start" placeholder="insert name" value="{{ $event->start }}" class="rounded-xl border border-alpha w-[30vw]">
            </div>

            <div class="flex flex-col py-2 px-3">
                <label for="" class="py-1 px-1">End Date</label>
                <input type="datetime-local" name="end" placeholder="insert name" value="{{ $event->end }}" class="rounded-xl border border-alpha w-[30vw]">
            </div>

            <div class="flex flex-col py-2 px-3">
                <label for="" class="py-1 px-1">Description</label>
                <textarea rows="4" type="text" name="description" placeholder="{{ $event->description }}" value="{{ $event->description }}" class="rounded-xl border border-alpha w-[30vw] h-[20vh]"></textarea>
            </div>

            <div class="py-2">
                <label class="block text-gray-700">Select Images:</label>
                <input name="image" required type="file" id="file-input" accept="image/*"
                    multiple class="mt-2 p-2 border border-gray-300 rounded-lg w-full">
            </div>

            <div class="flex justify-center py-2">
                <button  class="bg-alpha px-4 py-2 rounded-full text-white">Save</button>
            </div>

        </form>

        <div>
            <img src={{ asset("assets/images/edit_pic.png") }} alt="" class="w-[35vw]">
        </div>
    </section>        
    </div>


</x-app-layout>