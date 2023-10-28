<template>
    <div>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
        </svg>
        <div v-if="successMessage " class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
                {{ successMessage }}
            </div>
        </div>
        <div class="min-h-screen bg-gray-100 main_frame">
<!-- ////////////////////////////////////nave barre//////////////////////// -->
            <!-- company nave -->
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
                            <div class="add_tikets_button" id="add_tikets_button" @click="open_company_mode"
                                :style="{ height: (sid_bar || test_side)? '' : '60px',width: (sid_bar || test_side)? '' : '60px' }" >
                                <i class="fa-solid fa-cart-plus"
                                :style="{ fontSize: (sid_bar || test_side)? '' : '30px'}" ></i>
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
                    <div class="side_but_secsion hidden sm:flex sm:items-center sm:ml-6">
                        <button class="company_buttons" @click="company_add_form_open_fun()">create</button>
                        <button class="company_buttons" @click="company_invit_form_open_fun()">join</button>
                        <!-- company -->
                        <div id='company_secsion'>
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                                >
                                                    company
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
                                        <template #content class="frame_company">
                                            <div class="list_company">
                                                <DropdownLink class="company_name  flex items-center flex-row" v-for="(list_company,index) in $page.props.auth.user_company[0]" :key="index" :href="route('logout')" method="post" as="button">
                                                    <div class="bg-orange-600 w-6 h-6 mr-1 text-white text-lg flex justify-center items-center">
                                                        {{ list_company.avatar }}
                                                    </div>
                                                    <p class="w-32">{{ list_company.name }}</p>
                                                </DropdownLink>
                                                <p v-if="$page.props.auth.user_company[0].length === 0" class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">create or join a company</p>
                                            </div>
                                        </template>
                                    </Dropdown>
                        </div>
                        <!-- profile -->
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
                        <!-- currency -->
                        <div class="currency">
                            <p>{{ $page.props.auth.user.main_currency }}</p>
                            <div class="logo">
                                <img :src="'/icon/currency/'+$page.props.auth.user.main_currency+'.png'">
                            </div>
                        </div>
                    </div>
                </header>
                <!-- company add and create popups -->
                <!-- add -->
                <div class="add_company_fram" v-if="company_add_form_open">
                    <div class="limit_panel">
                        <div class="header">
                            <div class="logo"><i class="fa-solid fa-cart-plus"></i></div>
                            <div class="exite" id="exit_popup" @click="company_add_form_open_fun"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                        </div>
                        <form @submit.prevent="add_company_root" class="body_fram">
                            <div class="limit_type">
                                <label for="">
                                    Company Name
                                    <input name="Company_Name"  type="text"
                                    v-model="company_add_form.Company_Name"
                                    :error="company_add_form.errors.Company_Name"
                                    required>
                                </label>
                                <label for="">
                                    Type of Company
                                    <select name="Company_type" id=""
                                        placeholder="name"
                                        v-model="company_add_form.Company_type"
                                        :error="company_add_form.errors.Company_type">
                                        <option :value="type_company"  v-for="(type_company,index) in types_company" :key="index">{{type_company}}</option>
                                    </select>
                                </label>
                                <label for="">
                                    discription
                                    <textarea name="copmany_discription" id=""
                                        required
                                        v-model="company_add_form.copmany_discription"
                                        :error="company_add_form.errors.copmany_discription">
                                    </textarea>
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
                <!-- invite -->
                <div class="invit_company_fram" v-if="company_invit_form_open">
                    <div class="limit_panel">
                        <div class="header">
                            <div class="logo"><i class="fa-solid fa-cart-plus"></i></div>
                            <div class="exite" id="exit_popup" @click="company_invit_form_open_fun"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                        </div>
                        <form @submit.prevent="invit_company_root" class="body_fram">
                            <div class="limit_type">
                                <label for="">
                                    Invitation Code
                                    <input name="Company_Name"  type="text"
                                    v-model="company_invit_form.invitation_code"
                                    :error="company_invit_form.errors.invitation_code"
                                    required>
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
            img9: 'img_9.jpg',
            color1: 'ffc502',
            color2: 'ff5602',
            color3: '8b1bd2',
            color4: '02bf09',
            color5: '02ff1b',
            color6: '02e1ff',
            color7: '020aff',
            region_selectetd: '',

            //company part
            types_company: [
                'Companies Limited by Shares',
                'Companies Limited by Guarantee',
                'Unlimited Companies',
                'One Person Companies (OPC)',
                'Private Companies',
                'Public Companies',
                'Holding and Subsidiary Companies',
                'Associate Companies',
                'Companies in terms of Access to Capital',
                'Government Companies',
                'Foreign Companies',
                'Charitable Companies',
                'Dormant Companies',
                'Nidhi Companies',
                'Public Financial Institutions',
                'Other...',
            ],
            company_add_form_open: false,
            company_add_form: this.$inertia.form({
                copmany_discription: null,
                Company_type: null,
                Company_Name: null,
            }),
            company_invit_form_open: false,
            company_invit_form: this.$inertia.form({
                invitation_code: null,
            }),
            //open company mode
            company_mode: false,
        }
    },
    methods: {
        isRequired(optionValue) {
            return this.requiredValue === optionValue;
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
        updateRootCSSVariable(color) {
            document.documentElement.style.setProperty('--action_color', this.$page.props.auth.user.filter);
        },

        // company
        company_invit_form_open_fun() {
            this.company_invit_form_open ? 
                this.company_invit_form_open=false : 
                this.company_invit_form_open=true;
        },
        company_add_form_open_fun() {
            this.company_add_form_open ? 
                this.company_add_form_open=false : 
                this.company_add_form_open=true;
        },
        add_company_root() {
            this.company_add_form.post(`/Company/Create`, {
                preserveScroll: true,
                onSuccess: () => {
                this.company_add_form_open = false;
                this.company_add_form.reset();
                },
            });
        },
        invit_company_root() {
            this.company_invit_form.post(`/Memeber/Create`, {
                preserveScroll: true,
                onSuccess: () => {
                this.company_invit_form_open = false;
                this.company_invit_form.reset();
                },
            });
        },
        //open company mode
        open_company_mode() {
            this.company_mode ? 
                this.company_mode=false : 
                this.company_mode=true;
        },
    },
    mounted() {
        const color = this.color;
        this.updateRootCSSVariable(color);
    },
    computed: {
      filteredItems() {
        const query = this.searchQuery.toLowerCase();
        return this.$page.props.auth.Allicons.filter(item => item.items.toLowerCase().includes(query));
      }
    }
}
</script>
