<template>
    <Head title="Plane Target" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-check-to-slot"></i>
                /Plane Target
            </h2>
        </template>
        <div class="chart_target" v-if="Target_limit.target_data">
            <div class="to_day_statistique plane_Target">
                <p class="title">Today Statistique</p>
                <div class="chart">
                    <div class="plane_chart">
                        <div class="big_circle"
                        :style="{
                                backgroundColor:(Target_limit.percent[$page.props.auth.user.main_currency] <= 80)? 
                                `#0363e0`:'red'
                                }">
                            <div class="under_circle">
                            </div>
                        </div>
                        <div class="frame_plane"
                            :style="{ transform: (Target_limit.percent[$page.props.auth.user.main_currency] <= 100)? 
                                `rotateZ(${ Target_limit.percent[$page.props.auth.user.main_currency] * 1.8}deg)`:
                                'rotateZ(180deg)'}"
                            >
                        </div>
                        <div class="target_edit">
                            <p class="progress_persent">{{ Target_limit.percent[$page.props.auth.user.main_currency]  }}%</p>
                            <button @click="openLimit_add">Edite target</button>
                        </div>
                    </div>
                    <div class="details">
                        <div class="cards_details">
                            <div class="cards total_card" v-if="Target_limit['total_days'] != 1">
                                <p>{{ Target_limit['total_days'] }} days details</p>
                                <div class="dayly_target target_card">
                                    <p class="title_color">
                                        <i class="fa-solid fa-star"></i>
                                        total
                                    </p>
                                    <span>{{ Target_limit.target_data['limit'+$page.props.auth.user.main_currency] }} {{ $page.props.auth.user.main_currency }}</span>
                                </div>
                                <div class="your_consomation target_card">
                                    <p class="title_color">
                                        <i class="fa-solid fa-user"></i>
                                        your consom
                                    </p>
                                    <span v-if="Target_limit.target_deference[0][$page.props.auth.user.main_currency]">{{ Target_limit.target_deference[0][$page.props.auth.user.main_currency]}} {{ $page.props.auth.user.main_currency }}</span>
                                    <span v-else>0 {{ $page.props.auth.user.main_currency }}</span>
                                </div>
                                <div class="rest target_card">
                                    <p class="title_color"
                                    :style="{ backgroundColor: ((Target_limit.target_data_avrig['avrig_perday'+$page.props.auth.user.main_currency] - today[0][$page.props.auth.user.main_currency]) > 0)? 'green' : 'red' }"
                                    >
                                        <i class="fa-solid fa-chart-line"></i>
                                        rest of money
                                    </p>
                                    <span v-if="Target_limit.target_deference[0][$page.props.auth.user.main_currency]">
                                        {{ (Target_limit.target_data['limit'+$page.props.auth.user.main_currency] - Target_limit.target_deference[0][$page.props.auth.user.main_currency]).toFixed(1) }} {{ $page.props.auth.user.main_currency }}
                                    </span>
                                    <span v-else>{{ Target_limit.target_data['limit'+$page.props.auth.user.main_currency] }} {{ $page.props.auth.user.main_currency }}</span>
                                </div>
                            </div>
                            <div class="cards dayly_cards">
                                <p>today details</p>
                                <div class="dayly_target target_card">
                                    <p class="title_color">
                                        <i class="fa-solid fa-star"></i>
                                        Target/day
                                    </p>
                                    <span>{{ Target_limit.target_data_avrig['avrig_perday'+$page.props.auth.user.main_currency] }} {{ $page.props.auth.user.main_currency }}</span>
                                </div>
                                <div class="your_consomation target_card">
                                    <p class="title_color">
                                        <i class="fa-solid fa-user"></i>
                                        consom/day
                                    </p>
                                    <span v-if="today[0][$page.props.auth.user.main_currency]">{{ today[0][$page.props.auth.user.main_currency] }} {{ $page.props.auth.user.main_currency }}</span>
                                    <span v-else>0 {{ $page.props.auth.user.main_currency }}</span>
                                </div>
                                <div class="rest target_card">
                                    <p class="title_color"
                                    :style="{ backgroundColor: ((Target_limit.target_data_avrig['avrig_perday'+$page.props.auth.user.main_currency] - today[0][$page.props.auth.user.main_currency]) > 0)? 'green' : 'red' }"
                                    >
                                        <i class="fa-solid fa-chart-line"></i>
                                        rest/day
                                    </p>
                                    <span v-if="today[0][$page.props.auth.user.main_currency]">
                                        {{ (Target_limit.target_data_avrig['avrig_perday'+$page.props.auth.user.main_currency] - today[0][$page.props.auth.user.main_currency]).toFixed(1) }} {{ $page.props.auth.user.main_currency }}
                                    </span>
                                    <span v-else>{{ Target_limit.target_data_avrig['avrig_perday'+$page.props.auth.user.main_currency] - 0 }} {{ $page.props.auth.user.main_currency }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="reset_day">
                            <p>{{ Target_limit.rangday }} days until reset ( {{ Target_limit.dayname }}, {{ Target_limit.monthname}} {{ Target_limit.daynum }}, {{ Target_limit.year }})</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="historique_statistique plane_Target">
                <p class="title">
                    <span>Historique Statistique</span>
                    <span class="type">{{ Target_limit.target_data['limit_type'] }}</span>
                    <span class="from_to">from : {{ Target_limit.target_data['start_date'] }} ,to : {{ Target_limit.target_data['reset_date'] }}</span>
                </p>
                <table class="w-full tickets_table">
                    <thead>
                        <tr class="text-center font-bold bg-gray-600">
                            <th class="pb-4 pt-6 px-6">date</th>
                            <th class="pb-4 pt-6 px-6">target money /day</th>
                            <th class="pb-4 pt-6 px-6">your consom /day</th>
                            <th class="pb-4 pt-6 px-6">defernence</th>
                        </tr>
                    </thead>
                    <tbody class="text-right">
                        <tr v-for="(Target,index) in Target_limit.target_mereg" :key="index" class="hover:bg-gray-100">
                            <td class="pb-4 pt-6 px-6 border-t text-center text-white">
                                {{ Target.ticket_date }}
                            </td>
                            <td class="pb-4 pt-6 px-6 border-t text-center text-white">
                                {{ Target_limit.target_data['avrig_perday'+$page.props.auth.user.main_currency].toFixed(1) }} {{ $page.props.auth.user.main_currency }}
                            </td>
                            <td class="pb-4 pt-6 px-6 border-t text-center text-white">
                                {{ Target[$page.props.auth.user.main_currency] }} {{ $page.props.auth.user.main_currency }}
                            </td>
                            <td class="pb-4 pt-6 px-6 border-t text-center text-white"
                                :style="{
                                    color:(Target_limit.target_data['avrig_perday'+$page.props.auth.user.main_currency] - Target[$page.props.auth.user.main_currency]) <= 0? 
                                    `red`:'green'
                                }">
                                <i class="fa-solid fa-arrow-down" style="color: red;" v-if="(Target_limit.target_data['avrig_perday'+$page.props.auth.user.main_currency] - Target[$page.props.auth.user.main_currency]) <= 0"></i>
                                <i class="fa-solid fa-arrow-up" style="color: green;" v-else></i>
                                {{ (Target_limit.target_data['avrig_perday'+$page.props.auth.user.main_currency] - Target[$page.props.auth.user.main_currency]).toFixed(1) }} {{ $page.props.auth.user.main_currency }}
                            </td>
                        </tr>
                        <tr v-if="Target_limit.length != 0"
                            :style="{
                                        backgroundColor:(Target_limit.target_data['avrig_perday'+$page.props.auth.user.main_currency]*Target_limit.target_length) - Target_limit.target_deference[0][$page.props.auth.user.main_currency] < 0? 
                                        `#d11515`:'#48d115'
                                    }">
                            <td class="px-28 py-4 border-t text-start" colspan="3"> total </td>
                            <td class="px-6 py-4 border-t text-center" > {{ ((Target_limit.target_data['avrig_perday'+$page.props.auth.user.main_currency]*Target_limit.target_length) - Target_limit.target_deference[0][$page.props.auth.user.main_currency]).toFixed(2) }} {{ $page.props.auth.user.main_currency }} </td>
                        </tr>
                        <tr v-if="Target_limit.length === 0">
                            <td class="px-6 py-4 border-t text-center" colspan="4"> Tickets impty </td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
        <div class="chart_target" v-else>
            <div class="to_day_statistique plane_Target">
                <p class="title">Today Statistique</p>
                <div class="chart">
                    <div class="plane_chart_add">
                        <p>Money Monegment can help you to stay under your money limit,
                            enter your money limit and we'll warn you when you're close to it
                        </p>
                        <div class="target_edit">
                            <button @click="openLimit_add">Add target</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="historique_statistique plane_Target">
                <p class="title">
                    <span>Historique Statistique</span>
                </p>
                <table class="w-full tickets_table">
                    <thead>
                        <tr class="text-center font-bold bg-gray-600">
                            <th class="pb-4 pt-6 px-6">date</th>
                            <th class="pb-4 pt-6 px-6">target money /day</th>
                            <th class="pb-4 pt-6 px-6">your consom /day</th>
                            <th class="pb-4 pt-6 px-6">defernence</th>
                        </tr>
                    </thead>
                    <tbody class="text-right">
                        <tr>
                            <td class="px-6 py-4 border-t text-center" colspan="4"> plan target impty </td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
        <!-- popup limit -->
            <div class="limit_fram" v-if="openLimit_add_frame">
                <div class="limit_panel">
                    <div class="header">
                        <div class="logo"><i class="fa-solid fa-cart-plus"></i></div>
                        <div class="exite" id="exit_popup" @click="openLimit_add"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                    </div>
                    <form @submit.prevent="add_plane" class="body_fram">
                        <div class="limit_type">
                            <p>Limit Type</p>
                            <label for="r1">
                                <input name="limit_type" type="radio" id="r1"
                                value="monthly"
                                v-model="limit_form_add.selectedOption_add"
                                :error="limit_form_add.errors.selectedOption_add">
                                monthly
                            </label>
                            <label for="r2">
                                <input name="limit_type"  type="radio" id="r2"
                                value="dayly"
                                v-model="limit_form_add.selectedOption_add"
                                :error="limit_form_add.errors.selectedOption_add">
                                dayly
                            </label>
                            <label for="r3">
                                <input name="limit_type"  type="radio" id="r3"
                                value="custom"
                                v-model="limit_form_add.selectedOption_add"
                                :error="limit_form_add.errors.selectedOption_add">
                                custom
                            </label>
                        </div>
                        <div class="limit_date" v-if="limit_form_add.selectedOption_add == 'custom' ">
                            <p>Limit date</p>
                            <div class="group">
                                <label for="date1">
                                    from<input 
                                        type="date" 
                                        id="date2"
                                        v-model="limit_form_add.date_from_add"
                                        :error="limit_form_add.errors.date_from_add"
                                        required
                                    >
                                </label>
                                <label for="date2">
                                    to<input 
                                        type="date" 
                                        id="date2"
                                        v-model="limit_form_add.date_to_add"
                                        :error="limit_form_add.errors.date_to_add"
                                        required
                                    >
                                </label>
                            </div>
                        </div>
                        <div class="limit">
                            <p>Limit date</p>
                            <div class="group">
                                <label for="r3">
                                    Money Limit
                                    <input name="limit_type"  type="text"
                                    v-model="limit_form_add.value_add"
                                    :error="limit_form_add.errors.value_add"
                                    required>
                                </label>
                                <label for="r3">
                                    Currency
                                    <select name="currency"
                                    v-model="limit_form_add.currency_add"
                                    :error="limit_form_add.errors.currency_add"
                                    required>
                                        <option :value= '"TND"' selected>TND</option>
                                        <option :value= '"USD"'>USD</option>
                                        <option :value= '"EUR"'>EUR</option>
                                    </select>
                                </label>
                            </div>
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
        today: Object,
        Target_limit: Object,
    },

    data() {
        return {
            limit_form_add: this.$inertia.form({
                selectedOption_add: "monthly",
                date_to_add: null,
                date_from_add: null,
                value_add: null,
                currency_add: null,
            }),
            id_limit: 0,
            show_select_chart: 'this Month',
            openLimit_add_frame: false,
        }
    },
    methods: {
        openLimit_add() {
            if(this.openLimit_add_frame)
                this.openLimit_add_frame=false;
            else{
                this.openLimit_add_frame=true;
                if(this.Target_limit.target_data){
                    this.id_limit = this.Target_limit.target_data.id;
                }
            }
        },
        add_plane() {
            this.limit_form_add.get(`/Limit/${this.id_limit}/create_plan_target`, {
                preserveScroll: true,
                onSuccess: () => {
                this.openLimit_add_frame = false;
                this.limit_form_add.reset();
                },
            });
        },
    },
}
</script>
