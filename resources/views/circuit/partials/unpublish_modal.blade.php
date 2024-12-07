<dh-component>
    <button onclick="modalHandler(UnpublishCircuitModal, true)"
        class="flex items-center font-medium gap-2 p-2 text-gray-100 no-underline bg-alpha rounded-lg hover:shadow-lg hover:text-alpha hover:bg-white border-2 border-alpha transition duration-500 ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-5 md:flex hidden">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
        </svg>
        <span class="md:flex hidden">Unpublish circuit</span>
        <span class="md:hidden flex">Unpublish </span>
    </button>

<div class="hidden py-12 bg-black/75 transition duration-150 ease-in-out z-10 fixed inset-0"
    id="UnpublishCircuitModal">
    <div role="alert" class="container flex justify-center items-center mx-auto w-11/12 md:w-2/3 max-w-lg">
        <div
            class="relative py-4 px-3  bg-white shadow-md rounded-2xl border border-gray-400 w-[80vw] md:h-[42vh]  md:w-[40vw]">
            <div class="text-center md:p-5 flex-auto justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-16 mx-auto text-alpha">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                </svg>

                <h2 class="text-lg md:text-xl font-bold py-4">Are you sure?</h2>
                <p class="text-sm text-gray-500  md:px-8">Do you really want to unpublish this circuit?</p>
            </div>

            <div class="flex flex-col-reverse md:flex-row items-center justify-center gap-3 w-full">
                <button
                    class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-6 py-2 text-sm w-full md:w-auto"
                    onclick="modalHandler(UnpublishCircuitModal)">Cancel</button>
                <form action="{{ route('circuits.unpublish', $circuit) }}" method="post" class="w-full md:w-auto">
                    @csrf
                    @method('PATCH')

                    <button
                        class="cursor-pointer p-2 px-3 font-semibold text-gray-100 no-underline bg-alpha rounded-lg shadow-md hover:shadow-lg hover:text-alpha hover:bg-gray-100 border-2 border-alpha transition duration-500 w-full md:w-auto">
                        Unpublish Circuit
                    </button>
                </form>
            </div>

            <button
                class="cursor-pointer absolute top-2 right-2 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600"
                onclick="modalHandler(UnpublishCircuitModal)" aria-label="close modal" role="button">
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
