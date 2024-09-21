<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            Dashboard
        </x-slot>
    </x-slot>

    <div class="overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6 lg:p-8">
        {{-- cards --}}
        <div class="flex gap-5 w-full h-[10%]">
            <div class="w-[25%] cursor-pointer relative gap-3 px-2 h-full shadow-md rounded-xl flex items-center">
                <div class="h-[60%] items-center">
                    <div class="bg-[#0046fe] p-2.5 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                </div>
                <div class="h-[70%]">
                    <h4 class="font-bold">{{ $visitorCount }}</h4>
                    <p class="text-[#64667b]">total visitors</p>
                </div>
            </div>
            <div class="w-[25%] cursor-pointer relative gap-3 px-2 h-full shadow-md rounded-xl flex items-center">
                <div class="h-[60%] items-center">
                    <div class="bg-[#5cc7ff] p-2.5 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                </div>
                <div class="h-[70%]">
                    <h4 class="font-bold">10.8K</h4>
                    <p class="text-[#64667b]">active visitors</p>
                </div>
            </div>
            <div class="w-[25%] cursor-pointer relative gap-3 px-2 h-full shadow-md rounded-xl flex items-center">
                <div class="h-[60%] items-center">
                    <div class="bg-[#10be79] p-2.5 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>
                    </div>
                </div>
                <div class="h-[70%]">
                    <h4 class="font-bold">{{ $commentCount }}</h4>
                    <p class="text-[#64667b]">reviews</p>
                </div>
            </div>
            <div class="w-[25%] cursor-pointer relative gap-3 px-2 h-full shadow-md rounded-xl flex items-center">
                <div class="h-[60%] items-center">
                    <div class="bg-[#ffc93f] p-2.5 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-7 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                        </svg>
                    </div>
                </div>
                <div class="h-[70%]">
                    <h4 class="font-bold">10.8K</h4>
                    <p class="text-[#64667b]">best destinations</p>
                </div>
            </div>
        </div>
        <div class="flex justify-between w-[70%] px-2  items-center">

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
            {{-- comments --}}
            <div>

            </div>
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
            {{-- charts --}}
            <div class="w-[25%]  h-fit ">
                <canvas id="demographicsChart"></canvas>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('demographicsChart').getContext('2d');
            let femaleCount = {{ $femaleCount }};
            let maleCount = {{ $maleCount }};
            let ChildCount = {{ $childCount }};


            const data = {

                labels: ['Female', 'Male', 'Kids'],

                datasets: [{
                    label: 'statistique',
                    data: [femaleCount, maleCount, ChildCount],
                    backgroundColor: [
                        'rgb(255, 201, 64)',
                        'rgb(32, 108, 255)',
                        'rgb(92, 199, 255)',
                    ],
                    borderColor: [
                        'rgb(255, 201, 64)',
                        'rgb(32, 108, 255)',
                        'rgb(92, 199, 255)',
                    ],
                    borderWidth: 1
                }]
            };

            const config = {

                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        },

                    }
                }
            };

            new Chart(ctx, config);
        </script>

    </div>
</x-app-layout>
