<div x-data="{ open: true }" id="default-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-[110vw] md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-[40vw] max-h-full mx-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 rounded-t dark:border-gray-600">
                <h3 class="text-2xl text-alpha font-normal">
                    Add Event
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-800 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-alpha"
                    data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                {{-- inputs --}}


                <div id="event_map" x-show="!open" class="w-full h-[88vh]"></div>

                <form x-show='open' action="{{ route('event.post') }}" method="POST" enctype="multipart/form-data">
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
                        <input multiple name="image[]" type="file" id="file-input" accept="image/*" multiple
                            class="mt-2 p-2 border border-gray-300 rounded-lg w-full">
                    </div>
                    <div class="preview mt-4 flex flex-wrap"></div>
                    {{-- Image Input final --}}


                    {{-- hidden latitude and longitude inputs --}}
                    <div class="hidden">
                        <input type="text" id="event_lat" name="event_lat">
                        <input type="text" id="event_long" name="event_long">
                    </div>

                    <button id="event_create"
                        class="hidden text-white bg-alpha hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-alpha dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Create
                    </button>

                    <div class="flex justify-end">
                        <button x-on:click="open = false" type="button"
                            class="text-white bg-alpha hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-alpha dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Next
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
