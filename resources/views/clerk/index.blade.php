<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            Create Clerk Key
        </x-slot>
        <button onclick="addClerkAdmin.show()"
            class="bg-alpha text-[#fff] md:px-[1.75rem] md:py-[0.5rem] p-2 rounded-xl font-medium border-2 border-alpha hover:bg-transparent hover:font-semibold hover:text-alpha transition-all duration-600">
            Add Key
        </button>
        @include('clerk.partials.create_clerk_modal')
    </x-slot>
    <div class="p-5">
        <div class="flex flex-col gap-3 ">
            @foreach ($clerks as $key => $clerk)
                <div x-data="{ disabled{{ $key }}: false }"
                    class="bg-white p-3 rounded flex items-center justify-between border-2 {{ $key === 0 ? ' border-green-800/50' : 'border-white' }}">
                    <form class="w-full" action="{{ route('clerk.update', $clerk) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input :disabled='disabled{{ $key }} ? false : true' value="{{ $clerk->clerk }}"
                            type="text" class="w-[50%] rounded-md" name="clerk">
                        <button :class='!disabled{{ $key }} && "hidden"'
                            class="bg-alpha px-3 py-2 text-white rounded" type="submit">Update</button>
                    </form>
                    <div class="flex gap-2">
                        <button x-on:click="disabled{{ $key }} = true" class="bg-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </button>
                        <button x-on:click.prevent="$dispatch('open-modal', 'confirm-key-deletion{{ $key }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                        <x-modal name="confirm-key-deletion{{ $key }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form action="{{ route('clerk.delete', $clerk->id) }}" method="post"
                                class="flex flex-col items-center gap-3 py-3">
                                @csrf
                                @method("Delete")
                                You sure you want to delete this key ?
                                <div>
                                    <button type="submit" class=" bg-red-500 px-4 py-2 rounded font-medium text-white">Delete</button>
                                    <button x-on:click="$dispatch('close')" type="button"
                                        class="bg-alpha px-4 py-2 rounded font-medium text-white">Cancel</button>
                                </div>
                            </form>
                        </x-modal>
                    </div>
                    {{-- @include('clerk.partials.update_clerk_modal') --}}
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
