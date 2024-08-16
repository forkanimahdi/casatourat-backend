<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                Notification
            </h2>
        </div>
    </x-slot>
    <div class="px-6 py-5 flex flex-col gap-2">

        <div class="flex justify-end px-6">
            {{-- <form action="">
                <select class="rounded-sm" name="" id="select">
                    <option selected disabled value="">Choisir un status</option>
                    <option value="">alert</option>
                    <option value="">warning</option>
                    <option value="">satisfying</option>
                </select>
                <button class="bg-alpha px-3 py-2 text-white rounded">Filtrer</button>
            </form> --}}
            <form action="{{ route('update.allnotif') }}" method="POST">
                @csrf
                @method('PUT')
                <button
                    class="flex gap-2 text-alpha cursor-pointer font-bold px-2 items-center hover:bg-gray-50 py-2 rounded">
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.56499 12.4068C4.29258 12.0947 3.81879 12.0626 3.50676 12.335C3.19472 12.6074 3.1626 13.0812 3.43501 13.3932L4.56499 12.4068ZM7.14286 16.5L6.57787 16.9932C6.7203 17.1564 6.92629 17.25 7.14286 17.25C7.35942 17.25 7.56542 17.1564 7.70784 16.9932L7.14286 16.5ZM15.565 7.99324C15.8374 7.68121 15.8053 7.20742 15.4932 6.93501C15.1812 6.6626 14.7074 6.69472 14.435 7.00676L15.565 7.99324ZM10.5064 11.5068C10.234 11.8188 10.2662 12.2926 10.5782 12.565C10.8902 12.8374 11.364 12.8053 11.6364 12.4932L10.5064 11.5068ZM9.67213 14.7432C9.94454 14.4312 9.91242 13.9574 9.60039 13.685C9.28835 13.4126 8.81457 13.4447 8.54215 13.7568L9.67213 14.7432ZM3.43501 13.3932L6.57787 16.9932L7.70784 16.0068L4.56499 12.4068L3.43501 13.3932ZM7.70784 16.9932L9.67213 14.7432L8.54215 13.7568L6.57787 16.0068L7.70784 16.9932ZM11.6364 12.4932L13.6007 10.2432L12.4707 9.25676L10.5064 11.5068L11.6364 12.4932ZM13.6007 10.2432L15.565 7.99324L14.435 7.00676L12.4707 9.25676L13.6007 10.2432Z"
                            fill="#1C274C" />
                        <path d="M20.0002 7.5625L15.7144 12.0625M11.0002 16L11.4286 16.5625L13.5715 14.3125"
                            stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="mb-0">Mark all as read</p>
                </button>
            </form>
        </div>
        <div class="px-6 flex flex-col gap-2">
            @foreach ($reviews as $review)
                <div
                    class="{{ $review->mark_read ? ' rounded border-gray-400' : 'border-2 border-blue-400' }} bg-white w-full  border-blue-400 rounded-lg px-3 py-3 flex justify-between items-start ">
                    <div>
                        <div
                            class="{{ $review->status == 'alert' ? 'bg-red-300 text-red-700' : ($review->status == 'satisfying' ? 'bg-emerald-300 text-emerald-700' : 'bg-amber-300 text-amber-700') }} rounded-lg px-2 py-1 w-fit mb-2">
                            {{ $review->status }}
                        </div>
                        <p><span
                                class="font-bold">{{ $review->visitor->first_name . ' ' . $review->visitor->last_name }}</span>
                            added a review for <span class="font-bold">{{ $review->building->name }}</span></p>
                        <p>{{ $review->content }}</p>
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            {{-- <?php \Carbon\Carbon::setLocale('fr'); ?> --}}
                            <p class="mb-0">{{ $review->created_at->diffForHumans(\Carbon\Carbon::now()) }}</p>
                        </div>
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
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-5 text-red-500">
                                    <path fill-rule="evenodd"
                                        d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    {{-- <form action="{{ route('create_comment') }}" method="post">
        @csrf
        <input type="text" name="visitor_id" placeholder="visitor_id">
        <input type="text" name="building_id" placeholder="building_id">
        <input type="text" name="content" id="" placeholder="content">
        <input type="text" name="status" placeholder="status">
        <button>add notif</button>
    </form> --}}
</x-app-layout>
