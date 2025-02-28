<dialog id="addClerkAdmin">
    <div class="w-screen h-screen fixed inset-0 bg-black/50 grid place-items-center z-10">
        <div class="flex flex-col justify-center bg-white w-[50%] rounded">
            <div class="flex justify-between py-[1.25rem] px-8 border-b border-gray-100">
                <h1 class="capitalize text-2xl font-bold">Create key Clerk</h1>
                <button type="reset" onclick="addClerkAdmin.close()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.75"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form action="{{ route('clerk.store') }}" method="post" class="w-full">
                @csrf
                <div class="flex flex-col items-center justify-center gap-3 p-5">
                    <input type="text" placeholder="Enter Key" name="clerk" class="w-[60%]">
                    <button class="bg-alpha px-3 py-2 rounded text-white w-fit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</dialog>
