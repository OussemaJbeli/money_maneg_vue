<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Reset Data</h2>

            <p class="mt-1 text-sm text-gray-600">
            Reset your account's data.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">Reset data</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <form @submit.prevent="ResetData" class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    select the data you went to reset?
                </h2>
                <div class="mt-6 check_reset">
                    <div class="mt-6 check_reset_radio">
                        <label for="all">
                            <input 
                                type="checkbox"
                                v-model="form.all"
                                :error="form.errors.all"
                                id="all"
                                @change="selectAll"
                            >
                            all
                        </label>
                        <label for="custom">
                            <input 
                                type="checkbox"
                                v-model="form.custom"
                                :error="form.errors.custom"
                                id="custom"
                                @change="selectCUSTOM"
                            >
                            custom
                        </label>
                    </div>
                    <p>list configuration</p>
                    <div class="mt-6 check_reset_list">
                        <label for="avatar">
                            <input 
                                type="checkbox"
                                v-model="form.avatar"
                                :error="form.errors.avatar"
                                id="avatar"
                                @change="selectCUSTOM"
                            >
                            Avatar
                        </label>
                        <label for="theme">
                            <input 
                                type="checkbox"
                                v-model="form.theme"
                                :error="form.errors.theme"
                                id="theme"
                                @change="selectCUSTOM"
                            >
                            sid picture
                        </label>
                        <label for="action_color">
                            <input 
                                type="checkbox"
                                v-model="form.action_color"
                                :error="form.errors.action_color"
                                id="action_color"
                                @change="selectCUSTOM"
                            >
                            action color
                        </label>
                    </div>
                    <p>list data</p>
                    <div class="mt-6 check_reset_list">
                        <label for="Tickets_and_Items">
                            <input 
                                type="checkbox"
                                v-model="form.Tickets_and_Items"
                                :error="form.errors.Tickets_and_Items"
                                id="Tickets_and_Items"
                                @change="selectCUSTOM"
                            >
                            Tickets & items
                        </label>
                        <label for="currency">
                            <input 
                                type="checkbox"
                                v-model="form.currency"
                                :error="form.errors.currency"
                                id="currency"
                                @change="selectCUSTOM"
                            >
                            Currency
                        </label>
                        <label for="target_plan">
                            <input 
                                type="checkbox"
                                v-model="form.target_plan"
                                :error="form.errors.target_plan"
                                id="target_plan"
                                @change="selectCUSTOM"
                            >
                            Target plan
                        </label>
                    </div>
                </div>
                <div class="mt-6">
                    <InputLabel for="password" value="Password" class="sr-only" />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password_test"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
                        @keyup.enter="ResetData"
                        required
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Reste Data
                    </DangerButton>
                </div>
            </form>
        </Modal>
    </section>
</template>
<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};


const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>
<script>
export default {
    data() {
        return {
            form: this.$inertia.form({
                all: true,
                custom: false,
                password_test: "",
                Tickets_and_Items: true,
                theme: true,
                action_color: true,
                avatar: true,
                currency: true,
                target_plan: true,
            }),
        }
    },
    methods: {
        selectAll(){
            this.form.Tickets_and_Items = true;
            this.form.theme = true;
            this.form.action_color = true;
            this.form.avatar = true;
            this.form.currency = true;
            this.form.target_plan = true;
            this.form.custom = false;
        },
        selectCUSTOM(){
            this.form.custom = true;
            this.form.all = false;
        },
        ResetData() {
            this.form.get(`/profile/Reset_Data`, {
                preserveScroll: true,
                onSuccess: () => {
                this.form.reset();
                },
            });
        },
    }
}
</script>