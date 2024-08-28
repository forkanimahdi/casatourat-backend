<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                Manage Guided Visits
            </h2>


        </div>
    </x-slot>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 text-alpha bg-white mt-4">
        <table class="w-full text-center">
            <thead>
                <tr class="cursor-pointer text-[#002d55] text-lg">
                    <td>Name</td>
                    <td>Phone</td>
                    <td>Email</td>
                    <td>People Present</td>
                    <td>Message</td>
                    <td>Submitted On</td>
                    <td>Desired Date</td>
                    <td>Approved</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($guided as $visit)
                    <tr class="h-[10vh]">
                        <td>{{ $visit->visitor->full_name }}</td>
                        <td>{{ $visit->phone }}</td>
                        <td>{{ $visit->visitor->email }}</td>
                        <td>{{ $visit->number_of_people }}</td>
                        <td class="w-[20%]">{{ $visit->message ?? "There's No Message" }}</td>
                        <td>{{ \Carbon\Carbon::parse($visit->created_at)->locale('fr')->translatedFormat('l j F') }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($visit->date)->locale('fr')->translatedFormat('l j F') }}</td>
                        <td>
                            @if ($visit->pending)
                                <form method="POST" action="{{ route('guided.clearance', $visit) }}">
                                    @csrf
                                    <button class="px-4 py-2 rounded bg-alpha text-white" type="submit"
                                        name="action" value="approve">Approve</button>
                                    <button class="px-4 py-2 rounded bg-red-500 text-white" type="submit"
                                        name="action" value="deny">Deny</button>
                                </form>
                            @else
                                @php
                                    $status = $visit->approved ? 'Approved' : 'Denied';
                                    $bgColor = $visit->approved ? 'bg-alpha/50' : 'bg-red-500/50';
                                @endphp
                                <p disabled
                                    class="px-4 py-2 rounded {{ $bgColor }} text-white m-0">{{ $status }}</p>
                            @endif
                        </td>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</x-app-layout>
