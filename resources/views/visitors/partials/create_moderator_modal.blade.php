<dialog id="addModeratorAdmin">
    <div class="w-screen h-screen fixed inset-0 bg-black/50 grid place-items-center z-10">
        <div class="bg-white rounded w-[90%] md:w-[32.5%] shadow-md pt-1.5 pb-4">
            <div class="flex justify-between py-[1.25rem] px-8 border-b border-gray-100">
                <h1 class="capitalize text-2xl font-bold">Add new Admin</h1>

                <button type="reset" onclick="addModeratorAdmin.close()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.75"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form class="px-8 pt-[0.5rem]" action="" method="POST">
                @csrf
                <!-- First & Last Name -->
                <div class="mt-[0.75rem] flex flex-col gap-1">
                        <label class="font-medium" for="full_name">First Name</label>
                        <input class="rounded-lg" name="full_name" placeholder="Full Name..." id="full_name" type="text" required>
                </div>

                <!-- Email -->
                <div class="mt-[0.75rem] flex-1 flex flex-col gap-1">
                    <label class="font-medium" for="email">Email</label>
                    <input class="rounded-lg" name="email" id="email" type="email" placeholder="Email..." required>
                </div>

                <!-- Gender -->
                <div class="mt-[0.75rem] flex-1 flex flex-col gap-1">
                    <label class="font-medium" for="gender">Gender</label>
                    <div class="flex justify-between gap-3.5">
                        <input class="peer/male" type="radio" name="gender" value="male" id="male" hidden required>
                        <label
                            class="rounded-lg border-1 border-gray-200 w-full py-2.5 relative px-10 capitalize before:top-1/2 before:-translate-y-1/2 before:left-3 before:rounded-full before:absolute before:size-[13px] before:border-[1.5px] before:border-alpha peer-checked/male:border-sky-100 peer-checked/male:before:bg-alpha peer-checked/male:before:size-3 peer-checked/male:before:border-2 peer-checked/male:before:border-sky-100 peer-checked/male:before:ring-alpha peer-checked/male:before:ring-1 peer-checked/male:bg-sky-100 peer-checked/male:text-alpha"
                            for="male">male</label>

                        <input class="peer/female" type="radio" name="gender" value="female" id="female" hidden required>
                        <label
                            class="rounded-lg border border-alpha w-full py-2.5 relative px-10 capitalize before:top-1/2 before:-translate-y-1/2 before:left-3 before:rounded-full before:absolute before:size-[13px] before:border-[1.5px] before:border-alpha peer-checked/female:border-sky-100 peer-checked/female:before:bg-alpha peer-checked/female:before:size-3 peer-checked/female:before:border-2 peer-checked/female:before:border-sky-100 peer-checked/female:before:ring-alpha peer-checked/female:before:ring-1 peer-checked/female:bg-sky-100 peer-checked/female:text-alpha"
                            for="female">female</label>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="reset" onclick="addModeratorAdmin.close()"
                        class="text-alpha px-[2.75rem] py-[0.5rem] rounded-xl font-bold uppercase">
                        cancel
                    </button>
                    <button type="submit"
                        class="bg-alpha text-white px-[2.75rem] py-[0.5rem] rounded-xl font-medium uppercase">
                        confirm
                    </button>
                </div>

            </form>
        </div>
</dialog>
