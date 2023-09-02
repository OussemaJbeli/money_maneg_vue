<template>
    <div>
        <div class="min-h-screen bg-gray-100 main_frame">
<!-- ////////////////////////////////////nave barre//////////////////////// -->
            <nav class="bg-white border-b border-gray-100 side_barre">
                <div class="back_block_transparent"></div>
                <div class="side_color_picture" id="side_color_picture">
                    <img :src=" $page.props.auth.user.sid_img ">
                </div>
                    <div class="flex justify-between h-16 nave_liste">
                        <!-- **************nave option*************** -->
                        <div class="flex nave_options">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center Logo_user">
                                <Link :href="route('profile.edit')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800 Logo_user_under"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex options_nave">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="NavLink">
                                    <i class="fa-solid fa-chart-line"></i>
                                    Dashboard
                                </NavLink>
                                <NavLink :href="route('Tickets')" :active="route().current('Tickets')" class="NavLink">
                                    <i class="fa-solid fa-ticket"></i>
                                    Tickets
                                </NavLink>
                                <NavLink :href="route('Items')" :active="route().current('Items')" class="NavLink">
                                    <i class="fa-solid fa-sitemap"></i>
                                    Items
                                </NavLink>
                                <NavLink :href="route('Carrency')" :active="route().current('Carrency')" class="NavLink">
                                    <i class="fa-solid fa-coins"></i>
                                    Carrency
                                </NavLink>
                                <NavLink :href="route('Region')" :active="route().current('Region')" class="NavLink">
                                    <i class="fa-solid fa-globe"></i>
                                    Region {{ test }}
                                </NavLink>
                            </div>
                            <!-- add items -->
                            <div class="add_tikets_button" @click="openTickets" >
                                <i class="fa-solid fa-cart-plus"></i>
                            </div>
                            <div class="add_tikets_frame" v-if="openTickets_frame" >
                                <div class="fram_tikets">
                                    <div class="header">
                                        <div class="logo"><i class="fa-solid fa-cart-plus"></i></div>
                                        <div class="exite" id="exit_popup" @click="openTickets"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                                    </div>
                                    <div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
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
            <div class="main_content">
                <!-- header -->
                <header class="bg-white shadow header" v-if="$slots.header">
                    <!-- **************name_page*************** -->
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 title_session">
                        <slot name="header" />
                    </div>
                    <!-- **************profile*************** -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
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
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>
<script>

export default {
    components: {
        Link,
    },
    data() {
        return {
            openEdite_frame : false,
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
        }
    },
    methods: {
        openEdite() {
            this.openEdite_frame ? 
                this.openEdite_frame=false : 
                this.openEdite_frame=true;
        },
        openTickets() {
            this.openTickets_frame ? 
                this.openTickets_frame=false : 
                this.openTickets_frame=true;
        },
        updateRootCSSVariable(color) {
            document.documentElement.style.setProperty('--action_color', this.$page.props.auth.user.filter);
        },
    },
    mounted() {
        const color = this.color;
        this.updateRootCSSVariable(color);
    },
}
</script>
