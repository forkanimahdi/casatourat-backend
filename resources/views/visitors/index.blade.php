<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            Manage Users
        </x-slot>

        <button onclick="addModeratorAdmin.show()"
            class="bg-alpha text-[#fff] px-[1.75rem] py-[0.5rem] rounded-xl font-medium border-2 border-alpha hover:bg-transparent hover:font-semibold hover:text-alpha transition-all duration-600">
            Add admin
        </button>
        @include('visitors.partials.create_moderator_modal')
    </x-slot>

    <div x-data='
    {{-- Searching --}}
    {searchQuery: "",
    {{-- search function: return true if any of the conditions are met --}}
                matchesSearch(visitor) {
                const query = this.searchQuery.toLowerCase();
                return visitor.full_name.toLowerCase().includes(query) ||
                    visitor.email.toLowerCase().includes(query) ||
                    visitor.role.toLowerCase().includes(query);},


    {{-- Sorting --}}

    {{-- define criteria/order and get the visitors from the database --}}
    sortCriteria: "",
    sortOrder: "asc",
    visitors: {{ $visitors }},

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

        {{-- sorts the visitors depending on the criteria --}}
        this.visitors = this.visitors.sort((a, b) => {
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
    },
}'
        class="p-4 sm:p-6 lg:p-8">
        <div class="bg-white overflow- shadow-sm sm:rounded-lg px-[1.25rem] py-3">
            <div class="flex mb-3 items-center justify-between">
                <div class="w-1/3 flex items-center bg-gray-100 rounded-lg pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                            clip-rule="evenodd" />
                    </svg>

                    {{-- change the variable to whatever is in the input --}}
                    <input x-model="searchQuery" placeholder="Name, Email or Role" type="search" name="search"
                        id="search"
                        class="border-none bg-transparent w-full outline-none focus:border-none focus:ring-0 focus:outline-none text-sm">
                </div>
            </div>

            <table class="w-full">
                <thead>
                    {{-- To Avoid Repitition of the svg each time --}}
                    @php
                        $headers = [
                            ['key' => 'name', 'label' => 'Name'],
                            ['key' => 'email', 'label' => 'Email'],
                            ['key' => 'gender', 'label' => 'Gender'],
                            ['key' => 'role', 'label' => 'Role'],
                            ['key' => 'created_at', 'label' => 'Sign Up Date'],
                        ];
                    @endphp
                    <tr>
                        @foreach ($headers as $header)
                            <th @click="sortTable('{{ $header['key'] }}')"
                                class="cursor-pointer capitalize text-alpha text-base font-semibold">
                                <div class="flex items-center gap-1">
                                    {{ $header['label'] }}
                                    <svg width="21px" height="21px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16 18L16 6M16 6L20 10.125M16 6L12 10.125" stroke="#1C274C"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 6L8 18M8 18L12 13.875M8 18L4 13.875" stroke="#1C274C"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>

                <tbody id="table">
                    <template x-for="visitor in visitors" :key="visitor.email">
                        <tr x-show="matchesSearch(visitor)" class="h-[7vh]">
                            <td x-text="visitor.full_name"></td>
                            <td x-text="visitor.email"></td>
                            <td>
                                <span x-text="visitor.gender"
                                    :class="visitor.gender == 'male' ? 'bg-sky-100' : 'bg-pink-100'"
                                    class="text-sm rounded-full px-2 py-1 capitalize">
                                </span>
                            </td>
                            <td>
                                <span x-text="visitor.role"
                                    :class="visitor.role == 'admin' ? 'bg-yellow-100 text-yellow-900' :
                                        'bg-green-100 text-green-900'"
                                    class="text-sm rounded-full px-2 py-1 capitalize">

                                </span>
                            </td>
                            <td x-text="formatDate(visitor.created_at)"></td>
                        </tr>
                    </template>
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
