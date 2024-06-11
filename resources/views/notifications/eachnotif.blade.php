<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                Notification
            </h2>
        </div>
    </x-slot>
    <div class="w-full pt-14 px-9 flex justify-center items-center">
        <div class="w-20% bg-white p-10 rounded">
            <p><span class="font-bold">Lionel messi</span> added a review for building <span
                    class="font-bold">Mahkama</span></p>
            <div
                class="{{ $review->status == 'alert' ? 'bg-red-300 text-red-700' : ($review->status == 'satisfying' ? 'bg-emerald-300 text-emerald-700' : 'bg-amber-300 text-amber-700') }} rounded-lg px-2 py-1 w-fit mb-2">
                {{ $review->status }}
            </div>
            <p>{{ $review->content }}</p>
            <div class="flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                {{-- <?php \Carbon\Carbon::setLocale('fr'); ?> --}}
                <p class="mb-0">{{ $review->created_at->diffForHumans(\Carbon\Carbon::now()) }}</p>

            </div>
        </div>
    </div>
</x-app-layout>
