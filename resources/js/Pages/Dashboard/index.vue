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
                    <p>daily</p>
                </div>
                <div class="values_card">
                    <p class="value">20<span>DT</span></p>
                </div>
                <p class="title_card">Totale for this day</p>
            </total_cards>
            <total_cards class="second_card">
                <div class="logo_card">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <p>monthly</p>
                </div>
                <div class="values_card">
                    <p class="value">168<span>DT</span></p>
                </div>
                <p class="title_card">Totale for this month</p>
            </total_cards>
            <total_cards class="theerd_card">
                <div class="logo_card">
                    <i class="fa-solid fa-truck"></i>
                    <p>annual</p>
                </div>
                <div class="values_card">
                    <p class="value">1238<span>DT</span></p>
                </div>
                <p class="title_card">Totale for this year</p>
            </total_cards>
            <total_cards class="forth_card">
                <div class="logo_card">
                    <i class="fa-solid fa-money-bill-trend-up"></i>
                    <p>Ticket</p>
                </div>
                <div class="values_card">
                    <p class="value">950<span>DT</span></p>
                </div>
                <p class="title_card">Most expensive tickets</p>
            </total_cards>
        </div>
        <!-- //charts -->
        <div class="charts_frame">
            <charts class="first_chart">
            </charts>
            <charts class="second_chart">
            </charts>
            <charts class="third_chart">
            </charts>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import charts from '@/Components/cards/charts.vue';
import total_cards from '@/Components/cards/total_cards.vue';
import { Head } from '@inertiajs/vue3';
</script>
<script>
export default {
    components: {
        Head,
    },
    props: {
    },
    data() {
        return {
            
        }
    },
    methods: {

    },
}
</script>