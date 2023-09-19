<template>
    <div>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
        </svg>
        <div v-if="successMessage" class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
                {{ successMessage }}
            </div>
        </div>
        <div class="min-h-screen bg-gray-100 main_frame">
<!-- ////////////////////////////////////nave barre//////////////////////// -->
            <nav class="bg-white border-b border-gray-100 side_barre"
                :style="{ width: (sid_bar || test_side)? '' : '70px' ,left:sid_bar_second?'0': ''}"
                @mouseover="hover_side_bar" @mouseout="out_side_bar"
                >
                <div class="back_block_transparent"></div>
                <div class="side_color_picture" id="side_color_picture"
                :style="{ width: (sid_bar || test_side)? '' : '250px' }">
                    <img :src="'/'+$page.props.auth.user.sid_img ">
                </div>
                    <div class="flex justify-between h-16 nave_liste">
                        <!-- **************nave option*************** -->
                        <div class="flex nave_options">
                            <div class="close_sid_bar" @click="min_sid_bar_second"><i class="fa-solid fa-x"></i></div>
                            <!-- Logo -->
                            <div class="Logo_user">
                                <Link :href="route('profile.edit')">
                                    <img class="user_logo" :src="'/'+$page.props.auth.user.avatar "
                                    :style="{ height: (sid_bar || test_side)? '' : '60px',width: (sid_bar || test_side)? '' : '60px' }" >
                                    <p class="user_name_logo" :style="{ visibility: (sid_bar || test_side)? '' : 'hidden' }">{{ $page.props.auth.user.name }}</p>       
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex options_nave">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="NavLink">
                                    <i class="fa-solid fa-chart-line" :style="{ left: (sid_bar || test_side)? '' : '15px' }"></i>
                                    <p :style="{ visibility: (sid_bar || test_side)? '' : 'hidden' }">Dashboard</p>
                                </NavLink>
                                <NavLink :href="route('Limit')" :active="route().current('Limit')" class="NavLink">
                                    <i class="fa-solid fa-check-to-slot" :style="{ left: (sid_bar || test_side)? '' : '15px' }"></i>
                                    <p :style="{ visibility: (sid_bar || test_side)? 'visible' : 'hidden' }">Plan Target</p>
                                </NavLink>
                                <NavLink :href="route('Tickets')" :active="route().current('Tickets')" class="NavLink">
                                    <i class="fa-solid fa-ticket"  :style="{ left: (sid_bar || test_side)? '' : '15px' }"></i>
                                    <p :style="{ visibility: (sid_bar || test_side)? '' : 'hidden' }">Tickets</p>
                                </NavLink>
                                <NavLink :href="route('Items')" :active="route().current('Items')" class="NavLink">
                                    <i class="fa-solid fa-sitemap"  :style="{ left: (sid_bar || test_side)? '' : '15px' }"></i>
                                    <p :style="{ visibility: (sid_bar || test_side)? '' : 'hidden' }">Items</p>
                                </NavLink>
                                <NavLink :href="route('Carrency')" :active="route().current('Carrency')" class="NavLink">
                                    <i class="fa-solid fa-coins"  :style="{ left: (sid_bar || test_side)? '' : '15px' }"></i>
                                    <p :style="{ visibility: (sid_bar || test_side)? '' : 'hidden' }">Currency</p>
                                </NavLink>
                                <NavLink :href="route('Region')" :active="route().current('Region')" class="NavLink">
                                    <i class="fa-solid fa-globe"  :style="{ left: (sid_bar || test_side)? '' : '15px' }"></i>
                                    <p :style="{ visibility: (sid_bar || test_side)? '' : 'hidden' }">Region</p>
                                </NavLink>
                            </div>
                            <!-- add items -->
                            <div class="add_tikets_button" id="add_tikets_button" @click="openTickets"
                            :style="{ height: (sid_bar || test_side)? '' : '60px',width: (sid_bar || test_side)? '' : '60px' }" >
                                <i class="fa-solid fa-cart-plus"
                                :style="{ fontSize: (sid_bar || test_side)? '' : '30px'}" ></i>
                            </div>
                            <div class="add_tikets_frame" v-if="openTickets_frame" >
                                <div class="fram_tikets">
                                    <div class="header">
                                        <div class="logo"><i class="fa-solid fa-cart-plus"></i></div>
                                        <div class="exite" id="exit_popup" @click="openTickets"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                                    </div>
                                    <div class="body_fram">
                                        <form @submit.prevent="save_items" class="form1">
                                            <div class="items_shoser">
                                                <div class="header_items">
                                                    <label for="search">
                                                        search
                                                        <input type="search" class="search" id="search">
                                                    </label>
                                                    <div id="list-example" class="list-group">
                                                        <a v-for="(icon, index) in  $page.props.auth.icons" :key="index" class="list-group-item list-group-item-action" :href='"#"+index'>
                                                            <img :src="'/icon/items_icon/'+icon.title+'.png'">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example" tabindex="0">
                                                    <div v-for="(icon, index) in  $page.props.auth.icons" :key="index" class="items_group" :id=index>
                                                        <p class="cat_title">{{icon.title}}</p>
                                                        <div class="items">
                                                            <div v-for="(item, index1) in  icon.items" :key="index1" class="item" :id=item>
                                                                <label :for="item+'.png'">
                                                                    <img id="item_path" :src="'/icon/items_icon/'+icon.title+'/'+item+'.png'">
                                                                    {{ item }}
                                                                </label>
                                                                <input 
                                                                    :id="item+'.png'" 
                                                                    class="item_chek" 
                                                                    type="radio" 
                                                                    :value="index1" 
                                                                    :name='"items"'
                                                                    v-model="ticket_form.item_name"
                                                                    :error="ticket_form.errors.item_name"
                                                                    :required="isRequired(item)"
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="region_carrency">
                                                <div class="region">
                                                    <i class="fa-solid fa-globe"></i>
                                                    <select 
                                                        name="select state" 
                                                        id="state" 
                                                        class="region_select" 
                                                        required
                                                        @click="regionshoser"
                                                        v-model="ticket_form.selectedOption"
                                                        :error="ticket_form.errors.selectedOption"
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
                                                    <select
                                                        name="slect accreditation" 
                                                        id=" accreditation" 
                                                        class="region_select" 
                                                        required
                                                        v-model="ticket_form.state"
                                                        :error="ticket_form.errors.state">
                                                        <option 
                                                            v-for="(state, index1) in region_selectetd" 
                                                            :key="index1" 
                                                            :id="index1"
                                                            :value= index1
                                                            >
                                                                {{state}} 
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="carrency">
                                                    <i class="fa-solid fa-coins"></i>
                                                    <select 
                                                        name="select carrency" 
                                                        id="state" 
                                                        class="carrency_select" 
                                                        required
                                                        v-model="ticket_form.carrency"
                                                        :error="ticket_form.errors.carrency"
                                                        >
                                                        <option 
                                                            v-for="carrency in $page.props.auth.carrency" 
                                                            :key="carrency.id_carrency" 
                                                            class="list-group-item list-group-item-action" 
                                                            :value= carrency.id_carrency>
                                                                {{ carrency.currency }}
                                                        </option>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="item_info" id="test">
                                                <input 
                                                    type="text" 
                                                    id="price" 
                                                    placeholder="price of one piece"
                                                    v-model="ticket_form.price"
                                                    :error="ticket_form.errors.price"
                                                    required
                                                >
                                                <input
                                                    type="number" 
                                                    id="quentity" 
                                                    placeholder="quentity"
                                                    v-model="ticket_form.quentity"
                                                    :error="ticket_form.errors.quentity"
                                                    required
                                                >
                                            </div>
                                            <div class="save">
                                                <button type="submit" class="tiket_save" :class="{ 'opacity-25': ticket_form.processing }" :disabled="ticket_form.processing">
                                                    save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>
