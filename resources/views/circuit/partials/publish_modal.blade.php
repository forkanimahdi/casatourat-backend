<dh-component>
    <button onclick="modalHandler(publishCircuitModal, true)"
        class="flex items-center font-medium gap-2 p-2 text-gray-100 no-underline bg-alpha rounded-lg hover:shadow-lg hover:text-alpha hover:bg-white border-2 border-alpha transition duration-500 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
        <span>Publish circuit</span>
    </button>

    <div class="hidden py-12 bg-black/75 transition duration-150 ease-in-out z-10 fixed inset-0" id="publishCircuitModal">
        <div
            class="container flex justify-center items-center mx-auto w-11/12 sm:w-full md:w-2/3 max-w-lg px-2 sm:px-0">
            <div
                class="relative py-8 px-5 sm:px-4 md:px-10 w-[80vw]   md:w-[40vw] bg-white shadow-md rounded-2xl border border-gray-400">
                <div class="text-center  flex-auto justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-16 mx-auto text-alpha">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                    </svg>
    
                    <h2 class="text-xl font-bold md:py-4 ">Are you sure?</h2>
                    <p class="text-sm text-gray-500 px-4 sm:px-2 md:px-8">Do you really want to publish this circuit?</p>
                </div>
    
                <div class="flex flex-col-reverse md:flex-row items-center justify-center gap-3 w-full">
                    <button
                        class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 md:w-fit w-full bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-6 py-2 text-sm">
                        Cancel
                    </button>
                    <form action="{{ route('circuits.publish', $circuit) }}" method="post" class="flex justify-center">
                        @csrf
                        @method('PATCH')
    
                        <button
                            class="cursor-pointer md:px-4 px-[17.5vw] py-2 font-semiboldz  text-gray-100 no-underline bg-alpha rounded-lg shadow-md hover:shadow-lg hover:text-alpha hover:bg-gray-100 border-2 border-alpha transition duration-500  md:w-fit w-full">
                            Publish Circuit
                        </button>
                    </form>
                </div>
    
                <button
                    class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600"
                    onclick="modalHandler(publishCircuitModal)" aria-label="close modal" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20"
                        height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
</dh-component>
