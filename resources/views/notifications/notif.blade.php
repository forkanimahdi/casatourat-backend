<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                Notification
            </h2>
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