<!-- ////////////////////////////////////main_content//////////////////////// -->
            <div class="main_content" :style="{ width: (sid_bar || test_side )? '' : 'calc(100% - 80px)' }">
                <!-- header -->
                <header class="bg-white shadow header" v-if="$slots.header">
                    <!-- **************name_page*************** -->
                    <div class="mx-auto  title_session">
                        <i class="fa-solid fa-bars" id="sid_show1" @click="min_sid_bar"
                            :style="{transform: (sid_bar || test_side)? '' : 'rotateZ(90deg)' }">
                        </i>
                        <i class="fa-solid fa-bars" id="sid_show2" @click="min_sid_bar_second"
                            :style="{transform: (sid_bar || test_side)? '' : 'rotateZ(90deg)' }">
                        </i>
                        <slot name="header" />
                    </div>
                    <!-- **************profile*************** -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- currency -->
                        <div class="currency">
                            <p>{{ $page.props.auth.user.main_currency }}</p>
                            <div class="logo">
                                <img :src="'/icon/currency/'+$page.props.auth.user.main_currency+'.png'">
                            </div>
                        </div>
                                <!-- Settings Dropdown -->
                                <div class="ml-3 relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                                >
                                                    {{ $page.props.auth.user.name }}

                                                    <svg
                                                        class="ml-2 -mr-0.5 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                            <DropdownLink :href="route('logout')" method="post" as="button">
                                                Log Out
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main>
                    <!-- ************************ thems congig *********************** -->
                    <div class="theme_edite_button" @click="openEdite">
                        <i class="fa-solid fa-gear" style="color: #ffffff;"></i>
                    </div>
                    <div class="theme_edite_frame" v-if="openEdite_frame">
                        <div class="sid_img">
                            <p>images</p>
                            <div class="img_list list">
                                <Link class="img_option" id="sid_img_1" :href="`/profile/${$page.props.auth.user.id}/${img1}/sid_img`" tabindex="-1"></Link>  
                                <Link class="img_option" id="sid_img_2" :href="`/profile/${$page.props.auth.user.id}/${img2}/sid_img`" tabindex="-1"></Link>  
                                <Link class="img_option" id="sid_img_3" :href="`/profile/${$page.props.auth.user.id}/${img3}/sid_img`" tabindex="-1"></Link>  
                                <Link class="img_option" id="sid_img_4" :href="`/profile/${$page.props.auth.user.id}/${img4}/sid_img`" tabindex="-1"></Link>  
                                <Link class="img_option" id="sid_img_5" :href="`/profile/${$page.props.auth.user.id}/${img5}/sid_img`" tabindex="-1"></Link>  
                                <Link class="img_option" id="sid_img_6" :href="`/profile/${$page.props.auth.user.id}/${img6}/sid_img`" tabindex="-1"></Link>  
                                <Link class="img_option" id="sid_img_7" :href="`/profile/${$page.props.auth.user.id}/${img7}/sid_img`" tabindex="-1"></Link>  
                                <Link class="img_option" id="sid_img_8" :href="`/profile/${$page.props.auth.user.id}/${img8}/sid_img`" tabindex="-1"></Link>  
                                <Link class="img_option" id="sid_img_9" :href="`/profile/${$page.props.auth.user.id}/${img9}/sid_img`" tabindex="-1"></Link>   

                            </div>
                        </div>
                        <div class="filters">
                            <p>filters</p>
                            <div class="filter_list list">

                                <Link class="filter_option" id="sid_filter_1" :href="`/profile/${$page.props.auth.user.id}/${color1}/theme`" tabindex="-1"></Link> 
                                <Link class="filter_option" id="sid_filter_2" :href="`/profile/${$page.props.auth.user.id}/${color2}/theme`" tabindex="-1"></Link> 
                                <Link class="filter_option" id="sid_filter_3" :href="`/profile/${$page.props.auth.user.id}/${color3}/theme`" tabindex="-1"></Link> 
                                <Link class="filter_option" id="sid_filter_4" :href="`/profile/${$page.props.auth.user.id}/${color4}/theme`" tabindex="-1"></Link> 
                                <Link class="filter_option" id="sid_filter_5" :href="`/profile/${$page.props.auth.user.id}/${color5}/theme`" tabindex="-1"></Link> 
                                <Link class="filter_option" id="sid_filter_6" :href="`/profile/${$page.props.auth.user.id}/${color6}/theme`" tabindex="-1"></Link> 
                                <Link class="filter_option" id="sid_filter_7" :href="`/profile/${$page.props.auth.user.id}/${color7}/theme`" tabindex="-1"></Link>  

                            </div>
                        </div>
                    </div>
                    <FlashMessages />
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import FlashMessages from "@/Components/FlashMessages.vue";

