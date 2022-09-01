<script setup>
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import Primary from "@/UI/Buttons/Primary.vue";

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>

    <div class="min-h-screen h-full bg-mystic-500 dark:bg-mirage-500">
        <nav class="bg-niagara-500 min-h-[64px] h-auto shadow-2xl">
            <!-- Primary Navigation Menu -->
            <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 py-5">
                    <Link :href="route('login')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white dark:text-gray-900 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </Link>
                    <div>
                        <h1 class="text-xl w-full text-white font-bold montserrat dark:text-gray-900 ">Register</h1>
                    </div>
                    <div>
                        <Link :href="route('login')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white dark:text-gray-900 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </Link>
                    </div>
                </div>
            </div>

        </nav>
        <!-- Page Content -->
        <main class="container mx-auto h-full max-w-lg mb-auto overflow-auto">
            <div class="mt-2 w-11/12 mx-auto ">
                <form @submit.prevent="submit">
                    <div class="flex flex-col mb-5">
                        <BreezeValidationErrors class="mb-4" />
                    </div>
                    <label class="block font-fira text-2xs text-dark dark:text-gray-300 mb-2" for="grid-password">Name</label>
                    <div class="relative flex w-full flex-wrap items-stretch mb-3">
                              <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-500 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                              <svg  width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" ><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
                              </span>
                        <input placeholder="Email" v-model="form.name" required autofocus autocomplete="username" type="text" class="px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10"/>
                    </div>
                    <label class="block font-fira text-2xs text-dark dark:text-gray-300 mb-2" for="grid-password">Your email</label>
                    <div class="relative flex w-full flex-wrap items-stretch mb-3">
                              <span class="z-10 h-full leading-snug font-normal absolute text-center text-slate-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                              <i class="fas fa-envelope text-gray-500"></i>
                              </span>
                        <input placeholder="Email" v-model="form.email" required autofocus autocomplete="username" type="text" class="px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10"/>
                    </div>
                    <div class="flex justify-between mt-5">
                        <label class="block font-fira text-2xs text-dark dark:text-gray-300 mb-2" for="grid-password">Password</label>
                    </div>
                    <div class="relative flex w-full flex-wrap items-stretch mb-3">
                              <span class="z-10 h-full leading-snug font-normal absolute text-center text-slate-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                              <i class="fas fa-lock text-gray-500"></i>
                              </span>
                        <input  v-model="form.password" required autocomplete="current-password" type="password" class="px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10"/>
                    </div>
                    <div class="flex justify-between mt-5">
                        <label class="block font-fira text-2xs text-dark dark:text-gray-300 mb-2" for="grid-password">Confirm Password</label>
                    </div>
                    <div class="relative flex w-full flex-wrap items-stretch mb-3">
                              <span class="z-10 h-full leading-snug font-normal absolute text-center text-slate-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                              <i class="fas fa-lock text-gray-500"></i>
                              </span>
                        <input  v-model="form.password_confirmation" required autocomplete="current-password" type="password" class="px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10"/>
                    </div>
                    <div class="flex">
                        <div class="flex w-full mx-auto">
                            <primary :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                <span class="mr-2 uppercase">Register</span>
                            </primary>
                        </div>
                    </div>
                </form>
            </div>
        </main>

    </div>

</template>
