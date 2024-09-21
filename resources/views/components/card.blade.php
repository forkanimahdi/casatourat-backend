@props(['image' => '', 'title' => '', 'route' => ''])

<a href="{{ $route }}"
    class="w-[calc(calc(100%-calc(calc(var(--count)-1)*var(--gap)))/var(--count))] no-underline text-black group">
    <div class="aspect-square p-3 bg-white rounded-lg overflow-hidden border flex flex-col gap-[0.5rem]">
        <div class="relative size-full aspect-[1/0.5] rounded overflow-hidden">
            <img class="size-full aspect-[1/0.5] object-cover" src="{{ asset('storage/images/' . $image) }}"
                alt="{{ $title }}" />

            <div
                class="absolute size-full inset-0 bg-black/50 opacity-[0] group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300">
                <button @class([
                    'py-[0.5rem] px-[1rem] rounded border-2 no-underline transition-transform duration-300 text-sm font-semibold',
                    'scale-[0] text-[#fff] bg-alpha border-alpha',
                    'group-hover:scale-100 hover:text-alpha hover:bg-white hover:border-white',
                ])>
                    View details
                </button>
            </div>
        </div>

        <div class="flex justify-between gap-2">
            <h1 class="text-base/none truncate">
                {{ $title }}
            </h1>
        </div>
    </div>
</a>