const showingNavigationDropdown = ref(false);
</script>
<script>
import axios from 'axios';
export default {
    components: {
        Link,
        FlashMessages,
    },
    props: {
        Ticket: Object,
    },
    data() {
        return {
            sid_bar : true,
            test_side: false,
            openEdite_frame : false,
            sid_bar_second: false,
            openTickets_frame : false,
            img1: 'img_1.jpg',
            img2: 'img_2.jpg',
            img3: 'img_3.jpg',
            img4: 'img_4.jpg',
            img5: 'img_5.jpg',
            img6: 'img_6.jpg',
            img7: 'img_7.jpg',
            img8: 'img_8.jpg',
            img9: 'img_9.png',
            color1: 'ffc502',
            color2: 'ff5602',
            color3: '8b1bd2',
            color4: '02bf09',
            color5: '02ff1b',
            color6: '02e1ff',
            color7: '020aff',
            region_selectetd: '',

            ticket_form: this.$inertia.form({
                selectedOption: null,
                state: null,
                carrency: null,
                price: null,
                quentity: null,
                item_name: null,
            }),
        }
    },
    methods: {
        isRequired(optionValue) {
            return this.requiredValue === optionValue;
        },
        regionshoser(){
            switch (this.ticket_form.selectedOption) {
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
        openEdite() {
            this.openEdite_frame ? 
                this.openEdite_frame=false : 
                this.openEdite_frame=true;
        },
        min_sid_bar(){
            if(this.sid_bar){
                this.sid_bar=false 
                this.test_side=false;
            }
            else{
                this.sid_bar=true 
                this.test_side=true;
            }
        },
        min_sid_bar_second(){
            if(this.sid_bar_second){
                this.sid_bar_second=false;
                this.sid_bar = true;
                this.test_side = false;
            }
            else{
                this.sid_bar_second=true;
                this.sid_bar = true;
                this.test_side = false;
            }
        },
        hover_side_bar(){
            this.sid_bar ? 
                this.test_side=true : 
                this.test_side=true;
        },
        out_side_bar(){
            this.sid_bar ? 
                this.test_side=true : 
                this.test_side=false;
        },
        openTickets() {
            this.openTickets_frame?
                this.openTickets_frame=false:
                this.openTickets_frame=true;
        },
        updateRootCSSVariable(color) {
            document.documentElement.style.setProperty('--action_color', this.$page.props.auth.user.filter);
        },

        //*********************add items */
        save_items() {
            this.ticket_form.post(`/Items/${this.$page.props.auth.user.id}`);
        },
    },
    mounted() {
        const color = this.color;
        this.updateRootCSSVariable(color);
    },
}
</script>
