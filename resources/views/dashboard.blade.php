<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            Dashboard
        </x-slot>
    </x-slot>

    <div class="overflow-hidden p-4 sm:p-6 lg:p-8">
        <div class="flex flex-col gap-[1.5rem]">
            <div style="--lg-count: 4; --md-count: 2; --gap: 1rem;" class="flex flex-wrap gap-[var(--gap)]">
                @foreach ($states as $state)
                    <div style="--bg-color: {{ $state['bgColor'] }};"
                        class="bg-white rounded-lg shadow-sm px-[1.5rem] py-[1.25rem] w-full md:w-[calc(calc(100%-calc(calc(var(--md-count)-1)*var(--gap)))/var(--md-count))]  lg:w-[calc(calc(100%-calc(calc(var(--lg-count)-1)*var(--gap)))/var(--lg-count))]">
                        <div class="flex justify-between items-center">
                            <h5 class="capitalize text-base/none">{{ $state['name'] }}</h5>
                            <div class="rounded-full size-8 flex items-center justify-center bg-[var(--bg-color)]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $state['svgPath'] }}" />
                                </svg>
                            </div>
                        </div>

                        <div class="mt-[0.875rem] flex gap-2 items-end">
                            <p class="m-0 font-bold text-3xl/none">{{ $state['stats'] }}</p>
                            @if ($state['amount'])
                                <p class="m-0 text-gray-500 text-xs">
                                    <span @class([
                                        'font-medium',
                                        'text-green-500' => $state['amount'] > 0,
                                        'text-red-500' => $state['amount'] < 0,
                                    ])>{{ $state['amount'] }}%</span>
                                    <span> from last month</span>
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="--count: 2; --gap: 1rem;" class="flex flex-wrap gap-[var(--gap)]">
                <div
                    class="bg-white rounded-lg flex flex-col shadow-sm px-[1.5rem] py-[1.25rem] w-full lg:w-[calc(calc(100%-calc(calc(var(--count)-1)*var(--gap)))/var(--count))]">
                    <h5 class="mb-[1rem] text-xl/none font-medium">Visitors Overview</h5>
                    <canvas id="visitorsChart"></canvas>
                </div>

                <div
                    class="bg-white rounded-lg flex flex-col shadow-sm px-[1.5rem] py-[1.25rem] w-full lg:w-[calc(calc(100%-calc(calc(var(--count)-1)*var(--gap)))/var(--count))] overflow-hidden">
                    <h5 class="mb-[1rem] text-xl/none font-medium">Top Destinations</h5>
                    <canvas id="destinationsChart"></canvas>
                </div>
            </div>

            <div x-data='{
        {{-- Sorting --}}

        {{-- define criteria/order and get the visitors from the database --}}
        sortCriteria: "",
        sortOrder: "asc",
        comments: {{ $comments }},
    
        {{-- Sort Function --}}
        sortTable(criteria) {
        {{-- if same criteria button clicked then change the sorting order --}}
            if (this.sortCriteria === criteria) {
                this.sortOrder = this.sortOrder === "asc" ? "desc" : "asc";
            }
            {{-- else define a new criteria and set the order --}}
            else {
                this.sortCriteria = criteria;
                this.sortOrder = "asc";
            }
    
            {{-- sorts the comments depending on the criteria --}}
            this.comments = this.comments.sort((a, b) => {
                if (criteria === "name") {
                    return this.sortOrder === "asc" ? a.full_name.localeCompare(b.full_name) : b.full_name.localeCompare(a.full_name);
                } else if (criteria === "email") {
                    return this.sortOrder === "asc" ? a.email.localeCompare(b.email) : b.email.localeCompare(a.email);
                } else if (criteria === "created_at") {
                    return this.sortOrder === "asc" ? Date.parse(a.created_at) - Date.parse(b.created_at) : Date.parse(b.created_at) - Date.parse(a.created_at);
                } else if (criteria === "gender") {
                    return this.sortOrder === "asc" ? a.gender.localeCompare(b.gender) : b.gender.localeCompare(a.gender);
                } else if (criteria === "role") {
                    return this.sortOrder === "asc" ? a.role.localeCompare(b.role) : b.role.localeCompare(a.role);
                } else {
                    return 0;
                }
            });
        },
    
        {{-- make date look better --}}
        formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString("en-US", {
                year: "numeric",
                month: "long",
                day: "numeric",
            });
        }
    }'
                class="bg-white rounded-lg shadow-sm px-[1.5rem] py-[1.25rem]">
                <h5 class="text-xl/none m-0">Visitors Reviews</h5>
                <div class="flex mb-3 items-center justify-between">
                    {{-- sort goes here --}}
                </div>

                <table class="w-full">
                    <thead>
                        @php
                            $headers = [
                                ['key' => 'visitor', 'label' => 'User'],
                                ['key' => 'circuit.name', 'label' => 'Circuit'],
                                ['key' => 'created_at', 'label' => 'Date'],
                                ['key' => 'gender', 'label' => 'Rating'],
                                ['key' => 'role', 'label' => 'Comment'],
                            ];
                        @endphp
                        <tr class="*:px-[0.5rem] *:py-[0.75rem]">
                            @foreach ($headers as $header)
                                <th @click="sortTable('{{ $header['key'] }}')"
                                    class="cursor-pointer capitalize text-alpha/75 text-base/none font-semibold">
                                    {{ $header['label'] }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody id="table">
                        <template x-for="comment in comments">
                            <tr class="border-t *:px-[0.5rem] *:py-[0.875rem] hover:bg-gray-50">
                                <td class="font-medium" x-text="comment.visitor"></td>
                                <td>
                                    <a :href="comment.circuit.link"
                                        class="flex items-center gap-1.5 no-underline text-inherit">
                                        <img x-show="comment.circuit.image" class="size-9 rounded-lg"
                                            :src="comment.circuit.image" :alt="comment.circuit.name">
                                        <div x-show="!comment.circuit.image"
                                            class="size-9 rounded-lg border grid place-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-3">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                                            </svg>
                                        </div>
                                        <span x-text="comment.circuit.name"></span>
                                    </a>
                                </td>
                                <td x-text="formatDate(comment.date)"></td>
                                <td>
                                    <span x-text="comment.status"
                                        :class="comment.status == 'good' ? 'bg-green-100' : comment.status == 'bad' ?
                                            'bg-red-100' : 'bg-amber-100'"
                                        class="text-sm rounded-full px-2 py-1 capitalize">
                                    </span>
                                </td>
                                <td x-text="comment.content"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            new Chart(visitorsChart, {
                type: 'line',
                data: {
                    labels: @json($dataPerMonth['months']),
                    datasets: [{
                            label: 'male',
                            data: @json($dataPerMonth['males']),
                            fill: 'origin',
                            borderColor: '#7dd3fc',
                            backgroundColor: "transparent",
                            tension: 0.125
                        },
                        {
                            label: 'female',
                            data: @json($dataPerMonth['females']),
                            fill: 'origin',
                            borderColor: '#fda4af',
                            backgroundColor: "transparent",
                            tension: 0.125
                        },
                        {
                            label: 'visitor',
                            data: @json($dataPerMonth['visitors']),
                            fill: 'origin',
                            borderColor: '#bef264',
                            backgroundColor: "#bef26410",
                            tension: 0.125
                        },
                    ]
                },
                options: {
                    responsive: true,
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        },
                        y: {
                            // stacked: true,
                            title: {
                                display: true,
                                text: 'Value'
                            }
                        }
                    },
                }
            });

            new Chart(destinationsChart, {
                type: 'pie',
                data: {
                    labels: @json($destinationsData['labels']),
                    datasets: [{
                        data: @json($destinationsData['data']),
                        backgroundColor: [
                            "#14b8a6", "#06b6d4", "#0ea5e9", "#3b82f6", "#6366f1", "#8b5cf6", "#a855f7",
                            "#ef4444", "#f97316", "#f59e0b", "#eab308", "#84cc16", "#22c55e", "#10b981",
                            "#d946ef", "#ec4899", "#f43f5e",
                        ],
                        hoverOffset: 5,
                    }]
                },
                options: {
                    responsive: true,
                    aspectRatio: 1 / 0.5,
                    plugins: {
                        legend: {
                            position: 'right'
                        }
                    }
                },
                plugins: [{
                    id: 'emptyDoughnut',
                    afterDraw(chart, args, options) {
                        const {
                            datasets
                        } = chart.data;
                        const {
                            radiusDecrease
                        } = options;

                        for (const dataset of datasets) {
                            for (const datevalue of dataset.data) {
                                if (datevalue > 0) {
                                    return
                                }
                            }
                        }

                        const {
                            chartArea: {
                                left,
                                top,
                                right,
                                bottom
                            },
                            ctx
                        } = chart;
                        const centerX = (left + right) / 2;
                        const centerY = (top + bottom) / 2;
                        const r = Math.min(right - left, bottom - top) / 2;

                        ctx.beginPath();
                        ctx.lineWidth = 2;
                        ctx.strokeStyle = '#1221af';
                        ctx.arc(centerX, centerY, (r - 20 || 0), 0, 2 * Math.PI);
                        ctx.stroke();
                    }
                }]
            });
        </script>
    </div>
</x-app-layout>
