<template>
    <Head title="Tickets - show" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-ticket"></i>
                /Tickets / Show
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white rounded-md shadow overflow-x-auto">
                        <table class="w-full tickets_table">
                            <thead>
                            <tr class="text-center font-bold bg-gray-600">
                                <th class="pb-4 pt-6 px-6">name</th>
                                <th class="pb-4 pt-6 px-6">price(by one)</th>
                                <th class="pb-4 pt-6 px-6">currency</th>
                                <th class="pb-4 pt-6 px-6">quentity</th>
                                <th class="pb-4 pt-6 px-6">state</th>
                                <th class="pb-4 pt-6 px-6">region</th>
                                <th class="pb-4 pt-6 px-6" colspan="2"></th>
                            </tr>
                            </thead>
                            <tbody class="text-right">
                                <tr v-for="item in items" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <td class="border-t text-center text-white">
                                        {{ item.item_name }}
                                    </td>
                                    <td class="border-t text-center text-white">
                                        {{ item.item_prix }}
                                    </td>
                                    <td class="border-t text-center text-white">
                                        {{ item.currency }}
                                    </td>
                                    <td class="border-t text-center text-white">
                                        {{ item.item_quentity}}
                                    </td>
                                    <td class="border-t text-center text-white">
                                        {{ item.region}}
                                    </td>
                                    <td class="border-t text-center text-white">
                                        {{ item.state}}
                                    </td>
                                    <td class="border-t text-center text-white">
                                        <Link class="flex items-center px-6 py-4 focus:text-indigo-500" 
                                        :href="`/Items/${item.id}/edit`">
                                            <i class="fa-solid fa-pen-to-square" style="color: #1d962b;"></i>
                                        </Link>
                                    </td>
                                    <td class="border-t text-center text-white">
                                        <Link class="flex items-center px-6 py-4 focus:text-indigo-500" 
                                        :href="`/Items/${item.id}/delete`">
                                            <i class="fa-solid fa-trash" style="color: #e00000;"></i>
                                        </Link>
                                    </td>
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
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>
<script>
export default {

    props: {
        items: Object,
        tik: Object,
    },
    data() {
        return {

        }
    },
    methods: {
        
    },
}
</script>