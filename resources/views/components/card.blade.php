@props(['image' => '', 'title' => '', 'route' => ''])

<div class="w-1/3 aspect-square p-3 bg-white max-w-sm rounded-lg overflow-hidden border justify-between">
    <img class="rounded w-full h-[80%] object-cover" src="{{ asset('storage/images/' . $image) }}"
        alt="No Image For This" />

    <div class="flex justify-between pt-3 ">
        <h1 class="text-xl w-[70%]"> 
            {{ Str::limit($title, 55, '...') }}
        </h1>
        <a class="w-30%" href="{{ $route }}">
            <button
                class="text-gray-50 no-underline text-sm font-semibold bg-alpha p-2 rounded hover:text-alpha hover:bg-gray-100 border-2 border-alpha">View
                details
            </button>
        </a>
    </div>
</div>
