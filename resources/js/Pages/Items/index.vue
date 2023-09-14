<template>
    <Head title="Items" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-sitemap"></i>
                /Items
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-for="(Items, index) in  items_list" :key="index" class="ticket_item_group">
                        <div class="ball_corner" id="corner1"></div>
                        <div class="ball_corner" id="corner2"></div>
                        <div class="ball_corner" id="corner3"></div>
                        <div class="ball_corner" id="corner4"></div>
                        <div class="table">
                            <table class="w-full items_table">
                                <thead>
                                    <tr class="text-center font-bold bg-gray-600">
                                        <th class="pb-4 pt-6 px-6">name</th>
                                        <th class="pb-4 pt-6 px-6">total origin price</th>
                                        <th class="pb-4 pt-6 px-6">
                                            <p>total main currency (<img :src="'/icon/currency/'+$page.props.auth.user.main_currency+'.png'">)</p>
                                        </th>
                                        <th class="pb-4 pt-6 px-6">quentity</th>
                                        <th class="pb-4 pt-6 px-6">state</th>
                                        <th class="pb-4 pt-6 px-6">region</th>
                                        <th class="pb-4 pt-6 px-6" colspan="2"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-right">
                                    <tr v-for="item in Items" :key="index1" class="hover:bg-gray-100 focus-within:bg-gray-100 ">
                                        <td class="border-t text-center text-white px-6 py-4">
                                            {{ item.items }}
                                        </td>
                                        <td class="border-t text-center text-white">
                                        {{ item.totalitem_prix }} {{ item.currency }}
                                        </td>
                                        <td class="border-t text-center text-white" v-if="item.currency == $page.props.auth.user.main_currency">
                                            {{ item.totalitem_prix }} {{ item.currency }}
                                        </td>
                                        <td class="border-t text-center text-white" v-else>
                                            {{ item[TOTALcurrent_currency] }} {{ $page.props.auth.user.main_currency }}
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
                                    </tr>
                                    <tr v-if="items_list.length === 0">
                                        <td class="px-6 py-4 border-t text-center" colspan="4"> Tickets impty </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="date_general">
                            <div class="under_date">
                                <div class="buttons">
                                    <Link class="flex items-center px-6 py-4 focus:text-indigo-500" 
                                        :href="`/Tickets/${Items[0].ticket_date}/delete`">
                                        <i class="fa-solid fa-trash"></i>
                                    </Link>
                                    <Link class="flex items-center px-6 py-4 focus:text-indigo-500" 
                                        :href="`/Items/${Items[0].ticket_id}/edit`">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </Link>
                                </div>
                                <p>{{ Items[0].ticket_date }}</p>
                            </div>
                        </div>
                    </div>
                    <div v-if="items_list.length === 0" class="ticket_item_group">
                        <div class="ball_corner" id="corner1"></div>
                        <div class="ball_corner" id="corner2"></div>
                        <div class="ball_corner" id="corner3"></div>
                        <div class="ball_corner" id="corner4"></div>
                        <div class="table">
                            <table class="w-full items_table">
                                <thead>
                                    <tr class="text-center font-bold bg-gray-600">
                                        <th class="pb-4 pt-6 px-6">name</th>
                                        <th class="pb-4 pt-6 px-6">total origin price</th>
                                        <th class="pb-4 pt-6 px-6">
                                            <p>total main currency (<img :src="'/icon/currency/'+$page.props.auth.user.main_currency+'.png'">)</p>
                                        </th>
                                        <th class="pb-4 pt-6 px-6">quentity</th>
                                        <th class="pb-4 pt-6 px-6">state</th>
                                        <th class="pb-4 pt-6 px-6">region</th>
                                        <th class="pb-4 pt-6 px-6" colspan="2"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-right">
                                    <tr>
                                        <td class="px-6 py-4 border-t text-center" colspan="7"> Items impty </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="date_general">
                            <div class="under_date">
                                <p>empty</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
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
        items_list: Object,
    },
    data() {
        return {
            current_currency: this.$page.props.auth.user.main_currency,
            TOTALcurrent_currency: 'total'+this.$page.props.auth.user.main_currency,
        }
    },
    methods: {

    },
}
</script>