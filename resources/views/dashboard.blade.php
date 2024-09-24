<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            Dashboard
        </x-slot>
    </x-slot>

    <div class="overflow-hidden p-4 sm:p-6 lg:p-8">
        <div class="flex flex-col gap-[1.5rem]">
            <div class="flex gap-[1rem]">
                @foreach ($states as $state)
                    <div class="bg-white rounded-lg shadow-sm flex-1 p-[1.25rem]">
                        <div class="flex justify-between items-center">
                            <h5 class="capitalize text-base">{{ $state['name'] }}</h5>
                            <div class="rounded-full size-8 flex items-center justify-center {{ $state['bgColor'] }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $state['svgPath'] }}" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-[0.875rem]">
                            <p class="m-0 font-bold text-2xl">{{ $state['stats'] }}</p>
                            <p class="m-0 text-gray-500">
                                <span @class([
                                    'font-medium',
                                    'text-green-500' => $state['op'] == '+',
                                    'text-red-500' => $state['op'] == '-',
                                ])>{{ $state['op'] }}{{ $state['amount'] }}%</span>
                                <span> from last month</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex gap-[1rem]">
                <div class="bg-white rounded-lg flex flex-col shadow-sm flex-1 p-[1.25rem]">
                    <h5 class="mb-[1rem]">Visitors Overview</h5>
                    <canvas id="visitorsChart"></canvas>
                </div>

                <div class="bg-white rounded-lg flex flex-col shadow-sm flex-1 p-[1.25rem] overflow-hidden h-full">
                    <h5 class="mb-[1rem]">Top Destinations</h5>
                    <div class="mx-auto aspect-square">
                        <canvas id="destinationsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="flex justify-between w-[70%] px-2  items-center">

            <h4 class="py-8">
                user reviews
            </h4>
            <div class="dropdown">
                <button class="btn  w-20 text-center  dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Sort by
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Satisfying</a></li>
                    <li><a class="dropdown-item" href="#"> Warning</a></li>
                    <li><a class="dropdown-item" href="#">Alert </a></li>
                </ul>
            </div>
        </div>
        <div class="w-full flex justify-between gap-3 ">
            <div class="w-[75%] overflow-y-scroll  h-[68vh] dashboard-webkit">


                <table class="w-full  h-fit shadow-md rounded-xl ">
                    <thead>
                        <tr class=" h-10">
                            <th class="w-12 ">#</th>
                            <th class="w-44">User</th>
                            <th class="w-22">Gender</th>
                            <th class="w-44">Status</th>
                            <th>Comment</th>
                        </tr>


                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr class="  py-14 hover:bg-alpha/5 cursor-pointer border-b-2">
                                <th>{{ $comment->visitor->id }}</th>
                                <th class="flex gap-2 items-center">
                                    @if ($comment->visitor->gender == 'female')
                                        <img src="{{ asset('images/women.png') }}" class="rounded-full" width="30px"
                                            alt="Example Image">
                                    @else
                                        <img src="{{ asset('images/male_avatar.png') }}" class="rounded-full"
                                            width="30px" alt="Example Image">
                                    @endif
                                    <p class="mt-3">{{ $comment->visitor->last_name }}
                                        {{ $comment->visitor->first_name }}</p>
                                </th>
                                <td>{{ $comment->visitor->gender }}</td>
                                <td>
                                    <div
                                        class="{{ $comment->status == 'alert' ? 'bg-red-300 text-red-700' : ($comment->status == 'satisfying' ? 'bg-emerald-300 text-emerald-700' : 'bg-amber-300 text-amber-700') }}  rounded-3xl font-semibold  w-20 text-center mt-3">
                                        <p>{{ $comment->status }}</p>
                                    </div>
                                </td>
                                <td>
                                    <p class="mt-3"> {{ Str::limit($comment->content, 45, '...') }}</p>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="w-[25%]  h-fit ">
                <canvas id="demographicsChart"></canvas>
            </div>
        </div> --}}

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            new Chart(visitorsChart, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                    datasets: [{
                            label: 'visitor',
                            data: [25, 19, 30, 10, 0, 21],
                            fill: false,
                            borderColor: '#3b82f6',
                            tension: 0.125
                        },
                        {
                            label: 'male',
                            data: [10, 18, 15, 7, 0, 11],
                            fill: false,
                            borderColor: '#8884d8',
                            tension: 0.125
                        },
                        {
                            label: 'female',
                            data: [15, 1, 15, 3, 0, 10],
                            fill: false,
                            borderColor: '#82ca9d',
                            tension: 0.125
                        }
                    ]
                },
                options: {
                    responsive: true,
                }
            });

            new Chart(destinationsChart, {
                type: 'pie',
                data: {
                    labels: @json($destinationLabeles),
                    datasets: [{
                        label: 'My First Dataset',
                        data: @json($destinationDataSet),
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                }
            });
        </script>
    </div>
</x-app-layout>
