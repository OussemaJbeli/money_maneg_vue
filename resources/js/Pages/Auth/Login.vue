<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: 'admin@gmail.com',
    password: '123456789',
    remember: false,
});

const submit = () => {
    form.post(route('login.store'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
<script>
export default {
    data() {
        return {
            eye_state: 'fa-solid fa-eye-slash',
            input_type: 'password',
        }
    },
    methods:{
        password_visibility(){
            if(this.input_type == 'password'){
                this.input_type = 'text';
                this.eye_state = 'fa-solid fa-eye';
            }
            else{
                this.input_type = 'password';
                this.eye_state = 'fa-solid fa-eye-slash';
            }
        }
    }
}

</script>


<!-- ////////////////// temlate///////////// -->
<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <p class="title"> Login </p>
            <div class="inputs">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full input"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4 inputs">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    :type=input_type
                    class="mt-1 block w-full input"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />
                <i :class=eye_state class="eye_pass" @click="password_visibility"></i>
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4 forget_pass">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-semibold"
                >
                    Forgot your password?
                </Link>
            </div>
            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
            </PrimaryButton>
            <div class="flex items-center justify-end mt-4 register">
                <!-- create new -->
                <p>Don't Have Account 
                    <span>                
                        <Link
                            v-if="canResetPassword"
                            :href="route('register')"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-semibold"
                        >
                            register
                        </Link>
                    </span>
                </p>
            </div>
        </form>
    </GuestLayout>
</template>
