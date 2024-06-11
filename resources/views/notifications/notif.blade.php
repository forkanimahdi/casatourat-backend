<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                Notification
            </h2>

            {{-- <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5 cursor-pointer" id="notif_bell">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
                <div id="notif_body"
                    class="hidden notif_body bg-gray-200 overflow-auto w-[25vw] absolute gap-2 flex-col p-2 right-2 z-50">
                    @foreach ($reviews as $review)
                        <a href="{{ route("notif.show", $review) }}" class="no-underline">
                            <div
                                class="{{ $review->mark_read ? 'bg-white' : ' bg-indigo-100' }} w-full relative p-2 rounded flex gap-1 cursor-pointer no-underline decoration-black text-black">
                                <div
                                    class="{{ $review->status == 'alert' ? 'bg-red-700' : ($review->status == 'satisfying' ? 'bg-emerald-700' : 'bg-amber-500') }} w-2 absolute left-0 top-0 h-[4.9rem]  rounded-l">
                                </div>

                                <div class="w-full px-2">
                                    <div class="flex justify-between items-center w-full">
                                        <p class="mb-0">
                                            <span class="font-bold">Lionel Messi</span> added a review for
                                            <span class="font-bold">Mahkama</span>
                                        </p>
                                        <div class="flex justify-start items-center ">
                                            <form action="{{ route('update.notif', $review) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button class="p-1 hover:bg-gray-100 hover:p-1 hover:rounded-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-3 cursor-pointer">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m4.5 12.75 6 6 9-13.5" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <form action="{{ route('notif.delete', $review) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class=" p-1 hover:bg-gray-100 hover:p-1 hover:rounded-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-3 cursor-pointer">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                    </div>

                                    <p class="truncate max-w-[20vw]">{{ $review->content }}</p>
                                </div>
                            </div>
                    @endforeach
                    </a>
                </div>

            </div> --}}
        </div>
    </x-slot>
    <div class="px-3 py-2 flex  flex-col gap-2">
        <h1>Notification</h1>
        <div>
            <form action="">
                <select class="rounded-sm" name="" id="select">
                    <option selected disabled value="">Choisir un status</option>
                    <option value="">alert</option>
                    <option value="">warning</option>
                    <option value="">satisfying</option>
                </select>
                <button class="bg-alpha px-3 py-2 text-white rounded">Filtrer</button>
            </form>
        </div>
        <div class="bg-white   flex flex-col gap-2">

            @foreach ($reviews as $review)
                <div
                    class="{{ $review->mark_read ? 'border-b-2 rounded-none border-gray-400' : 'border-2 border-blue-400' }} bg-white w-full  border-blue-400 rounded-lg px-3 py-3 flex justify-between items-start ">
                    <div>
                        <div
                            class="{{ $review->status == 'alert' ? 'bg-red-300 text-red-700' : ($review->status == 'satisfying' ? 'bg-emerald-300 text-emerald-700' : 'bg-amber-300 text-amber-700') }} rounded-lg px-2 py-1 w-fit mb-2">
                            {{ $review->status }}
                        </div>
                        <p><span class="font-bold">Lionel Messi</span> added a review for <span
                                class="font-bold">Mahkama</span></p>
                        <p>{{ $review->content }}</p>
                        <p>{{ $review->created_at->format('j F Y, h:i') }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <form action="{{ route('update.notif', $review) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="p-1 hover:bg-gray-100 hover:p-1 hover:rounded-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </button>
                        </form>
                        <form action="{{ route('notif.delete', $review) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class=" p-1 hover:bg-gray-100 hover:p-1 hover:rounded-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <form action="{{ route('create_comment') }}" method="post">
        @csrf
        <input type="text" name="visitor_id" placeholder="visitor_id">
        <input type="text" name="building_id" placeholder="building_id">
        <input type="text" name="content" id="" placeholder="content">
        <input type="text" name="status" placeholder="status">
        <button>add notif</button>
    </form>
</x-app-layout>
