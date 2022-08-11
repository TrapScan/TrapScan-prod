<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Reset Password" />


        <div class="p-3">
            <div class="mt-2 w-11/12 mx-auto ">
                <form @submit.prevent="submit">
                    <div class="flex flex-col mb-5">
                        <BreezeValidationErrors class="mb-4" />
                    </div>
                    <label class="block ubuntu text-2xs text-dark font-bold mb-2" for="grid-password">Your email address</label>
                    <div class="relative flex w-full flex-wrap items-stretch mb-3">
                              <span class="z-10 h-full leading-snug font-normal absolute text-center text-slate-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                              <i class="fas fa-envelope text-gray-500"></i>
                              </span>
                        <input placeholder="Email" v-model="form.email" required autofocus autocomplete="username" type="text" class="px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10"/>
                    </div>
                    <label class="block ubuntu text-2xs text-dark font-bold mb-2" for="grid-password">Password</label>
                    <div class="relative flex w-full flex-wrap items-stretch mb-3">
                              <span class="z-10 h-full leading-snug font-normal absolute text-center text-slate-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                              <i class="fas fa-lock text-gray-500"></i>
                              </span>
                        <input placeholder="Password" v-model="form.password" required autofocus autocomplete="password" type="password" class="px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10"/>
                    </div>
                    <label class="block ubuntu text-2xs text-dark font-bold mb-2" for="grid-password">Confirm Password</label>
                    <div class="relative flex w-full flex-wrap items-stretch mb-3">
                              <span class="z-10 h-full leading-snug font-normal absolute text-center text-slate-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                              <i class="fas fa-lock text-gray-500"></i>
                              </span>
                        <input placeholder="Confirm Password" v-model="form.password_confirmation" required autofocus autocomplete="password" type="password" class="px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10"/>
                    </div>
                    <div class="flex">
                        <div class="flex w-full mx-auto">
                            <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="flex mt-2 items-center font-bold justify-center focus:outline-none text-white text-sm sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-3 w-full transition duration-150 ease-in">
                                <span class="mr-2 uppercase">Reset Password</span>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </BreezeGuestLayout>
</template>
