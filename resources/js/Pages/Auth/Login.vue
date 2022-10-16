<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import {Link, useForm } from '@inertiajs/inertia-vue3';
import {ref} from "vue";
import Primary from "@/UI/Buttons/Primary.vue";
import TsInput from "@/Components/Input.vue"
import Panel from "@/Components/Panel.vue"
import Google from "@/Components/SVG/Google.vue"
import Fb from "@/Components/SVG/FB.vue"
import Apple from "@/Components/SVG/Apple.vue"

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const them = ref(localStorage.getItem('color-theme'))

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const form_magic = useForm({
    email: ''
});
const log_in_via_email = ref(0);

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {},
    });
};
const submit_magic = () => {
    form_magic.post(route('magic_login'), {
        onFinish: () => {},
    });
};
</script>

<template>
    <BreezeGuestLayout  v-if="log_in_via_email === 0">
            <div class="flex flex-wrap overflow-hidden px-4">

                <div class="w-full overflow-hidden">
                    <div class="mb-10 ">
                        <p class="dark:text-t_purple-200 text-t_black-800 text-2xl font-bold font-fira">How would you like to log in?</p>
                    </div>
                </div>
                <div v-if="$page.props.flash.message" class="alert w-full my-5">
                    <el-alert :title="$page.props.flash.message" type="success" show-icon />
                </div>

                <a :href="route('social_auth','google')" class="w-full">
                   <panel text="Google Sign in">
                       <template #svg>
                         <google/>
                       </template>
                   </panel>
                </a>
                <a :href="route('social_auth','facebook')" class="w-full">
                    <panel text="Facebook Sign in">
                        <template #svg>
                            <fb/>
                        </template>
                    </panel>
                </a>
                <!-- <a :href="route('social_auth','apple')" class="w-full">
                    <panel text="Apple ID">
                        <template #svg>
                            <apple/>
                        </template>
                    </panel>
                </a> -->
                <panel text="Email link ✨" small_text="No password required!" @click="log_in_via_email = 2">
                    <template #svg>
                        <svg  class="my-auto "  width="33" height="29" viewBox="0 0 33 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24.1904 4.10107L3.19092 7.60107L6.19043 24.1011L13.6904 23.1011L16.1904 19.6011L19.6904 17.1011L23.6904 15.1011V12.6011L25.6904 13.6011L24.1904 4.10107Z" fill="white"/>
                            <path d="M2.8569 7.10525C3.09042 6.77383 3.41293 6.57045 3.81078 6.50527L23.1617 3.33519C23.5596 3.27 23.9357 3.35365 24.2696 3.59741C24.5971 3.83955 24.7963 4.16875 24.8633 4.57772L26.1904 14.1011L24.6904 13.1011L23.8571 6.82379L16.1075 17.8603C15.9983 18.0156 15.8498 18.1006 15.6689 18.1302L15.6208 18.1381C15.4398 18.1678 15.2719 18.1345 15.1188 18.0223L4.25286 10.0354L6.44523 23.4182C6.45324 23.4671 6.53756 23.5272 6.59771 23.5173L15.1188 22.1011L13.8941 23.6955L6.81682 24.8549C6.41898 24.92 6.05793 24.8313 5.72095 24.588C5.38431 24.3474 5.18434 24.0341 5.11903 23.6354L2.59462 8.22584C2.52762 7.81686 2.61868 7.44537 2.8569 7.10525ZM3.94062 8.12947L15.3823 16.5318L23.5448 4.9179L23.525 4.797C23.5153 4.73786 23.4291 4.6648 23.3808 4.67272L4.02993 7.8428C3.9456 7.85661 3.90527 7.91339 3.92086 8.00857L3.94062 8.12947Z" fill="#1B2937"/>
                            <path d="M13.2144 24.2541C13.3095 23.9585 13.3971 23.6075 13.8286 22.6477C14.2695 21.6652 14.7622 20.7802 15.7265 19.5123C16.682 18.2568 17.7301 17.1757 19.3946 16.0139C20.2228 15.4341 21.1071 14.9034 22.0493 14.4618L21.282 11.5982C21.1833 11.2296 21.291 10.9273 21.5972 10.7068C21.9144 10.4766 22.2157 10.4769 22.5156 10.6498L29.6493 14.7687C30.0801 15.018 30.2076 15.4903 29.9574 15.9186L25.8313 23.0242C25.7115 23.2285 25.555 23.3515 25.3336 23.4108C25.245 23.4345 25.1375 23.4465 25.0075 23.434C24.6206 23.3486 24.3757 23.1441 24.2888 22.8196L23.5409 20.0285L22.9947 20.1748C21.7689 20.5033 20.5532 20.9877 19.3732 21.6044C17.5272 22.5717 16.0623 23.8185 14.6773 25.0472L14.6519 25.0709C14.4082 25.3422 13.9603 25.4284 13.6243 25.2517C13.2415 25.0504 13.1207 24.708 13.2072 24.2864L13.2144 24.2541ZM22.56 18.5524C23.2095 18.3783 23.7013 18.2668 24.0369 18.2174C24.4486 18.1611 24.8635 18.4078 24.9783 18.8363L25.402 20.4177L28.0909 15.8042L23.447 13.1216L23.8784 14.7314C23.9932 15.1599 23.787 15.5697 23.4022 15.7302C20.5722 16.9206 18.2693 18.7836 16.4989 21.3312C18.4164 20.0408 20.4483 19.1182 22.56 18.5524Z" fill="#0AB587"/>
                        </svg>
                    </template>
                </panel>
                <panel text="Email with password" @click="log_in_via_email = 1">
                    <template #svg>
                        <svg class="my-auto "  width="32" height="9" viewBox="0 0 32 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="fill-gray-900 dark:fill-gray-300" d="M7.88788 2.23274C7.66919 1.85294 7.17425 1.72634 6.79441 1.94501L4.79164 3.10742V0.794117C4.79164 0.356777 4.43483 0 3.99744 0C3.56006 0 3.20324 0.356777 3.20324 0.794117V3.10742L1.20047 1.94501C0.820636 1.72634 0.325699 1.85294 0.107006 2.23274C-0.111687 2.61253 0.0149245 3.10742 0.39476 3.32609L2.40904 4.5L0.39476 5.67391C0.0149245 5.89258 -0.111687 6.38747 0.107006 6.76726C0.325699 7.14706 0.820636 7.27366 1.20047 7.05499L3.20324 5.89258V8.20588C3.20324 8.64322 3.56006 9 3.99744 9C4.43483 9 4.79164 8.64322 4.79164 8.20588V5.89258L6.79441 7.05499C7.17425 7.27366 7.66919 7.14706 7.88788 6.76726C8.10657 6.38747 7.97996 5.89258 7.60012 5.67391L5.58584 4.5L7.60012 3.32609C7.97996 3.09591 8.11808 2.61253 7.88788 2.23274Z" fill="#1B2937"/>
                            <path class="fill-gray-900 dark:fill-gray-300"  d="M19.8879 2.23274C19.6692 1.85294 19.1742 1.72634 18.7944 1.94501L16.7916 3.10742V0.794117C16.7916 0.356777 16.4348 0 15.9974 0C15.5601 0 15.2032 0.356777 15.2032 0.794117V3.10742L13.2005 1.94501C12.8206 1.72634 12.3257 1.85294 12.107 2.23274C11.8883 2.61253 12.0149 3.10742 12.3948 3.32609L14.409 4.5L12.3948 5.67391C12.0149 5.89258 11.8883 6.38747 12.107 6.76726C12.3257 7.14706 12.8206 7.27366 13.2005 7.05499L15.2032 5.89258V8.20588C15.2032 8.64322 15.5601 9 15.9974 9C16.4348 9 16.7916 8.64322 16.7916 8.20588V5.89258L18.7944 7.05499C19.1742 7.27366 19.6692 7.14706 19.8879 6.76726C20.1066 6.38747 19.98 5.89258 19.6001 5.67391L17.5858 4.5L19.6001 3.32609C19.98 3.09591 20.1181 2.61253 19.8879 2.23274Z" fill="#1B2937"/>
                            <path class="fill-gray-900 dark:fill-gray-300"  d="M24.1071 6.76726C24.3259 7.14706 24.8212 7.27366 25.2012 7.05499L27.2053 5.89258V8.20588C27.2053 8.64322 27.5623 9 28 9C28.4377 9 28.7947 8.64322 28.7947 8.20588V5.89258L30.7988 7.05499C31.1788 7.27366 31.6741 7.14706 31.8929 6.76726C32.1118 6.38747 31.9851 5.89258 31.605 5.67391L29.5894 4.5L31.605 3.32609C31.9851 3.10742 32.1118 2.61253 31.8929 2.23274C31.6741 1.85294 31.1788 1.72634 30.7988 1.94501L28.7947 3.10742V0.794117C28.7947 0.356777 28.4377 0 28 0C27.5623 0 27.2053 0.356777 27.2053 0.794117V3.10742L25.2012 1.94501C24.8212 1.72634 24.3259 1.85294 24.1071 2.23274C23.8882 2.61253 24.0149 3.10742 24.395 3.32609L26.4106 4.5L24.395 5.67391C24.0149 5.89258 23.8882 6.38747 24.1071 6.76726Z" fill="#1B2937"/>
                        </svg>
                    </template>
                </panel>

            </div>
    </BreezeGuestLayout>
    <div v-if="log_in_via_email !== 0" class="min-h-screen h-full bg-t_blue_gray-100  dark:bg-t_black-900">
        <nav class="bg-t_green-800 h-[44px] flex items-center justify-between flex-wrap w-full shadow-2xl px-4 mb-6">
            <!-- Primary Navigation Menu -->
            <div @click="log_in_via_email = 0">
                <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.39316 12.0653C7.86179 11.5966 7.86179 10.8368 7.39316 10.3682L3.44168 6.41675L7.39316 2.46528C7.86179 1.99665 7.86179 1.23685 7.39316 0.76822C6.92453 0.299591 6.16473 0.299591 5.6961 0.76822L0.896099 5.56822C0.427469 6.03685 0.427469 6.79665 0.896099 7.26528L5.6961 12.0653C6.16473 12.5339 6.92453 12.5339 7.39316 12.0653Z" fill="white"/>
                </svg>
            </div>
            <div>
                <h1 v-if="log_in_via_email === 1" class="text-white font-bold ml-1 text-[16px] font-fira tracking-wide">Email login</h1>
                <h1 v-if="log_in_via_email === 2" class="text-white font-bold ml-1 text-[16px] font-fira tracking-wide">Email link login ✨</h1>
            </div>
            <div  @click="log_in_via_email = 0">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.837327 0.709641C1.22785 0.319117 1.86102 0.319117 2.25154 0.709641L6.54443 5.00253L10.8373 0.709639C11.2279 0.319115 11.861 0.319115 12.2515 0.709639C12.6421 1.10016 12.6421 1.73333 12.2515 2.12385L7.95865 6.41675L12.2515 10.7096C12.6421 11.1002 12.6421 11.7333 12.2515 12.1239C11.861 12.5144 11.2279 12.5144 10.8373 12.1239L6.54443 7.83096L2.25154 12.1239C1.86102 12.5144 1.22785 12.5144 0.837329 12.1239C0.446804 11.7333 0.446804 11.1002 0.837329 10.7096L5.13022 6.41675L0.837327 2.12385C0.446803 1.73333 0.446803 1.10017 0.837327 0.709641Z" fill="white"/>
                </svg>
            </div>

        </nav>
        <!-- Page Content -->
        <main class="container mx-auto h-full max-w-lg mb-auto overflow-auto">
            <div v-if="log_in_via_email === 1">
                <div class=" w-full px-5 ">
                    <form @submit.prevent="submit">
                        <div class="flex flex-col">
                            <BreezeValidationErrors class="mb-4" />
                        </div>
                        <ts-input v-model="form.email" label="Your email address"/>
                        <ts-input type="password" label="Password" v-model="form.password"/>

                        <div class="flex">
                            <div class="flex w-full mx-auto mt-5">
                                <primary :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                   Log in
                                </primary>
                            </div>
                        </div>
                        <div class="flex mt-6 justify-center flex-wrap ">
                            <h6 class="font-fira text-xl w-full text-center dark:text-t_white-200 text-t_black-800">Forgot your password?</h6>
                            <Link class="font-fira underline text-t_purple-200 font-medium text-[18px] leading-8" :href="route('password.request')">
                                Reset password
                            </Link>
                        </div>
                        <div class="flex mt-6 justify-center flex-wrap ">
                            <h6 class="font-fira text-xl w-full text-center dark:text-t_white-200 text-t_black-800">Don’t have an account?</h6>
                            <Link class="font-fira underline text-t_purple-200 font-medium text-[18px] leading-8" :href="route('register')">
                                Register
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
            <div v-if="log_in_via_email === 2">
                <div class="p-3">
                    <div v-if="$page.props.flash.message" class="alert w-full">
                        <el-alert :title="$page.props.flash.message" type="success" show-icon />
                    </div>
                    <div class=" w-full px-5 ">
                        <form @submit.prevent="submit_magic">
                            <div class="flex flex-col">
                                <BreezeValidationErrors class="mb-4" />
                            </div>
                            <ts-input v-model="form_magic.email" label="Your email address"/>
                            <div class="flex">
                                <div class="flex w-full mx-auto">
                                    <primary :class="{ 'opacity-25': form_magic.processing }" :disabled="form_magic.processing">
                                        SEND log in LINK
                                    </primary>
                                </div>
                            </div>
                            <div class="flex  mt-6 justify-center flex-wrap ">
                                <h6 class="font-fira text-xl w-full text-center dark:text-t_white-200 text-t_black-800">Don’t have an account?</h6>
                                <Link class="font-fira underline text-t_purple-200 font-medium text-[18px] leading-8" :href="route('register')">
                                    Register
                                </Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

    </div>
</template>
