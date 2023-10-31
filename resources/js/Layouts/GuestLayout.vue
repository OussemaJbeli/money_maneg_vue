<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 bg_login">
        <img src="/icon/login/cycle_bear.gif" alt="" class="animated_bear">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md sm:rounded-lg form_login">
            <slot />
        </div>
    </div>
</template>
