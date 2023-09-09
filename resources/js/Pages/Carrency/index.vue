<template>
    <Head title="Carrency" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-coins"></i>
                /Carrency
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 currency_frame">
                        <table class="w-full currency_table">
                            <thead>
                                <tr class="text-center font-bold bg-gray-600">
                                    <th class="pb-4 pt-6 px-6" colspan="2">base</th>
                                    <th class="pb-4 pt-6 px-6" >value</th>
                                    <th class="pb-4 pt-6 px-6" >value</th>
                                    <th class="pb-4 pt-6 px-6" colspan="2">currency</th>
                                </tr>
                            </thead>
                            <tbody class="text-right">
                                <tr v-for="(exchange,index) in exchange_rate" :key="index" class="hover:bg-gray-100">
                                    <td class="border-t text-center text-white px-6 py-4">
                                        <img :src="'/icon/currency/'+exchange.base+'.png'">
                                    </td>
                                    <td class="border-t text-center text-white px-0 py-4">
                                        {{ exchange.base }}
                                    </td>
                                    <td class="border-t text-center text-white px-6 py-4">
                                        1
                                    </td>
                                    <td class="border-t text-center text-white px-0 py-4">
                                        {{ exchange.rate }}
                                    </td>
                                    <td class="border-t text-center text-white px-14 py-4">
                                        {{ exchange.currencys }}
                                    </td>
                                    <td class="border-t text-center text-white">
                                        <img :src="'/icon/currency/'+exchange.currencys+'.png'">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button @click="refreshCurrency" 
                            class="flex items-center px-6 py-4 focus:text-indigo-500">
                            refresh
                            <i class="fa-solid fa-arrows-rotate"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<script>
export default {
    components: {
        Head,
    },
    props: {
        exchange_rate :Object,
    },
    data() {
        return {
            
        }
    },
    methods: {
        refreshCurrency(){
            this.region_form_update.put(`/Region/store`);
        }
    },
}
</script>