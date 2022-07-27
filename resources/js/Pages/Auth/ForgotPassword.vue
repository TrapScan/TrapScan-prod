<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';

import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <BreezeGuestLayout>


        <div class="p-3">
            <div class="w-full overflow-hidden">
                <div class="mb-5">
                    <p class="text-dark montserrat text-2xl font-bold flex items-center">
                        <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                            <svg class="h-6 w-6 rotate-180 mr-2 " fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" >
                                <path  d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </Link>
                        Reset password
                    </p>
                </div>
            </div>

            <div class="mt-2 w-11/12 mx-auto ">
                <form @submit.prevent="submit">
                    <div class="flex flex-col mb-5">
                        <BreezeValidationErrors class="mb-4" />
                        <div v-if="status" class="mb-4 font-medium text-sm text-dark">
                            {{ status }}
                        </div>
                    </div>
                    <label class="block ubuntu text-2xs text-dark font-bold mb-2" for="grid-password">Your email address</label>
                    <div class="relative flex w-full flex-wrap items-stretch mb-3">
                              <span class="z-10 h-full leading-snug font-normal absolute text-center text-slate-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                              <i class="fas fa-envelope text-gray-500"></i>
                              </span>
                        <input placeholder="Email" v-model="form.email" required autofocus autocomplete="username" type="text" class="px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10"/>
                    </div>
                    <div class="flex">
                        <div class="flex w-full mx-auto">
                            <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="flex mt-2 items-center font-bold justify-center focus:outline-none text-white text-sm sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-2xl py-3 w-full transition duration-150 ease-in">
                                <span class="mr-2 uppercase">SEND reset LINK</span>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </BreezeGuestLayout>
</template>
