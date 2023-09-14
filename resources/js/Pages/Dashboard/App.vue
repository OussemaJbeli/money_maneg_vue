<!-- npm run serve -->
<template>
  <div id="app">
    test chart
    <ProgressBar :value="25" />
  </div>
</template>

<script>
import ProgressBar from '@/Components/sharts/ProgressBar.vue'

export default {
  name: 'App',
  components: {
    ProgressBar
  }
}
</script>