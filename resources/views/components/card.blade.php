@props(['image' => '', 'title' => '', 'route' => ''])

<div
    class="w-[calc(calc(100%-calc(2*0.75rem))/3)] aspect-square p-3 bg-white rounded-lg overflow-hidden border flex flex-col gap-3">
    <img class="rounded size-full aspect-[1/0.5] object-cover" src="{{ asset('storage/images/' . $image) }}"
        alt="{{ $title }}" />

    <div class="flex justify-between gap-2">
        <h1 class="text-xl w-[70%] truncate">
            {{ $title }}
        </h1>
        <a class="w-[30%]" href="{{ $route }}">
            <button
                class="text-gray-50 w-full no-underline text-sm font-semibold bg-alpha p-2 rounded hover:text-alpha hover:bg-gray-100 border-2 border-alpha">
                View details
            </button>
        </a>
    </div>
</div>
