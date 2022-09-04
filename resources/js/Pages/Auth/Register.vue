<script setup>
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import Primary from "@/UI/Buttons/Primary.vue";
import TsInput from "@/Components/Input.vue"

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

    <div class="min-h-screen h-full bg-t_blue_gray-100  dark:bg-t_black-900">
        <nav class="bg-t_green-800 h-[44px] flex items-center justify-between flex-wrap w-full shadow-2xl px-4 mb-6">
            <Link :href="route('login')">
                <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.39316 12.0653C7.86179 11.5966 7.86179 10.8368 7.39316 10.3682L3.44168 6.41675L7.39316 2.46528C7.86179 1.99665 7.86179 1.23685 7.39316 0.76822C6.92453 0.299591 6.16473 0.299591 5.6961 0.76822L0.896099 5.56822C0.427469 6.03685 0.427469 6.79665 0.896099 7.26528L5.6961 12.0653C6.16473 12.5339 6.92453 12.5339 7.39316 12.0653Z" fill="white"/>
                </svg>
            </Link>
            <div>
                <h1 class="text-white font-bold ml-1 text-[16px] font-fira tracking-wide">Register</h1>
            </div>
            <div>
                <Link :href="route('login')">
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.837327 0.709641C1.22785 0.319117 1.86102 0.319117 2.25154 0.709641L6.54443 5.00253L10.8373 0.709639C11.2279 0.319115 11.861 0.319115 12.2515 0.709639C12.6421 1.10016 12.6421 1.73333 12.2515 2.12385L7.95865 6.41675L12.2515 10.7096C12.6421 11.1002 12.6421 11.7333 12.2515 12.1239C11.861 12.5144 11.2279 12.5144 10.8373 12.1239L6.54443 7.83096L2.25154 12.1239C1.86102 12.5144 1.22785 12.5144 0.837329 12.1239C0.446804 11.7333 0.446804 11.1002 0.837329 10.7096L5.13022 6.41675L0.837327 2.12385C0.446803 1.73333 0.446803 1.10017 0.837327 0.709641Z" fill="white"/>
                    </svg>
                </Link>
            </div>

        </nav>
        <!-- Page Content -->
        <main class="container mx-auto h-full max-w-lg mb-auto overflow-auto">
            <div class=" w-full px-5 ">
                <form @submit.prevent="submit">
                    <div class="flex flex-col">
                        <BreezeValidationErrors class="mb-4" />
                    </div>
                    <ts-input v-model="form.name" label="Name"/>
                    <ts-input v-model="form.email" type="email" label="Your email"/>
                    <ts-input v-model="form.password" type="password" label="Password"/>
                    <ts-input v-model="form.password_confirmation" type="password" label="Confirm Password"/>

                    <div class="flex">
                        <div class="flex w-full mx-auto">
                            <primary :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                              Register
                            </primary>
                        </div>
                    </div>
                </form>
                <div class="flex mt-6 justify-center flex-wrap ">
                    <h6 class="font-fira text-xl w-full text-center dark:text-t_white-200 text-t_black-800">Already have an account?</h6>
                    <Link class="font-fira underline text-t_purple-200 font-medium text-[18px] leading-8" :href="route('login')">
                        Login
                    </Link>
                </div>
            </div>
        </main>

    </div>

</template>
