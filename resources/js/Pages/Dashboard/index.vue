<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-chart-line"></i>
                /Dashboard</h2>
        </template>
        <div class="cards_panel">
            <total_cards class="first_card">
                <div class="logo_card">
                    <i class="fa-solid fa-star"></i>
                    <p>today ({{ date.day }})</p>
                </div>
                <div class="values_card" v-for="(today_value,index) in today" :key="index">
                    <p class="value" v-if="today_value[$page.props.auth.user.main_currency]">
                        {{ today_value[$page.props.auth.user.main_currency] }}
                        <span>{{ $page.props.auth.user.main_currency }}</span>
                    </p>
                    <p class="value" v-else>
                        0
                        <span>{{ $page.props.auth.user.main_currency }}</span>
                    </p>
                </div>
                <p class="title_card">Totale for this day</p>
            </total_cards>
            <total_cards class="second_card">
                <div class="logo_card">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <p>week(Mon/Sun)</p>
                </div>
                <div class="values_card" v-for="(week_value,index) in week" :key="index">
                    <p class="value" v-if="week_value[$page.props.auth.user.main_currency]">
                        {{ week_value[$page.props.auth.user.main_currency] }}
                        <span>{{ $page.props.auth.user.main_currency }}</span>
                    </p>
                    <p class="value" v-else>
                        0
                        <span>{{ $page.props.auth.user.main_currency }}</span>
                    </p>
                </div>
                <p class="title_card">Totale for this week</p>
            </total_cards>
            <total_cards class="theerd_card">
                <div class="logo_card">
                    <i class="fa-solid fa-truck"></i>
                    <p>month({{ date.month }})</p>
                </div>
                <div class="values_card" v-for="(month_value,index) in month" :key="index">
                    <p class="value" v-if="month_value[$page.props.auth.user.main_currency]">
                        {{ month_value[$page.props.auth.user.main_currency] }}
                        <span>{{ $page.props.auth.user.main_currency }}</span>
                    </p>
                    <p class="value" v-else>
                        0
                        <span>{{ $page.props.auth.user.main_currency }}</span>
                    </p>
                </div>
                <p class="title_card">Totale for this month</p>
            </total_cards>
        </div>
        <!-- //charts -->
        <div class="charts_frame">
            <charts class="first_chart">
                <div class="chart_store_by">
                    <p>Expenses Details</p>
                    <select 
                        name="" 
                        id=""
                        v-model="form.selectedOption"
                        :error="form.errors.selectedOption"
                    >
                        <option value="this Month" selected>this Month</option>
                        <option value="last Month">last Month</option>
                    </select>
                </div>
                <BarChart 
                    class='barchart'
                    v-if="form.selectedOption == 'this Month'"
                    :options="chartOptions"
                    :data="chartData"
                />
                <BarChart 
                    class='barchart'
                    v-else
                    :options="chartOptions"
                    :data="chartData1"
                />
            </charts>
            <target_limit class="second_chart">
                <div class="chart" v-if="Target_limit.target_data">
                    <div class="plane_chart">
                        <div class="big_circle">
                            <div class="under_circle"></div>
                        </div>
                        <div class="frame_plane"
                        :style="{ 
                            transform: `rotateZ(${ (Target_limit.target_mereg[0][$page.props.auth.user.main_currency] * 100)/Target_limit.target_data['limit'+$page.props.auth.user.main_currency] * 1.8}deg)` 
                        }">
                        </div>
                        <div class="target_edit">
                            <p class="progress_persent">{{ (Target_limit.target_mereg[0][$page.props.auth.user.main_currency] * 100)/Target_limit.target_data['limit'+$page.props.auth.user.main_currency] }}%</p>
                            <p class="progress_currency" v-if="Target_limit.target_mereg[0][$page.props.auth.user.main_currency]">
                                {{ Target_limit.target_mereg[0][$page.props.auth.user.main_currency]}} {{ $page.props.auth.user.main_currency }} / {{ Target_limit.target_data['limit'+$page.props.auth.user.main_currency] }} {{ $page.props.auth.user.main_currency }}
                            </p>
                            <p class="progress_currency" v-else>
                                0 {{ $page.props.auth.user.main_currency }} / {{ Target_limit.target_data['limit'+$page.props.auth.user.main_currency] }} {{ $page.props.auth.user.main_currency }}
                            </p>
                            <button @click="openLimit_add">Edite target</button>
                        </div>
                    </div>
                    <div class="details">
                        <div class="cards">
                            <div class="dayly_target target_card">
                                <p>
                                    <i class="fa-solid fa-star"></i>
                                    Dayly Target
                                </p>
                                <span>{{ Target_limit.target_data_avrig['avrig_perday'+$page.props.auth.user.main_currency] }} {{ $page.props.auth.user.main_currency }}</span>
                            </div>
                            <div class="your_consomation target_card">
                                <p>
                                    <i class="fa-solid fa-user"></i>
                                    today Consomation
                                </p>
                                <span v-if="today[0][$page.props.auth.user.main_currency]">{{ today[0][$page.props.auth.user.main_currency] }} {{ $page.props.auth.user.main_currency }}</span>
                                <span v-else>0 {{ $page.props.auth.user.main_currency }}</span>
                            </div>
                        </div>
                        <div class="reset_day">
                            <p>{{ Target_limit.rangday }} days until reset ( {{ Target_limit.dayname }}, {{ Target_limit.monthname}} {{ Target_limit.daynum }}, {{ Target_limit.year }})</p>
                        </div>
                    </div>
                </div>
                <div class="chart" v-else>
                    <div class="plane_chart_add">
                        <p>Money Monegment can help you to stay under your money limit,
                            enter your money limit and we'll warn you when you're close to it
                        </p>
                        <div class="target_edit">
                            <button @click="openLimit_add">Add target</button>
                        </div>
                    </div>
                </div>
            </target_limit>
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
                                    from 
                                    <input type="text" readonly :value=date.year>
                                </label>
                                <label for="date2">
                                    to<input name="date_to"  type="date" id="date2"
                                    v-model="limit_form_add.date_to_add"
                                    :error="limit_form_add.errors.date_to_add_add"
                                    required>
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
        </div>
        <!-- //list -->
        <div class="lists_frame_big">
            <div class="Top_10">
                <p>story Details</p>
                <div class="chart_store_by">
                    <select 
                        v-model="form.selectedTop10"
                        :error="form.errors.selectedTop10"
                    >
                        <option value="by price" selected>by price</option>
                        <option value="by quentity">by quentity</option>
                    </select>
                </div>
            </div>
            <div class="lists_frame">
                <lists class="list_panel1 list_panel">
                    <total_cards class="first_card_rank card_rank">
                        <div class="lsit1">
                            <div class="logo_card">
                                <i class="fa-solid fa-ticket"></i>
                                <p>Tickets</p>
                            </div>
                        </div>
                    </total_cards>
                    <div class="first_list list_data">
                        <div  v-if="form.selectedTop10 == 'by price'" class=" 
                            row_list" v-for="(runk_Ticket, index) in  runk_Tickets.runk_tickets_price" :key="index">
                            <div class="icon">
                                <i class="fa-solid fa-ticket"></i>
                            </div>
                            <div class="info">
                                <div class="title">{{ runk_Ticket.ticket_date }}</div>
                                <div class="parcour">
                                    <div class="chartframe">
                                        <div 
                                            class="chart_panel1 chart_panel"
                                            :style="{ 
                                                width: `${(runk_Ticket[$page.props.auth.user.main_currency] * 100) / runk_Tickets.total_price[0][$page.props.auth.user.main_currency]}%` 
                                            }">
                                        </div>
                                    </div>
                                    <div class="number">
                                        {{ runk_Ticket[$page.props.auth.user.main_currency] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else class=" row_list" v-for="(runk_Ticket, index1) in  runk_Tickets.runk_tickets_quentity" :key="index1">
                            <div class="icon">
                                <i class="fa-solid fa-ticket"></i>
                            </div>
                            <div class="info">
                                <div class="title">{{ runk_Ticket.ticket_date }}</div>
                                <div class="parcour">
                                    <div class="chartframe">
                                        <div 
                                            class="chart_panel1 chart_panel"
                                            :style="{ 
                                                width: `${(runk_Ticket.quentity * 100) / runk_Tickets.total_quentity[0].quentity}%` 
                                            }">
                                        </div>
                                    </div>
                                    <div class="number">
                                        {{ runk_Ticket.quentity }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </lists>
                <lists class="list_panel2 list_panel">
                    <total_cards class="second_card_rank card_rank">
                        <div class="lsit1">
                            <div class="logo_card">
                                <i class="fa-solid fa-sitemap"></i>
                                <p>Items</p>
                            </div>
                        </div>
                    </total_cards>
                    <div class="second_list list_data">
                        <div v-if="form.selectedTop10 == 'by price'" class="row_list" 
                            v-for="(runk_item, index) in  runk_items.runk_item_price" :key="index">
                            <div class="icon">
                                <img id="item_path" :src="'/icon/items_icon/'+runk_item.categories+'/'+runk_item.items+'.png'">
                            </div>
                            <div class="info">
                                <div class="title">{{ runk_item.items }}</div>
                                <div class="parcour">
                                    <div class="chartframe">
                                        <div class="chart_panel2 chart_panel"
                                        :style="{ 
                                                width: `${(runk_item[$page.props.auth.user.main_currency] * 100) / runk_items.total_price[0][$page.props.auth.user.main_currency]}%` 
                                            }">

                                        </div>
                                    </div>
                                    <div class="number">
                                        {{ runk_item[$page.props.auth.user.main_currency] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else class="row_list" v-for="(runk_item, index1) in  runk_items.runk_item_quentity" :key="index1">
                            <div class="icon">
                                <img id="item_path" :src="'/icon/items_icon/'+runk_item.categories+'/'+runk_item.items+'.png'">
                            </div>
                            <div class="info">
                                <div class="title">{{ runk_item.items }}</div>
                                <div class="parcour">
                                    <div class="chartframe">
                                        <div class="chart_panel2 chart_panel"
                                        :style="{ 
                                                width: `${(runk_item.item_quentity * 100) / runk_Tickets.total_quentity[0].quentity}%` 
                                            }">
                                        </div>
                                    </div>
                                    <div class="number">
                                        {{ runk_item.item_quentity }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </lists>
                <lists class="list_panel3 list_panel">
                    <total_cards class="third_card_rank card_rank">
                        <div class="lsit1">
                            <div class="logo_card">
                                <i class="fa-solid fa-globe"></i>
                                <p>Region</p>
                            </div>
                        </div>
                    </total_cards>
                    <div class="third_list list_data">
                        <div v-if="form.selectedTop10 == 'by price'" class="row_list" 
                            v-for="(runk_regions, index) in  runk_region.runk_region_price" :key="index">
                            <div class="icon">
                                <i class="fa-solid fa-globe"></i>
                            </div>
                            <div class="info">
                                <div class="title">{{ runk_regions.state }}</div>
                                <div class="parcour">
                                    <div class="chartframe">
                                        <div class="chart_panel3 chart_panel"
                                        :style="{ 
                                                width: `${(runk_regions[$page.props.auth.user.main_currency] * 100) / runk_Tickets.total_price[0][$page.props.auth.user.main_currency]}%` 
                                            }">
                                        </div>
                                    </div>
                                    <div class="number">
                                        {{ runk_regions[$page.props.auth.user.main_currency] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else class="row_list" v-for="(runk_regions, index1) in  runk_region.runk_region_quentity" :key="index1">
                            <div class="icon">
                                <i class="fa-solid fa-globe"></i>
                            </div>
                            <div class="info">
                                <div class="title">{{ runk_regions.state }}</div>
                                <div class="parcour">
                                    <div class="chartframe">
                                        <div class="chart_panel3 chart_panel"
                                        :style="{ 
                                                width: `${(runk_regions.quentity * 100) / runk_Tickets.total_quentity[0].quentity}%` 
                                            }">
                                        </div>
                                    </div>
                                    <div class="number">
                                        {{ runk_regions.quentity }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </lists>
                <lists class="list_panel4 list_panel">
                    <total_cards class="forth_card_rank card_rank">
                        <div class="lsit1">
                            <div class="logo_card">
                                <i class="fa-solid fa-coins"></i>
                                <p>Currency</p>
                            </div>
                        </div>
                    </total_cards>
                    <div class="forth_list list_data">
                        <div v-if="form.selectedTop10 == 'by price'" class="row_list" v-for="(runk_currencys, index) in  runk_currency.runk_currency_price" :key="index">
                            <div class="icon">
                                <img :src="'/icon/currency/'+runk_currencys.currency+'.png'">
                            </div>
                            <div class="info">
                                <div class="title">
                                    {{ runk_currencys.total_price }} {{ runk_currencys.currency }} => {{ runk_currencys[$page.props.auth.user.main_currency] }} {{ $page.props.auth.user.main_currency }}
                                </div>
                                <div class="parcour">
                                    <div class="chartframe">
                                        <div class="chart_panel4 chart_panel"
                                        :style="{ 
                                                width: `${(runk_currencys[$page.props.auth.user.main_currency] * 100) / runk_Tickets.total_price[0][$page.props.auth.user.main_currency]}%` 
                                            }">
                                        </div>
                                    </div>
                                    <div class="number">
                                        {{ runk_currencys.currency }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else class="row_list" v-for="(runk_currencys, index1) in  runk_currency.runk_currency_quentity" :key="index1">
                            <div class="icon">
                                <img :src="'/icon/currency/'+runk_currencys.currency+'.png'">
                            </div>
                            <div class="info">
                                <div class="title">{{ runk_currencys.quentity }} Items</div>
                                <div class="parcour">
                                    <div class="chartframe">
                                        <div class="chart_panel4 chart_panel"
                                        :style="{ 
                                                width: `${(runk_currencys.quentity * 100) / runk_Tickets.total_quentity[0].quentity}%` 
                                            }">
                                        </div>
                                    </div>
                                    <div class="number">
                                        {{ runk_currencys.currency }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </lists>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import charts from '@/Components/cards/charts.vue';
import total_cards from '@/Components/cards/total_cards.vue';
import lists from '@/Components/cards/lists.vue';
import target_limit from '@/Components/cards/target_limit.vue';
import { Head } from '@inertiajs/vue3';
import BarChart from '@/Components/sharts/BarChart.vue';
</script>

<script>
export default {
    name: 'App',
    components: {
        Head,
        BarChart,
    },
    props: {
        date: Object,
        today: Object,
        week: Object,
        month_chart: Object,
        month: Object,
        items: Object,
        regions_tab: Object,
        chart: Object,
        runk_Tickets: Object,
        runk_items: Object,
        runk_region: Object,
        runk_currency: Object,
        Target_limit: Object,
    },

    data() {
        return {
            chartData: {
                labels: this.chart.thisMonth_select.number_days,
                datasets: [{
                    label: this.$page.props.auth.user.main_currency+' in one day',
                    backgroundColor: '#0363e0',
                    data: this.shart_data_fun1(),
                }]
            },
            chartData1: {
                labels: this.chart.lastMonth_select.number_days,
                datasets: [{
                    label: this.$page.props.auth.user.main_currency+' in one day',
                    backgroundColor: '#0363e0',
                    data: this.shart_data_fun2(),
                }]
            },
            chartOptions: {
                responsive: false
            },
            form: this.$inertia.form({
                selectedOption: 'this Month',
                selectedTop10: 'by price',
            }),
            id_limit: 0,
            show_select_chart: 'this Month',
            openLimit_frame: false,
            openLimit_add_frame: false,
            limit_form_add: this.$inertia.form({
                selectedOption_add: "monthly",
                date_to_add: null,
                value_add: null,
                currency_add: null,
            }),
        }
    },
    methods: {
        shart_data_fun1(){
            switch (this.$page.props.auth.user.main_currency) {
                case 'TND':
                    return this.chart.thisMonth_select.TND
                case 'USD':
                    return this.chart.thisMonth_select.USD
                case 'EUR':
                    return this.chart.thisMonth_select.EUR
                default:
                    break;
            }
        },
        shart_data_fun2(){
            switch (this.$page.props.auth.user.main_currency) {
                case 'TND':
                    return this.chart.lastMonth_select.TND
                case 'USD':
                    return this.chart.lastMonth_select.USD
                case 'EUR':
                    return this.chart.lastMonth_select.EUR
                default:
                    break;
            }
        },
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
            this.limit_form_add.get(`/Limit/${this.id_limit}`, {
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