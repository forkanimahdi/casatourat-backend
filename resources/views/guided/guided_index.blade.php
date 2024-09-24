<x-app-layout>
    <x-slot name="header">
        <x-slot name="title">
            Manage Guided Visits
        </x-slot>
    </x-slot>

    <div x-data='{
        guided: {{ json_encode($guided) }},
        visitors: {{ json_encode($visitors) }},
        searchQuery: "",
        sortKey: "name", // default sort key
        sortAsc: true, // default sort order
        matchesSearch(visit) {
            const visitor = this.visitors.find(v => v.id === visit.visitor_id);
            const query = this.searchQuery.toLowerCase();
            return visitor && (
                visitor.full_name.toLowerCase().includes(query) ||
                visitor.email.toLowerCase().includes(query)
            );
        },

        sortGuided() {
            this.guided.sort((a, b) => {
                const visitorA = this.visitors.find(v => v.id === a.visitor_id);
                const visitorB = this.visitors.find(v => v.id === b.visitor_id);
                let comparison = 0;

                if (this.sortKey === `name`) {
                    comparison = visitorA.full_name.localeCompare(visitorB.full_name);
                } else if (this.sortKey === `email`) {
                    comparison = visitorA.email.localeCompare(visitorB.email);
                } else if (this.sortKey === `date`) {
                    comparison = new Date(a.date) - new Date(b.date);
                }

                return this.sortAsc ? comparison : -comparison;
            });
        },
        setSort(key) {
            this.sortKey = key;
            this.sortAsc = !this.sortAsc;
            this.sortGuided();
        }
    }'
        class="p-4 sm:p-6 lg:p-8">
        <div class="bg-white p-8 rounded-lg">

            <div class="flex mb-3 items-center justify-between">
                <div class="w-1/3 flex items-center bg-gray-100 rounded-lg pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                            clip-rule="evenodd" />
                    </svg>

                    {{-- change the variable to whatever is in the input --}}
                    <input x-model="searchQuery" placeholder="Name, Email" type="search" name="search"
                        id="search"
                        class="border-none bg-transparent w-full outline-none focus:border-none focus:ring-0 focus:outline-none text-sm">
                </div>
            </div>

            <table class="w-full text-center">

                <thead>
                    <tr class="text-lg">
                        <td @click="setSort('name')" class="cursor-pointer">
                            <div class="flex items-center gap-1 justify-center">
                                Name
                                <svg width="21px" height="21px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 18L16 6M16 6L20 10.125M16 6L12 10.125" stroke="#1C274C"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8 6L8 18M8 18L12 13.875M8 18L4 13.875" stroke="#1C274C" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </td>
                        <td>Phone</td>
                        <td @click="setSort('email')" class="cursor-pointer">
                            <div class="flex items-center gap-1 justify-center">
                                Email
                                <svg width="21px" height="21px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 18L16 6M16 6L20 10.125M16 6L12 10.125" stroke="#1C274C"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8 6L8 18M8 18L12 13.875M8 18L4 13.875" stroke="#1C274C" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </td>
                        <td>People Present</td>
                        <td>Message</td>
                        <td @click="setSort('date')" class="cursor-pointer">
                            <div class="flex items-center gap-1 justify-center">
                                Desired Date
                                <svg width="21px" height="21px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 18L16 6M16 6L20 10.125M16 6L12 10.125" stroke="#1C274C"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8 6L8 18M8 18L12 13.875M8 18L4 13.875" stroke="#1C274C" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </td>
                        <td>Approved</td>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="visit in guided" :key="visit.id">
                        <tr x-show="matchesSearch(visit)" class="h-[10vh]">
                            <td>
                                <span
                                    x-text="(visitors.find(visitor => visitor.id === visit.visitor_id) || {}).full_name"></span>
                            </td>
                            <td>
                                <span x-text="visit.phone"></span>
                            </td>
                            <td>
                                <span
                                    x-text="(visitors.find(visitor => visitor.id === visit.visitor_id) || {}).email"></span>
                            </td>
                            <td>
                                <span x-text="visit.number_of_people"></span>
                            </td>
                            <td @click="visit.isExpanded = !visit.isExpanded" class="w-[25%]">
                                <span
                                    x-text="(visit.message && visit.message.length > 0 ? (visit.isExpanded ? visit.message : visit.message.slice(0, 25)) : 'There\'s No Message')"></span>
                                <span class="text-alpha underline italic text-[10px]"
                                    x-show="visit.message && visit.message.length > 0"
                                    x-text="visit.isExpanded ? 'Read Less' : 'Read More'"
                                    style="cursor: pointer;"></span>
                            </td>
                            <td>
                                <span
                                    x-text="new Date(visit.date).toLocaleDateString('fr-FR', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })"></span>
                            </td>
                            <td>
                                <template x-if="visit.pending">
                                    <form method="POST" :action="`{{ route('guided.clearance', '') }}/${visit.id}`">
                                        @csrf
                                        <button class="px-4 py-2 rounded bg-alpha text-white" type="submit"
                                            name="action" value="approve">Approve</button>
                                        <button class="px-4 py-2 rounded bg-red-500 text-white" type="submit"
                                            name="action" value="deny">Deny</button>
                                    </form>
                                </template>
                                <template x-if="!visit.pending">
                                    <p
                                        class="text-white m-0">
                                        <span x-text="visit.approved ? 'Approved' : 'Denied'"
                                        :class="visit.approved ? 'bg-green-200 text-green-900' : 'bg-red-200 text-red-900'"
                                        class="text-sm rounded-full px-2 py-1"
                                        ></span>
                                    </p>
                                </template>
                            </td>
                        </tr>
                    </template>

                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>
