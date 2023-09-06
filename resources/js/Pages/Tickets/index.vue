<template>
    <Head title="Tickets" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-ticket"></i>
                /Tickets
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white rounded-md shadow overflow-x-auto">
                        <table class="w-full tickets_table">
                            <thead>
                            <tr class="text-center font-bold bg-gray-600">
                                <th class="pb-4 pt-6 px-6">date</th>
                                <th class="pb-4 pt-6 px-6">total items</th>
                                <th class="pb-4 pt-6 px-6"></th>
                            </tr>
                            </thead>
                            <tbody class="text-right">
                                <tr v-for="ticket in tickets" class="hover:bg-gray-100">
                                    <td class="border-t text-center text-white">
                                        {{ ticket.ticket_date }}
                                    </td>
                                    <td class="border-t text-center text-white">
                                        {{ ticket.quentity }}
                                    </td>
                                    <td class="border-t text-center text-white">
                                        <Link class="flex items-center px-6 py-4 focus:text-indigo-500" 
                                        :href="`/Tickets/${ticket.ticket_id}/show`">
                                        <i class="fa-solid fa-chevron-right"></i>
                                        </Link>
                                    </td>
                                </tr>
                                <tr v-if="tickets.length === 0">
                                    <td class="px-6 py-4 border-t text-center" colspan="4"> Tickets impty </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import NavLink from '@/Components/NavLink.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head , Link} from '@inertiajs/vue3';
</script>
<script>
export default {
    components: {
        Head,
        Link,
    },
    props: {
        tickets: Object,
    },

    data() {
        return {

        }
    },
    methods: {
        
    },
}
</script>
