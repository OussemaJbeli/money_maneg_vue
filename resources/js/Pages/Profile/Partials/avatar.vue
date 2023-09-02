<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});

</script>
<script>
export default {

    data() {
        return {
            ava1: 'avatar1.png',
            ava2: 'avatar2.png',
            ava3: 'avatar3.png',
            ava4: 'avatar4.png',
            ava5: 'avatar5.png',
            ava6: 'avatar6.png',
            ava7: 'avatar7.png',
            ava8: 'avatar8.png',
            ava9: 'avatar9.png',
            ava10: 'avatar10.png',
            ava11: 'avatar11.png',
            ava12: 'avatar12.png',
            ava13: 'avatar13.png',
            ava14: 'avatar14.png',
            ava15: 'avatar15.png',
        }
    }
}
</script>
<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile Avatar</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's pavatar.
            </p>
        </header>
        <div class="avatar_list">
            <Link class="avatar" id="img_avatar1" :href="`/profile/${$page.props.auth.user.id}/${ava1}/avatar`" tabindex="-1"></Link>  
            <Link class="avatar" id="img_avatar2" :href="`/profile/${$page.props.auth.user.id}/${ava2}/avatar`" tabindex="-1"></Link>  
            <Link class="avatar" id="img_avatar3" :href="`/profile/${$page.props.auth.user.id}/${ava3}/avatar`" tabindex="-1"></Link>  
            <Link class="avatar" id="img_avatar4" :href="`/profile/${$page.props.auth.user.id}/${ava4}/avatar`" tabindex="-1"></Link>  
            <Link class="avatar" id="img_avatar5" :href="`/profile/${$page.props.auth.user.id}/${ava5}/avatar`" tabindex="-1"></Link>  
            <Link class="avatar" id="img_avatar6" :href="`/profile/${$page.props.auth.user.id}/${ava6}/avatar`" tabindex="-1"></Link>  
            <Link class="avatar" id="img_avatar7" :href="`/profile/${$page.props.auth.user.id}/${ava7}/avatar`" tabindex="-1"></Link>  
            <Link class="avatar" id="img_avatar8" :href="`/profile/${$page.props.auth.user.id}/${ava8}/avatar`" tabindex="-1"></Link>  
            <Link class="avatar" id="img_avatar9" :href="`/profile/${$page.props.auth.user.id}/${ava9}/avatar`" tabindex="-1"></Link>  
            <Link class="avatar" id="img_avatar10" :href="`/profile/${$page.props.auth.user.id}/${ava10}/avatar`" tabindex="-1"></Link>  
            <Link class="avatar" id="img_avatar11" :href="`/profile/${$page.props.auth.user.id}/${ava11}/avatar`" tabindex="-1"></Link>  
            <Link class="avatar" id="img_avatar12" :href="`/profile/${$page.props.auth.user.id}/${ava12}/avatar`" tabindex="-1"></Link>  
            <Link class="avatar" id="img_avatar13" :href="`/profile/${$page.props.auth.user.id}/${ava13}/avatar`" tabindex="-1"></Link>  
            <Link class="avatar" id="img_avatar14" :href="`/profile/${$page.props.auth.user.id}/${ava14}/avatar`" tabindex="-1"></Link>  
            <Link class="avatar" id="img_avatar15" :href="`/profile/${$page.props.auth.user.id}/${ava15}/avatar`" tabindex="-1"></Link>   
        </div>
    </section>
</template>
