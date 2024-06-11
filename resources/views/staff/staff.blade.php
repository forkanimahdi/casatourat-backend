<x-app-layout>
    <div class="d-flex justify-end p-3 ">
        {{-- <button class="bg-alpha text-white px-2 py-2 rounded-lg">Add Moderator</button> --}}
        @include('staff.components.add_moderator')
    </div>
    <div class="px-5 py-1 flex flex-wrap gap-4 ">
        @foreach ($staffs as $staff)
            <div class="bg-white relative w-52 py-3 px-2 rounded-lg">
                <div
                    class="bg-lime-200 w-24 h-24 absolute -top-7 left-14 rounded-full text-4xl flex justify-center items-center">
                    <h1>{{ $firstLetter_firstNames[$staff->id] }}{{ $firstLetter_lastNames[$staff->id] }}</h1>
                </div>
                <div class="flex flex-col text-center w-full">
                    <p class="mt-16 mb-0">{{ $staff->first_name }}  {{ $staff->last_name }}</p>
                    {{-- <p class="mb-0">{{ $staff->role }}</p> --}}
                    <p class="mb-0">{{ $staff->email }}</p>
                </div>
                <form action="{{ route('delete_admin', $staff) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="w-full d-flex justify-center mt-2">
                        <button class="bg-red-500 px-2 py-1 text-white rounded-lg">Delete</button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</x-app-layout>
