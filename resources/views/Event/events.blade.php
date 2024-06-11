<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full ">
            <h2 class="text-alpha font-semibold">
                Create Event
            </h2>
                <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-alpha dark:hover:bg-alpha dark:focus:ring-blue-800"
                    type="button">
                    Add Event
                </button>
        </div>


    </x-slot>

    <div class="w-full h-full">

        <div class="eventscontainer w-full flex justify-center">
            <div class="eventBody w-[90vw] h-fit bg-gray-100 rounded-xl">
                {{-- Header --}}
                <div class="eventheader flex flex-row-reverse justify-between px-4">


                    <!-- Main modal -->
                    <div id="default-modal" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-[110vw] md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-[40vw] max-h-full mx-auto">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 rounded-t dark:border-gray-600">
                                    <h3 class="text-2xl text-alpha font-normal">
                                        Add Event
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-alpha"
                                        data-modal-hide="default-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 space-y-4">

                                    {{-- inputs --}}
                                    <form action="{{ route('event.post') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="flex w-full justify-between">
                                            <div class="firstinput flex flex-col py-2 w-full">
                                                <label for="name" class=" py-1">Name</label>
                                                <input type="text" name="title" placeholder="insert event name"
                                                    class="rounded-lg border border-alpha w-full">
                                            </div>
                                        </div>

                                        <div class=" flex w-full justify-between">
                                            <div class="firstinput flex flex-col py-2">
                                                <label for="startDate" class=" py-1">Start Date</label>
                                                <input type="datetime-local" name="start" placeholder="00/00/0000"
                                                    class="rounded-lg border border-alpha">
                                            </div>

                                            <div class="firstinput flex flex-col py-2">
                                                <label for="endDate" class=" py-1">End Date</label>
                                                <input type="datetime-local" name="end" placeholder="00/00/0000"
                                                    class="rounded-lg border border-alpha">
                                            </div>
                                        </div>

                                        <div class=" flex flex-col w-full py-2">
                                            <label for="message" class="block mb-2 text-sm text-gray-900">Your
                                                message</label>
                                            <textarea name="description" id="message" rows="4"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Your message..."></textarea>

                                        </div>

                                        {{-- ImageInput start --}}
                                        <div class="py-2">
                                            <label class="block text-gray-700">Select Images:</label>
                                            <input name="image" type="file" id="file-input" accept="image/*"
                                                multiple class="mt-2 p-2 border border-gray-300 rounded-lg w-full">
                                        </div>
                                        <div class="preview mt-4 flex flex-wrap"></div>
                                        {{-- Image Input final --}}
                                        <button
                                            class="text-white bg-alpha hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-alpha dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Create</button>
                                    </form>





                                </div>
                                <!-- Modal footer -->

                            </div>
                        </div>
                    </div>

                    <div>
                        {{-- <h3 class="font-normal text-alpha">Current Events :</h3> --}}
                    </div>

                </div>
                {{-- Body --}}

                {{-- Card --}}
                <div class="flex flex-wrap py-4">
                    @foreach ($events as $event)
                        <div
                            class=" bg-gray-100 shadow-lg rounded-lg overflow-hidden my-4 mr-2 ml-[14px] w-[19vw] hover:scale-105 hover:border hover:bg-white transition-all duration-200">
                            <img class="w-full h-56 object-cover object-center"
                                src='{{ asset('storage/images/' . $event->image) }}' alt="avatar">
                            <div class="flex items-center justify-center px-6 py-[12px] bg-alpha">
                                <h1 class=" text-white font-semibold text-lg">{{ $event->title }}</h1>
                            </div>
                            <div class="py-4 px-6">
                                {{-- <textarea disabled
                                        class="py-2 text-md text-gray-700 w-full border-none bg-gray-100 rounded-xl transition-all hover:bg-white duration-500">{{ $event->description }}</textarea> --}}
                                <div class="flex rounded-xl mt-2 text-gray-900">
                                    <div class="timediv flex flex-col py-1">
                                        <p class="text-center font-semibold">Start</p>
                                        <h1 class="px-2 text-sm font-normal text-center">{{ $event->start }}
                                        </h1>
                                    </div>
                                    <div class="flex flex-col items-center text-gray-900 py-1">
                                        <p class="text-center font-semibold">End</p>
                                        <h1 class=" text-sm  font-normal text-center">{{ $event->end }}</h1>
                                    </div>
                                </div>
                                <div class="w-full flex justify-end pt-2">
                                    <form method="POST" class="mr-1">
                                        @csrf
                                        <a href="{{ route('events.show', $event) }}"
                                            class="px-2 py-2 mr-1 bg-alpha rounded-full text-white flex"> <svg
                                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg></a>
                                    </form>

                                    <form action={{ route('events.destroy', $event->id) }} method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-2 py-2 bg-red-500 rounded-full text-white flex"> <svg
                                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M8 3V2h4v1h5v2H3V3h5zm1 0h2V2H9v1zM4 6h12v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm2 0v10h8V6H6z" />
                                            </svg>
                                        </button>
                                    </form>


                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>


            </div>
        </div>


    </div>
</x-app-layout>
