<template>
    <Head title="Tickets" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-ticket"></i>
                /Tickets
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg region_big">
                    <div class="rounded-md shadow region_frame">
                        <!-- map -->
                        <div class="map">
                        </div>
                        <!-- table -->
                        <div class="table">
                            <table class="w-full tickets_table">
                                <thead>
                                <tr class="text-center font-bold bg-gray-600">
                                    <th class="pb-4 pt-6 px-6" colspan="3">states</th>
                                </tr>
                                </thead>
                                <tbody class="text-right">
                                    <tr v-for="(regions,index) in regions_tab" :key="regions.region" class="hover:bg-gray-100">
                                        <td class="border-t text-center text-white">
                                            {{ index }}
                                        </td>
                                        <td class="border-t text-center text-white">
                                            <button @click="openEdite_region(index)" 
                                                class="flex items-center px-6 py-4 focus:text-indigo-500" >
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </td>
                                        <td class="border-t text-center text-white show_button">
                                            <button @click="openShow_region(regions)" 
                                                class="flex items-center px-6 py-4 focus:text-indigo-500">
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- popup show -->
                        <div class="show_regions" v-if="show_frame_region">
                            <div class="fram">
                                <div class="header">
                                    <div class="exite" id="exit_popup" @click="openShow_region(state_list)"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                                </div>
                                <div class="state_list">
                                    <table class="w-full">
                                        <tbody class="text-right">
                                            <tr v-for="(states,index1) in state_list" :key="index1" class="hover:bg-gray-100">
                                                <td class="border-t text-center text-white px-6 py-4">
                                                    {{ states.state }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- popup edite -->
                        <div class="show_regions" v-if="edite_frame_region">
                            <div class="fram">
                                <div class="header">
                                    <div class="exite" id="exit_popup" @click="openEdite_region(id_region)"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                                </div>
                                <div class="state_add">
                                    <form @submit.prevent="region_save" class="form">
                                        <p>{{ region_form_update.region }}</p>
                                        <div class="state_name_field">
                                            <label for="">region
                                                <input 
                                                    type="text"
                                                    v-model="region_form_update.state"
                                                    :error="region_form_update.errors.state"
                                                >
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
                        </div>
                    </div>
                </div>
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
        regions_tab: Object,
    },

    data() {
        return {
            edite_frame_region: false,
            show_frame_region: false,
            id_region: null,
            state_list: null,
            region_form_update: this.$inertia.form({
                region: null,
                state: null,
            }),
        }
    },
    methods: {
        openEdite_region(regions) {
            if(this.edite_frame_region){
                this.edite_frame_region = false;
            }
            else{
                this.edite_frame_region = true;
                this.region_form_update.region = regions;
                this.id_region=regions;
            }
        },
        openShow_region(state) {
            if(this.show_frame_region){
                this.show_frame_region = false;
            }
            else{
                this.show_frame_region = true;
                this.state_list = state;
            }
        },
        region_save(){
            this.region_form_update.put(`/Region/store`, {
                preserveScroll: true,
                onSuccess: () => {
                this.edite_frame_region = false;
                this.region_form_update.reset();
                },
            });
        }
    },
}
</script>
