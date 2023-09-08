<template>
    <Head title="Tickets - show" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-sitemap"></i>
                /Items / Show
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white rounded-md shadow overflow-x-auto">
                        <table class="w-full tickets_table">
                            <thead>
                            <tr class="text-center font-bold bg-gray-600">
                                <th class="pb-4 pt-6 px-6">name</th>
                                <th class="pb-4 pt-6 px-6">price(by one)</th>
                                <th class="pb-4 pt-6 px-6">currency</th>
                                <th class="pb-4 pt-6 px-6">quentity</th>
                                <th class="pb-4 pt-6 px-6">state</th>
                                <th class="pb-4 pt-6 px-6">region</th>
                                <th class="pb-4 pt-6 px-6" colspan="2"></th>
                            </tr>
                            </thead>
                            <tbody class="text-right">
                                <tr v-for="item in items" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <td class="border-t text-center text-white">
                                        {{ item.items }}
                                    </td>
                                    <td class="border-t text-center text-white">
                                        {{ item.item_prix }}
                                    </td>
                                    <td class="border-t text-center text-white">
                                        {{ item.currency }}
                                    </td>
                                    <td class="border-t text-center text-white">
                                        {{ item.item_quentity}}
                                    </td>
                                    <td class="border-t text-center text-white">
                                        {{ item.region}}
                                    </td>
                                    <td class="border-t text-center text-white">
                                        {{ item.state}}
                                    </td>
                                    <td class="border-t text-center text-white">
                                        <button @click="openEdite_items(item.id_item,
                                            item.items,item.categories,item.item_prix
                                            ,item.currency,item.item_quentity,item.region,item.state)" 
                                            class="flex items-center px-6 py-4 focus:text-indigo-500" >
                                            <i class="fa-solid fa-pen-to-square" style="color: #1d962b;"></i>
                                        </button>
                                    </td>
                                    <td class="border-t text-center text-white">
                                        <Link class="flex items-center px-6 py-4 focus:text-indigo-500" 
                                        :href="`/Items/${item.id_item}/delete`">
                                            <i class="fa-solid fa-trash" style="color: #e00000;"></i>
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="frame_edite_item" v-if="edite_frame">
            <div class="frame">
                <div class="header">
                    <div class="logo"><i class="fa-solid fa-cart-plus"></i></div>
                    <div class="exite" id="exit_popup" @click="openEdite_items(item_id)"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                </div>
                <form @submit.prevent="save_item_update" class="form">
                    <header>
                        <img :src="'/icon/items_icon/'+item_form_update.categorie+'/'+item_form_update.name+'.png'" alt="">
                        <p>{{ item_form_update.name }}</p>
                    </header>
                    <body>
                        <label for="">quentity
                            <input 
                                type="number"
                                v-model="item_form_update.quentity"
                                :error="item_form_update.errors.quentity"
                            >
                        </label>
                        <div class="input_group">
                            <label for="">price
                                <input 
                                type="text"
                                v-model="item_form_update.price"
                                :error="item_form_update.errors.price"
                            >
                            </label>
                            <label for="">currency
                                <select 
                                    name="select carrency" 
                                    id="state" 
                                    class="carrency_select" 
                                    required
                                    v-model="item_form_update.currency"
                                    :error="item_form_update.errors.currency"
                                >
                                    <option 
                                        v-for="carrency in $page.props.auth.carrency" 
                                        :key="carrency.id_carrency" 
                                        :id="carrency.currency"
                                        class="list-group-item list-group-item-action" 
                                        :value= carrency.id_carrency
                                        >
                                            {{ carrency.currency }}
                                    </option>
                                </select>
                            </label>
                        </div>
                        <div class="input_group">
                            <label for="">state                            
                                <select 
                                    name="select state" 
                                    id="state" 
                                    class="region_select" 
                                    required
                                    @click="regionshoser(item_form_update.region)"
                                    v-model="item_form_update.region"
                                    :error="item_form_update.errors.region"
                                >
                                    <option 
                                        v-for="(region, index) in $page.props.auth.regions" 
                                        :key="index" 
                                        :id="index"
                                        :value="region.region"
                                        class="list-group-item list-group-item-action" 
                                        >
                                            {{ region.region}}
                                    </option>
                                </select>
                            </label>
                            <label for="">region
                                <select 
                                    name="select state" 
                                    id="state" 
                                    class="region_select" 
                                    required
                                    v-model="item_form_update.state"
                                    :error="item_form_update.errors.state"
                                >
                                    <option 
                                        v-for="(state, index1) in region_selectetd" 
                                        :key="index1" 
                                        :id="index1"
                                        :value= index1
                                    >
                                        {{state}} 
                                    </option>
                                </select>
                            </label>
                        </div>
                    </body>
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
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>
<script>
export default {

    props: {
        items: Object,
    },
    data() {
        return {
            open_currency_select: false,
            item_id: null,
            region_selectetd: '',
            edite_frame : false,
            item_form_update: this.$inertia.form({
                name: null,
                categorie: null,
                price: null,
                currency: null,
                quentity: null,
                region: null,
                state: null,
            }),
        }
    },
    methods: {
        openEdite_items(id,names,categories,prices,currencys,quentitys,regions,states) {
            if(this.edite_frame){
                this.edite_frame = false;
            }
            else{
                this.edite_frame = true;
                this.item_form_update.name = names;
                this.item_form_update.categorie = categories;
                this.item_form_update.price = prices;
                this.item_form_update.currency = currencys;
                this.item_form_update.quentity = quentitys;
                this.item_form_update.region = regions;
                this.item_form_update.state = states;
                this.regionshoser(regions);
                this.item_id = id;
            }
        },
        regionshoser(region){
            switch (region) {
                    case 'Beja':
                    this.region_selectetd = this.$page.props.auth.regions.regions1.state
                    break;
                    case 'Ariana':
                    this.region_selectetd = this.$page.props.auth.regions.regions2.state
                    break;
                    case 'Manouba':
                    this.region_selectetd = this.$page.props.auth.regions.regions3.state
                    break;
                    case 'Tunis':
                    this.region_selectetd = this.$page.props.auth.regions.regions4.state
                    break;
                    case 'Kasserine':
                    this.region_selectetd = this.$page.props.auth.regions.regions5.state
                    break;
                    case 'Kairouan':
                    this.region_selectetd = this.$page.props.auth.regions.regions6.state
                    break;
                    case 'Jendouba':
                    this.region_selectetd = this.$page.props.auth.regions.regions7.state
                    break;
                    case 'Kef':
                    this.region_selectetd = this.$page.props.auth.regions.regions8.state
                    break;
                    case 'Mahdia':
                    this.region_selectetd = this.$page.props.auth.regions.regions9.state
                    break;
                    case 'Monastir':
                    this.region_selectetd = this.$page.props.auth.regions.regions10.state
                    break;
                    case 'Bizerte':
                    this.region_selectetd = this.$page.props.auth.regions.regions11.state
                    break;
                    case 'Nabeul':
                    this.region_selectetd = this.$page.props.auth.regions.regions12.state
                    break;
                    case 'Siliana':
                    this.region_selectetd = this.$page.props.auth.regions.regions13.state
                    break;
                    case 'Sousse':
                    this.region_selectetd = this.$page.props.auth.regions.regions14.state
                    break;
                    case 'Ben_Arous':
                    this.region_selectetd = this.$page.props.auth.regions.regions15.state
                    break;
                    case 'Medenine':
                    this.region_selectetd = this.$page.props.auth.regions.regions16.state
                    break;
                    case 'Gabes':
                    this.region_selectetd = this.$page.props.auth.regions.regions17.state
                    break;
                    case 'Gafsa':
                    this.region_selectetd = this.$page.props.auth.regions.regions18.state
                    break;
                    case 'Kebili':
                    this.region_selectetd = this.$page.props.auth.regions.regions19.state
                    break;
                    case 'Sfax':
                    this.region_selectetd = this.$page.props.auth.regions.regions20.state
                    break;
                    case 'Sidi_Bouzid':
                    this.region_selectetd = this.$page.props.auth.regions.regions21.state
                    break;
                    case 'Tataouine':
                    this.region_selectetd = this.$page.props.auth.regions.regions22.state
                    break;
                    case 'Tozeur':
                    this.region_selectetd = this.$page.props.auth.regions.regions23.state
                    break;
                    case 'Zaghouan':
                    this.region_selectetd = this.$page.props.auth.regions.regions24.state
                    break;
                default:
                    break;
            }
        },
        save_item_update() {
            this.item_form_update.put(`/Items/${this.item_id}/update`, {
                onSuccess: () => {
                this.edite_frame = false;
                this.item_form_update.reset();
                },
            });
        },
    },
}
</script>