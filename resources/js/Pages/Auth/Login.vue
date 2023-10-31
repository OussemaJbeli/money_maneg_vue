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
            conditionMouth: 0,
            conditionHandright: 0,
            conditionHandleft: 0,
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
        },
        mouthaction(mouth,hand){
            this.conditionMouth = mouth;
            this.conditionHandright = hand;
            this.conditionHandleft = hand;
        },
    },
    computed: {
        mouthState() {
            if (this.conditionMouth == 0) {
                return {
                    Animation: 'mouse_login_sort .5s ease forwards',
                };
            } else if (this.conditionMouth == 1) {
                return {
                    Animation: 'mouse_login_enter .5s ease forwards',
                };
            } else {
                return {
                    Animation: 'mouse_user_enter .5s ease forwards',
                };
            }
        },
        righthandState() {
            if (this.conditionHandright == 0) {
                return {
                    Animation: 'hand_down_right 1.5s ease forwards',
                };
            } else{
                return {
                    Animation: 'hand_up_right .5s ease forwards',
                };
            }
        },
        lefthandState() {
            if (this.conditionHandleft == 0) {
                return {
                    Animation: 'hand_down_left 1.5s ease forwards',
                };
            } else{
                return {
                    Animation: 'hand_up_left .5s ease forwards',
                };
            }
        }
    },
    mounted() {
        const eye1_red = this.$refs.eye_left;
        const container1 = this.$refs.left_pupil;
        const eye2_red = this.$refs.eye_right;
        const container2 = this.$refs.right_pupil;
        const containerRect1 = container1.getBoundingClientRect();
        const containerRect2 = container2.getBoundingClientRect();
        const centerX = containerRect1.left + containerRect1.width / 2;
        const centerY = containerRect2.top + containerRect2.height / 2;

        document.addEventListener('mousemove', (e) => {
        const x = e.clientX;
        const y = e.clientY;
        const dx = x - centerX;
        const dy = y - centerY;
        const angle = Math.atan2(dy, dx) * (180 / Math.PI); // Convert radians to degrees
        eye1_red.style.transform = `rotate(${angle}deg)`;
        eye2_red.style.transform = `rotate(${angle}deg)`;
        });
    },
}

</script>


<!-- ////////////////// temlate///////////// -->
<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" @mouseenter="mouthaction(1,0)" @mouseleave="mouthaction(0,0)">
            <div class="bear_avatar">
                <div class="eye_frame">
                    <div class="eyes" id="eyes">
                        <div class="eye_left eye" id="eye_left" ref="eye_left">
                            <div class="pupil" id="left_pupil" ref="left_pupil"></div>
                        </div>
                        <div class="eye_right eye" id="eye_right" ref="eye_right">
                            <div class="pupil" id="right_pupil" ref="right_pupil"></div>
                        </div>
                        <div class="roumouch" id="roumouch"></div>
                    </div>
                </div>
                <div class="mouth_frame">
                    <div class="mouth" id="mouth" :style="mouthState"></div>
                </div>
                <div class="left_hand" id="left_hand" :style="lefthandState"></div>
                <div class="right_hand" id="right_hand" :style="righthandState"></div>
            </div>
            <p class="title"> Login </p>

            <div class="inputs" @mouseenter="mouthaction(2,0)" @mouseleave="mouthaction(1,0)">
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
            <div class="mt-4 inputs" @mouseenter="mouthaction(2,1)" @mouseleave="mouthaction(1,0)">
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
