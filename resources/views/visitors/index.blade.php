<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="text-alpha leading-tight capitalize font-semibold text-2xl">
                Manage Users
            </h2>

            <button onclick="addModeratorAdmin.show()"
                class="bg-alpha text-[#fff] px-[1.75rem] py-[0.5rem] rounded-xl font-medium border-2 border-alpha hover:bg-transparent hover:font-semibold hover:text-alpha transition-all duration-600">
                Add admin
            </button>
            @include('visitors.partials.create_moderator_modal')
        </div>
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
        class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 text-alpha ">
        <div class="bg-white overflow- shadow-sm sm:rounded-lg px-6 py-3">
            <div class="flex mb-3 items-center justify-between">
                <div class="w-1/3 flex items-center bg-gray-100 rounded-lg pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                            clip-rule="evenodd" />
                    </svg>

                    {{-- change the variable to whatever is in the input --}}
                    <input x-model="searchQuery" placeholder="search by name or email" type="search" name="search"
                        id="search"
                        class="border-none bg-transparent w-full placeholder:text-alpha outline-none focus:border-none focus:ring-0 focus:outline-none text-sm">
                </div>

                <div class="relative">
                    {{-- <button id="sortbtn" @click="sortdialog.show = !sortdialog.show" class="flex items-center gap-1">
                        <div>Sort by: <span x-text="sortCriteria ? sortCriteria : 'Select'"></span></div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.75"
                            stroke="currentColor" class="size-3 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <dialog x-ref="sortdialog" id="sortdialog"
                        class="top-full bg-white shadow-md py-1.5 rounded-lg text-alpha font-medium left-auto mt-1">
                        <div @click="sortTable('name')"
                            class="sortitem lowercase pl-[2rem] pr-[3rem] py-1 cursor-pointer">Name</div>
                        <div @click="sortTable('email')"
                            class="sortitem lowercase pl-[2rem] pr-[3rem] py-1 cursor-pointer">Email</div>
                        <div @click="sortTable('created_at')"
                            class="sortitem lowercase pl-[2rem] pr-[3rem] py-1 cursor-pointer">Created Date</div>
                        <div @click="sortTable('gender')"
                            class="sortitem lowercase pl-[2rem] pr-[3rem] py-1 cursor-pointer">Gender</div>
                    </dialog> --}}
                </div>
            </div>

            <table class="w-full">
                <thead>
                    <tr>
                        <th @click="sortTable('name')" class="cursor-pointer capitalize text-[#002d55] text-lg">Name
                        </th>
                        <th @click="sortTable('email')" class="cursor-pointer capitalize text-[#002d55] text-lg">Email
                        </th>
                        <th @click="sortTable('gender')" class="cursor-pointer capitalize text-[#002d55] text-lg">Gender
                        </th>
                        <th @click="sortTable('role')" class="cursor-pointer capitalize text-[#002d55] text-lg">Role
                        </th>
                        <th @click="sortTable('created_at')" class="cursor-pointer capitalize text-[#002d55] text-lg">
                            Created Date</th>
                    </tr>
                </thead>

                <tbody id="table">
                    <template x-for="visitor in visitors" :key="visitor.email">
                        <tr x-show="matchesSearch(visitor)" class="h-[7vh]">
                            <td x-text="visitor.full_name"></td>
                            <td x-text="visitor.email"></td>
                            <td x-text="visitor.gender"></td>
                            <td x-text="visitor.role"></td>
                            <td x-text="formatDate(visitor.created_at)"></td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

@vite('resources/js/search.js')
