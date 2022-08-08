<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import Show from "@/Layouts/Show.vue";
import {ref} from "vue";

</script>

<template>
    <Show>
        <template #header>
            <div>

            </div>
            <div>
                <Link :href="route('anon_form')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 dark:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </Link>
            </div>
        </template>
        <div class="py-8 flex justify-center w-full bg-caribbean-green">
            <svg class="stroke-caribbean-green" width="96" height="96" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect y="64" width="11.5194" height="44.4319" transform="rotate(-45 0 64)" fill="#0AB587"/>
                <rect x="87.2725" y="23.2727" width="11.5194" height="90.5094" transform="rotate(45 87.2725 23.2727)" fill="#0AB587"/>
            </svg>
        </div>
        <div class="flex justify-center flex-col w-full mt-2 p-4">
            <h1 class="text-3xl font-bold text-black dark:text-white montserrat text-center">Thanks for letting us know</h1>
            <div class="w-full bg-white dark:bg-mirage-400 rounded-xl dark:text-white p-6 flex flex-col mt-6">
                <div class="flex flex-wrap justify-start w-full">
                    <h1 class="montserrat font-black dark:text-white text-xl font-bold">Want to get more involved in trapping?</h1>
                    <p class="text-gray-500 mt-3 montserrat dark:text-white ">
                        Joining TrapScan only takes a few seconds, allows you to get up and running quickly, and it’s free.
                    </p>
                    <Link :href="route('login')" class="flex w-full mx-auto mt-4">
                        <button class="flex mt-4 items-center justify-center focus:outline-none text-white text-lg bg-niagara-500 hover:bbg-niagara-600 rounded-full py-4 w-full transition duration-150 ease-in">
                            <span class="uppercase montserrat font-bold ">join trapscan</span>
                        </button>
                    </Link>
                </div>
            </div>
        </div>
        <div class="flex mt-4 justify-center flex-wrap p-4">
            <Link class="flex mt-2 items-center font-bold justify-center focus:outline-none text-white text-lg sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-4 w-full transition duration-150 ease-in" :href="route('index')">
                <span class="uppercase">finish</span>
            </Link>
        </div>
    </Show>
</template>
