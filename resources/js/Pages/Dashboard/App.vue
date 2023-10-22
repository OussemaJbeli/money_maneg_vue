<template>
  <div id="app">
    <horizontal-bar-chart :data="chartData"></horizontal-bar-chart>
  </div>
</template>

<script>
import HorizontalBarChart from '@/Components/sharts/HorizontalBarChart.vue';

export default {
  components: {
    HorizontalBarChart,
  },
  data() {
    return {
      chartData: [
        { label: 'Item 1', value: 30 },
        { label: 'Item 2', value: 50 },
        { label: 'Item 3', value: 70 },
        { label: 'Item 4', value: 40 },
      ],
    };
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
