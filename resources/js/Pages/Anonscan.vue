<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';

const form = useForm({
    QR_ID:null,
    species_caught:null
})

const species = [
    'Rat', 'Mouse', 'Stoat', 'Weasel', 'Hedgehog','Rat - Kiore',
    'Rat - Norway', 'Unspecified', 'Bird', 'Rat - Ship', 'Cat',
    'Deer', 'Dog', 'Ferret', 'Goat', 'Hare', 'Magpie', 'Peafowl',
    'Pig', 'Possum', 'Rabbit', 'Turkey'
];
const submit = () => {
    form.post(route('anon_form.store'), {
        onFinish: () => {},
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <div class="flex flex-wrap overflow-hidden px-4">
            <div class="w-full overflow-hidden">
                <div class="mb-10 ">
                    <h1 class="font-black dark:text-white text-3xl montserrat font-bold">Hello 👋</h1>
                    <p class="text-gray-500 mt-3 montserrat dark:text-white ">
                        This is a mobile web application designed by conservation volunteers to simplify their record keeping and reporting work.
                    </p>
                    <div class="w-full bg-white dark:bg-mirage-400 rounded-xl dark:text-white p-6 flex flex-col mt-6">
                        <div v-if="$page.props.flash.message" class="alert w-full my-5">
                            <el-alert :title="$page.props.flash.message" type="warning" show-icon />
                        </div>
                        <BreezeValidationErrors class="mb-4" />

                        <form @submit.prevent="submit" class="flex flex-wrap justify-start w-full">
                            <div class="relative flex w-full flex-wrap items-stretch mb-3">
                                <label for="first_name" class="block mb-2 text-xl font-medium text-dark dark:text-gray-300">QR ID</label>
                                <input v-model="form.QR_ID" type="text" id="large-input" class="block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="relative flex w-full flex-wrap items-stretch mb-3">
                                <label for="large" class="block mb-2 text-xl font-medium text-gray-900 dark:text-gray-400">Species caught</label>
                                <select v-model="form.species_caught" id="large" class="block py-3 px-4 w-full text-base text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option v-for="st in species" :key="st" :value="st">{{st}}</option>
                                </select>
                            </div>
                            <div class="flex w-full mx-auto mt-4">
                                <button type="submit" class="flex mt-4 items-center justify-center focus:outline-none text-white text-lg bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-4 w-full transition duration-150 ease-in">
                                    <span class="uppercase montserrat font-bold ">report a catch</span>
                                </button>
                            </div>
                        </form>

                    </div>

                    </div>

                </div>
            </div>
    </BreezeGuestLayout>
</template>
