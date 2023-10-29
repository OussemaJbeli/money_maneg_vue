<template>
    <Head title="Wallet" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-coins"></i>
                /My Wallet
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 ">
                        <h1>My Wallet</h1>
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
    Link,
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
mounted() {

},
computed: {

}
}
</script>
