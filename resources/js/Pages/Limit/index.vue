<template>
    <Head title="Plane Target" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-check-to-slot"></i>
                /Plane Target
            </h2>
        </template>

        <div class="to_day_statistique plane_Target">
            ggggg
        </div>
        <div class="historique_statistique plane_Target">
            gggggggqqqq
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

    },

    data() {
        return {

        }
    },
    methods: {
        
    },
}
</script>
