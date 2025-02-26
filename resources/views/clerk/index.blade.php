<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            Create Event
        </x-slot>
    </x-slot>
    <div class="flex justify-center">
        <form action="{{ route('clerk.store') }}" method="post" class="w-full" >
            @csrf
            <div class="flex flex-col items-center justify-center gap-3 p-5">
                <input type="text" placeholder="Enter Key" name="clerk" class="w-[60%]">
                <button class="bg-alpha px-3 py-2 rounded text-white w-fit">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>
