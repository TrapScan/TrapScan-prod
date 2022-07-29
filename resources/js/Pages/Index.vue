<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

</script>

<template>
    <BreezeGuestLayout>
            <div class="flex flex-wrap overflow-hidden px-4">
                <div class="w-full overflow-hidden">
                    <div class="mb-10 ">
                        <h1 class="font-black dark:text-white text-3xl montserrat font-bold">Welcome 👋</h1>
                        <p class="text-gray-500 mt-3 montserrat dark:text-white ">
                            TrapScan is a modern web app designed by conservation volunteers to simplify their data recording, reporting, and administrative tasks.
                        </p>
                        <div class="w-full bg-white dark:bg-mirage-400 rounded-xl dark:text-white p-6 flex flex-col mt-6">
                            <div class="flex flex-wrap justify-start w-full">
                                <h1 class="montserrat font-black dark:text-white text-xl font-bold">Did this trap catch something?</h1>
                                <p class="text-gray-500 mt-3 montserrat dark:text-white ">
                                    Let us know what it caught so that trappers in the area can get onto it!
                                </p>
                                <Link :href="route('anon_form')" class="flex w-full mx-auto mt-4">
                                    <button class="flex mt-4 items-center justify-center focus:outline-none text-white text-lg bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-4 w-full transition duration-150 ease-in">
                                        <span class="uppercase montserrat font-bold ">report a catch</span>
                                    </button>
                                </Link>
                            </div>

                        </div>
                        <div class="w-full bg-white dark:bg-mirage-400 rounded-xl dark:text-white p-6 flex flex-col mt-6 mb-20">
                            <div class="flex flex-wrap justify-start w-full mb-3">
                                <h1 class="montserrat font-black dark:text-white text-xl font-bold">Want to get more involved in trapping?</h1>
                                <p class="text-gray-500 mt-3 montserrat dark:text-white ">
                                    Joining TrapScan only takes a few seconds, allows you to get up and running quickly, and it’s free.
                                </p>
                                <div class="flex w-full mx-auto mt-4">
                                    <Link :href="route('login')" class="flex mt-4 items-center justify-center focus:outline-none text-white text-lg bg-niagara-500 hover:bg-niagara-600 rounded-full py-4 w-full transition duration-150 ease-in">
                                        <span class="uppercase montserrat font-bold ">join trapscan</span>
                                    </Link>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

    </BreezeGuestLayout>
</template>
