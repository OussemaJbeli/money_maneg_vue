<template>
    <Head title="Wallet" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-coins"></i>
                /My Wallet
            </h2>
        </template>
        <div class="Wallet_frame">
            <div class="statistics">
                <div class="terget_wallet frame_original">
                    <div class="main_bullence">
                        <p>
                            <span>Main Bullence</span>
                            <span class="main_bullence" v-if="TOTAL[$page.props.auth.user.main_currency]"
                                :style="{
                                    color:(TOTAL[$page.props.auth.user.main_currency] < 0)? 
                                    'red':'green'
                                }">
                                {{ TOTAL[$page.props.auth.user.main_currency] }}
                                <span>{{ $page.props.auth.user.main_currency }}</span>
                            </span>
                            <span class="main_bullence" v-else>
                                0
                                <span>{{ $page.props.auth.user.main_currency }}</span>
                            </span>
                        </p>
                        <button>add target</button>
                    </div>
                    <div class="advence_chart">
                        <div class="chartframe">
                            <div class="chart_panel">
                            </div>
                        </div>
                    </div>
                    <div class="onthly_incame_expenses_chart">
                        <p>Monthly Summary</p>
                        <div class="shart">
                            <!-- <area-chart ></area-chart> -->
                        </div>
                    </div>
                </div>
                <div class="myWallet frame_original">
                    <div class="circle big"></div>
                    <div class="circle medium"></div>
                    <div class="TotalMony">
                        <span class="main_bullence" v-if="TOTAL[$page.props.auth.user.main_currency]">
                            {{ TOTAL[$page.props.auth.user.main_currency] }}
                            <span>{{ $page.props.auth.user.main_currency }}</span>
                        </span>
                        <span class="main_bullence" v-else>
                            0
                            <span>{{ $page.props.auth.user.main_currency }}</span>
                        </span>
                        <p>
                            <i class="fa-solid fa-wallet"></i>
                            Total Amount
                        </p>
                    </div>
                    <div class="buttons">
                        <button @click="incame_open">incame</button>
                        <button @click="expenses_open" class="outcome">expenses</button>
                    </div>
                    
                </div>  
            </div>
            <div class="historique_statistique frame_original">
                <p class="title">
                    <span>Historique Statistique</span>
                </p>
                <table class="w-full wallet_table">
                    <thead>
                        <tr class="text-center font-bold bg-gray-600">
                        <th class="pb-4 pt-6 px-6">origin amount</th>
                        <th class="pb-4 pt-6 px-6">
                            <p>main amount (<img :src="'/icon/currency/'+$page.props.auth.user.main_currency+'.png'">)</p>
                        </th>
                        <th class="pb-4 pt-6 px-6">from</th>
                        <th class="pb-4 pt-6 px-6">to</th>
                        <th class="pb-4 pt-6 px-6">date</th>
                        </tr>
                    </thead>
                    <tbody class="text-right">
                        <tr v-for="(historique,index) in historique_incame" :key="index" class="hover:bg-gray-100">
                            <td class="pb-4 pt-6 px-6 border-t text-start text-white"
                            >
                                <i v-if="historique.amount >= 0" class="fa-solid fa-circle-up" :style="{color:'green'}"></i>
                                <i v-else class="fa-solid fa-circle-down" :style="{color:'red'}"></i>
                                {{ historique.amount }}{{ historique.currency }}
                            </td>
                            <td class="pb-4 pt-6 px-6 border-t text-start text-white">
                                {{ historique[$page.props.auth.user.main_currency] }}{{ $page.props.auth.user.main_currency }}
                            </td>
                            <td class="pb-4 pt-6 px-6 border-t text-center text-white">
                                {{ historique.from_name }}
                            </td>
                            <td class="pb-4 pt-6 px-6 border-t text-center text-white">
                                {{ historique.to_name }}
                            </td>
                            <td class="pb-4 pt-6 px-6 border-t text-center text-white">
                                {{ historique.format_created_at }}
                            </td>
                        </tr>
                        <tr v-if="historique_incame.length === 0">
                            <td class="px-6 py-4 border-t text-center" colspan="4"> Tickets impty </td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
            <!-- popup incame -->
            <div class="limit_fram" v-if="incame_frame">
                <div class="limit_panel">
                    <div class="header">
                        <div class="logo"><i class="fa-solid fa-cart-plus"></i></div>
                        <div class="exite" id="exit_popup" @click="incame_open"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                    </div>
                    <form @submit.prevent="incame_update" class="body_fram">
                        <div class="limit_type">
                            <div class="amont_part">
                                <label for="r1">
                                    amount
                                    <input name="limit_type" type="text" id="r1"
                                    v-model="incame_vars.amount"
                                    :error="incame_vars.errors.amount">
                                </label>
                                <label for="">
                                    currency
                                    <div class="carrency">
                                        <i class="fa-solid fa-coins"></i>
                                        <select 
                                            name="select carrency" 
                                            id="state" 
                                            class="carrency_select" 
                                            required
                                            v-model="incame_vars.currency"
                                            :error="incame_vars.errors.currency"
                                        >
                                            <option 
                                                v-for="carrency in $page.props.auth.carrency" 
                                                :key="carrency.id_carrency" 
                                                class="list-group-item list-group-item-action" 
                                                :value= carrency.currency>
                                                    {{ carrency.currency }}
                                                </option>
                                        </select>
                                    </div>
                                </label>
                            </div>
                            <label for="r3">
                                from :
                                <input name="limit_type"  type="text"
                                v-model="incame_vars.from"
                                :error="incame_vars.errors.from"
                                required>
                            </label>
                            <p>to : {{ $page.props.auth.user.name }}</p>
                        </div>
                        <div class="save">
                            <button type="submit">
                                save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- popup expenses -->
            <div class="limit_fram" v-if="expenses_frame">
                <div class="limit_panel">
                    <div class="header">
                        <div class="logo"><i class="fa-solid fa-cart-plus"></i></div>
                        <div class="exite" id="exit_popup" @click="expenses_open"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                    </div>
                    <form @submit.prevent="expenses_update" class="body_fram">
                        <div class="limit_type">
                            <div class="amont_part">
                                <label for="r1">
                                    amount
                                    <input name="limit_type" type="text" id="r1"
                                    v-model="expenses_vars.amount"
                                    :error="expenses_vars.errors.amount">
                                </label>
                                <label for="">
                                    currency
                                    <div class="carrency">
                                        <i class="fa-solid fa-coins"></i>
                                        <select 
                                            name="select carrency" 
                                            id="state" 
                                            class="carrency_select" 
                                            required
                                            v-model="expenses_vars.currency"
                                            :error="expenses_vars.errors.currency"
                                        >
                                            <option 
                                                v-for="carrency in $page.props.auth.carrency" 
                                                :key="carrency.id_carrency" 
                                                class="list-group-item list-group-item-action" 
                                                :value= carrency.currency>
                                                    {{ carrency.currency }}
                                                </option>
                                        </select>
                                    </div>
                                </label>
                            </div>
                            <p>from : {{ $page.props.auth.user.name }}</p>
                            <label for="r3">
                                to :
                                <input name="limit_type"  type="text"
                                v-model="expenses_vars.to"
                                :error="expenses_vars.errors.to"
                                required>
                            </label>
                        </div>
                        <div class="save">
                            <button type="submit">
                                save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    </AuthenticatedLayout>
