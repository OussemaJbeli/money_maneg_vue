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
                        <div class="main_currency">
                            <p>Current Currency : <span>{{ $page.props.auth.user.main_currency }}</span></p>
                            <img :src="'/icon/currency/'+$page.props.auth.user.main_currency+'.png'">
                            <button @click="openEdite_currency" 
                                class="flex items-center px-6 py-4 focus:text-indigo-500" >
                                    <i class="fa-solid fa-pen-to-square" ></i>
                            </button>
                        </div>
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
                                    <td class="border-t text-center text-white px-6 py-4"  v-if=" exchange.base !== exchange.currencys">
                                        <img :src="'/icon/currency/'+exchange.base+'.png'">
                                    </td>
                                    <td class="border-t text-center text-white px-0 py-4"  v-if=" exchange.base !== exchange.currencys">
                                        {{ exchange.base }}
                                    </td>
                                    <td class="border-t text-center text-white px-6 py-4"  v-if=" exchange.base !== exchange.currencys">
                                        1
                                    </td>
                                    <td class="border-t text-center text-white px-0 py-4"  v-if=" exchange.base !== exchange.currencys">
                                        {{ exchange.rate }}
                                    </td>
                                    <td class="border-t text-center text-white px-14 py-4" v-if=" exchange.base !== exchange.currencys">
                                        {{ exchange.currencys }}
                                    </td>
                                    <td class="border-t text-center text-white"  v-if=" exchange.base !== exchange.currencys">
                                        <img :src="'/icon/currency/'+exchange.currencys+'.png'">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="last_update">
                            <p>last update : {{ update_at }}</p>
                            <button>
                                <Link class="flex items-center px-6 py-4 focus:text-indigo-500" 
                                :href="`/Exchange_rate`">
                                    refresh
                                    <i class="fa-solid fa-arrows-rotate"></i>
                                </Link>
                            </button>
                        </div>
                    </div>
                    <div class="edite_currency" v-if="edite_frame_currency">
                        <div class="frame">
                            <div class="header">
                                <div class="logo">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </div>
                                <div class="exite" id="exit_popup" @click="openEdite_currency">
                                    <i class="fa-sharp fa-solid fa-circle-xmark"></i>
                                </div>
                            </div>
                                <div class="form">
                                    <Link class="flex items-center px-6 py-4 focus:text-indigo-500" 
                                        :style="{ backgroundColor: $page.props.auth.user.main_currency === 'TND' ? $page.props.auth.user.filter : '' }"
                                        :href="`/main_update/${this.$page.props.auth.user.id}/TND`">
                                        <img :src="'/icon/currency/TND.png'">
                                        <p>TND</p>
                                    </Link>
                                    <Link class="flex items-center px-6 py-4 focus:text-indigo-500" 
                                        :style="{ backgroundColor: $page.props.auth.user.main_currency === 'EUR' ? $page.props.auth.user.filter : '' }"
                                        :href="`/main_update/${this.$page.props.auth.user.id}/EUR`">
                                        <img :src="'/icon/currency/EUR.png'">
                                        <p>EUR</p>
                                    </Link>
                                    <Link class="flex items-center px-6 py-4 focus:text-indigo-500" 
                                        :style="{ backgroundColor: $page.props.auth.user.main_currency === 'USD' ? $page.props.auth.user.filter : '' }"
                                        :href="`/main_update/${this.$page.props.auth.user.id}/USD`">
                                        <img :src="'/icon/currency/USD.png'">
                                        <p>USD</p>
                                    </link>
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
        exchange_rate :Object,
        update_at: Object,
    },
    data() {
        return {
            edite_frame_currency: false,
        }
    },
    methods: {
        openEdite_currency(){
            if(this.edite_frame_currency){
                this.edite_frame_currency= false
            }
            else{
                this.edite_frame_currency= true
            }
        },
        save_currency_update() {
            this.currency_form_update.put(`/Carrency/${this.$page.props.auth.user.id}}`);
        },
    },
}
</script>