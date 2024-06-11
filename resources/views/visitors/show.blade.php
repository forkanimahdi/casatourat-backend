<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                User Details
            </h2>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 text-alpha">
        <div class="bg-white overflow- shadow-sm sm:rounded-lg px-6 py-3">
            <div class="py-3 border-b-2 border-b-gray-100">
                <h5>User Properties</h5>
            </div>
            <div class="py-2 flex gap-3 flex-wrap">
                <div class="px-3">
                    <h5 class="text-sm m-0 font-normal">First name</h5>
                    <span class="text-lg">{{ $visitor->first_name }}</span>
                </div>
                <div class="px-3">
                    <h5 class="text-sm m-0 font-normal">Last name</h5>
                    <span class="text-lg">{{ $visitor->last_name }}</span>
                </div>
                <div class="px-3">
                    <h5 class="text-sm m-0 font-normal">Email</h5>
                    <span class="text-lg">{{ $visitor->email }}</span>
                </div>
                <div class="px-3">
                    <h5 class="text-sm m-0 font-normal">Gender</h5>
                    <span class="text-lg">{{ $visitor->gender }}</span>
                </div>
                <div class="px-3">
                    <h5 class="text-sm m-0 font-normal">Age</h5>
                    <span class="text-lg">{{ $visitor->age }}</span>
                </div>
                <div class="px-3">
                    <h5 class="text-sm m-0 font-normal">Phone</h5>
                    <span class="text-lg">0606060606</span>
                </div>
            </div>
        </div>
        <div class="bg-white overflow- shadow-sm sm:rounded-lg px-6 py-3 mt-2">
            <table class="w-full">
                <thead>
                    <tr class="flex justify-around py-2">
                        @foreach (['building' => 'flex-[30%]', 'comment' => 'flex-[100%]', 'status' => 'flex-[30%]', 'date' => 'flex-[50%]'] as $item => $flex)
                            <th class="{{ $flex }} capitalize">{{ $item }}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody id="table">
                    @foreach ($visitor->comments as $comment)
                        <tr class="w-ful flex items-center  justify-around border-t border-gray-200 r rounded-lg trow">
                            <td class="flex-[30%] flex items-center gap-3 font-medium">
                                <img class="rounded-full size-8" src="{{ asset('assets/images/bannerevents.jpg') }}"
                                    alt="">
                                {{ $comment->name }}
                            </td>
                            <td class="flex-[100%]">{{ Str::limit($comment->pivot->content, 71, '...') }}</td>
                            <td class="flex-[30%]">
                                <span style="${styles[visitor.role]}"
                                    class="text-sm rounded-lg px-2 py-1 w-fit mb-2 {{ $comment->pivot->status == 'alert' ? 'bg-red-300 text-red-700' : ($comment->pivot->status == 'satisfying' ? 'bg-emerald-300 text-emerald-700' : 'bg-amber-300 text-amber-700') }}">
                                    {{ $comment->pivot->status }}
                                </span>
                            </td>
                            <td class="flex-[50%]">{{ $comment->pivot->created_at }}</td>
                            <td>
                                <a href="/notiffication/{{ $comment->pivot->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-4 hidden text-white cursor-pointe">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