</template>
<script setup>
// import AreaChart from '@/Components/sharts/shartWallet.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head , Link} from '@inertiajs/vue3';
</script>
<script>
export default {
components: {
    Link,
    Head,
    // AreaChart, 
},
props: {
    total_incame: Object,
    total_expenses: Object,
    TOTAL: Object,
    historique_incame: Object,
},
data() {
    return {
        incame_frame: false,
        incame_vars: this.$inertia.form({
            amount: null,
            currency: null,
            from: null,
            to: this.$page.props.auth.user.name,
        }),
        expenses_frame: false,
        expenses_vars: this.$inertia.form({
            amount: null,
            currency: null,
            from: this.$page.props.auth.user.name,
            to: null,
        }),
    }
},
methods: {
    incame_open(){
        this.incame_frame?
            this.incame_frame=false:
            this.incame_frame=true
    },
    expenses_open(){
        this.expenses_frame?
            this.expenses_frame=false:
            this.expenses_frame=true
    },
    expenses_update() {
        this.expenses_vars.post(`/MyWallet/expenses`, {
            onSuccess: () => {
            this.expenses_frame = false;
            this.expenses_vars.reset();
            },
        });
    },
    incame_update() {
        this.incame_vars.post(`/MyWallet/incame`, {
            onSuccess: () => {
            this.incame_frame = false;
            this.incame_vars.reset();
            },
        });
    },
},
mounted() {

},
computed: {

}
}
</script>
