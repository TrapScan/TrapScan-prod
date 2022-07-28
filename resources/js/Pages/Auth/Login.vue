<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import {ref} from "vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

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
    <BreezeGuestLayout>
        <div v-if="log_in_via_email === 0" >
            <div class="flex flex-wrap overflow-hidden px-4">

                <div class="w-full overflow-hidden">
                    <div class="mb-10 ">
                        <p class="text-dark montserrat text-2xl font-bold">How would you like to log in?</p>
                    </div>
                </div>
                <div v-if="$page.props.flash.message" class="alert w-full my-5">
                    <el-alert :title="$page.props.flash.message" type="success" show-icon />
                </div>
                <Link class="w-full overflow-hidden items-center justify-center border-2 bg-white p-4 border-black flex justify-between rounded mb-4" :href="route('social_auth','google')">

                        <div class="h-14 w-14 justify-center flex border-2 rounded-2xl border-gray-300 shadow-sm w-2/12">
                            <svg  class="my-auto" width="30" height="30" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <rect width="30" height="29" fill="url(#pattern0)"/>
                                <defs>
                                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image0_1531_3561" transform="translate(-0.00922619) scale(0.00863095 0.00892857)"/>
                                    </pattern>
                                    <image id="image0_1531_3561" width="118" height="112" xlink:href="data:image/png;base64,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"/>
                                </defs>
                            </svg>

                        </div>
                        <div class="ml-3 py-2 w-8/12">
                            <p class="ubuntu font-bold">Google Sign in</p>
                        </div>
                        <div class="ml-3 py-3">
                            <svg width="10" height="14" viewBox="0 0 10 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.33333 0.999999L8 6.99106L1.33333 13" stroke="#A9B0B5" stroke-width="2" stroke-linecap="round"/>
                            </svg>

                        </div>
                </Link>
                <div class="w-full overflow-hidden items-center justify-center border-2 bg-white p-4 border-black flex justify-between rounded mb-4">
                    <div class="h-14 w-14 justify-center flex border-2 rounded-2xl border-gray-300 shadow-sm w-2/12">
                        <svg class="my-auto"  width="32px" height="32px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#132bdd"><path fill="none" d="M0 0h24v24H0z"></path><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"></path></svg>
                    </div>
                    <div class="ml-3 py-2 w-8/12">
                        <p class="ubuntu font-bold">Facebook Sign in</p>
                    </div>
                    <div class="ml-3 py-3">
                        <svg width="10" height="14" viewBox="0 0 10 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.33333 0.999999L8 6.99106L1.33333 13" stroke="#A9B0B5" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
                <div class="w-full overflow-hidden items-center justify-center border-2 bg-white p-4 border-black flex justify-between rounded mb-4">
                    <div class="h-14 w-14 justify-center flex border-2 rounded-2xl border-gray-300 shadow-sm w-2/12">
                        <svg  class="my-auto" width="24" height="24" role="img" viewBox="0 0 24 24" fill="currentColor" color="#000" xmlns="http://www.w3.org/2000/svg"><title>Apple icon</title><path d="M7.078 23.55c-.473-.316-.893-.703-1.244-1.15-.383-.463-.738-.95-1.064-1.454-.766-1.12-1.365-2.345-1.78-3.636-.5-1.502-.743-2.94-.743-4.347 0-1.57.34-2.94 1.002-4.09.49-.9 1.22-1.653 2.1-2.182.85-.53 1.84-.82 2.84-.84.35 0 .73.05 1.13.15.29.08.64.21 1.07.37.55.21.85.34.95.37.32.12.59.17.8.17.16 0 .39-.05.645-.13.145-.05.42-.14.81-.31.386-.14.692-.26.935-.35.37-.11.728-.21 1.05-.26.39-.06.777-.08 1.148-.05.71.05 1.36.2 1.94.42 1.02.41 1.843 1.05 2.457 1.96-.26.16-.5.346-.725.55-.487.43-.9.94-1.23 1.505-.43.77-.65 1.64-.644 2.52.015 1.083.29 2.035.84 2.86.387.6.904 1.114 1.534 1.536.31.21.582.355.84.45-.12.375-.252.74-.405 1.1-.347.807-.76 1.58-1.25 2.31-.432.63-.772 1.1-1.03 1.41-.402.48-.79.84-1.18 1.097-.43.285-.935.436-1.452.436-.35.015-.7-.03-1.034-.127-.29-.095-.576-.202-.856-.323-.293-.134-.596-.248-.905-.34-.38-.1-.77-.148-1.164-.147-.4 0-.79.05-1.16.145-.31.088-.61.196-.907.325-.42.175-.695.29-.855.34-.324.096-.656.154-.99.175-.52 0-1.004-.15-1.486-.45zm6.854-18.46c-.68.34-1.326.484-1.973.436-.1-.646 0-1.31.27-2.037.24-.62.56-1.18 1-1.68.46-.52 1.01-.95 1.63-1.26.66-.34 1.29-.52 1.89-.55.08.68 0 1.35-.25 2.07-.228.64-.568 1.23-1 1.76-.435.52-.975.95-1.586 1.26z"></path></svg>
                    </div>
                    <div class="ml-3 py-2 w-8/12">
                        <p class="ubuntu font-bold">Apple ID</p>
                    </div>
                    <div class="ml-3 py-3">
                        <svg width="10" height="14" viewBox="0 0 10 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.33333 0.999999L8 6.99106L1.33333 13" stroke="#A9B0B5" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
                <div class="w-full overflow-hidden justify-center items-center border-2 bg-white p-4 border-black flex justify-between rounded mb-4 " @click="log_in_via_email = 2">
                    <div class="h-14 w-14 justify-center flex border-2 rounded-2xl border-gray-300 shadow-sm w-2/12">
                        <svg class="my-auto"  width="33" height="29" viewBox="0 0 33 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24.5 4.49976L3.50049 7.99976L6.5 24.4998L14 23.4998L16.5 19.9998L20 17.4998L24 15.4998V12.9998L26 13.9998L24.5 4.49976Z" fill="white"/>
                            <path d="M3.16647 7.50417C3.4 7.17276 3.7225 6.96938 4.12035 6.9042L23.4713 3.73412C23.8692 3.66893 24.2453 3.75257 24.5791 3.99633C24.9067 4.23847 25.1059 4.56767 25.1729 4.97664L26.5 14.5L25 13.5L24.1666 7.22272L16.4171 18.2592C16.3078 18.4145 16.1593 18.4995 15.9785 18.5292L15.9304 18.537C15.7493 18.5667 15.5815 18.5335 15.4284 18.4212L4.56243 10.4343L6.7548 23.8171C6.76281 23.866 6.84713 23.9261 6.90728 23.9163L15.4284 22.5L14.2036 24.0944L7.12639 25.2538C6.72855 25.319 6.3675 25.2302 6.03052 24.987C5.69388 24.7463 5.49391 24.4331 5.4286 24.0344L2.90419 8.62476C2.83719 8.21579 2.92825 7.8443 3.16647 7.50417ZM4.2502 8.5284L15.6919 16.9307L23.8544 5.31682L23.8346 5.19593C23.8249 5.13679 23.7387 5.06373 23.6904 5.07165L4.3395 8.24172C4.25517 8.25554 4.21484 8.31232 4.23043 8.40749L4.2502 8.5284Z" fill="#262626"/>
                            <path d="M13.524 24.6527C13.6191 24.3572 13.7066 24.0061 14.1382 23.0464C14.579 22.0639 15.0718 21.1789 16.0361 19.9109C16.9916 18.6555 18.0396 17.5744 19.7042 16.4126C20.5324 15.8328 21.4167 15.3021 22.3589 14.8605L21.5916 11.9969C21.4928 11.6283 21.6006 11.326 21.9068 11.1055C22.224 10.8753 22.5253 10.8756 22.8251 11.0485L29.9589 15.1674C30.3897 15.4167 30.5172 15.889 30.267 16.3173L26.1409 23.4229C26.021 23.6272 25.8646 23.7502 25.6431 23.8095C25.5546 23.8332 25.447 23.8452 25.3171 23.8327C24.9302 23.7473 24.6853 23.5428 24.5984 23.2183L23.8505 20.4272L23.3043 20.5735C22.0784 20.902 20.8628 21.3864 19.6828 22.0031C17.8368 22.9704 16.3718 24.2172 14.9869 25.4459L14.9615 25.4696C14.7178 25.7409 14.2699 25.8271 13.9339 25.6504C13.5511 25.4491 13.4302 25.1067 13.5168 24.685L13.524 24.6527ZM22.8695 18.9511C23.5191 18.777 24.0109 18.6655 24.3464 18.6161C24.7581 18.5598 25.173 18.8065 25.2878 19.2349L25.7116 20.8164L28.4005 16.2029L23.7566 13.5203L24.188 15.1301C24.3028 15.5586 24.0965 15.9684 23.7117 16.1289C20.8818 17.3193 18.5788 19.1823 16.8085 21.7299C18.726 20.4395 20.7579 19.5169 22.8695 18.9511Z" fill="#0AB587"/>
                        </svg>
                    </div>
                    <div class="ml-3 py-2 w-8/12">
                        <p class="ubuntu font-bold">Email link ✨</p>
                        <p class="text-sm text-gray-400">No password required!</p>
                    </div>
                    <div class="ml-3 py-3">
                        <svg width="10" height="14" viewBox="0 0 10 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.33333 0.999999L8 6.99106L1.33333 13" stroke="#A9B0B5" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
                <div class="w-full overflow-hidden justify-center border-2 bg-white p-4 border-black flex justify-between rounded mb-4 " @click="log_in_via_email = 1">
                    <div class="h-14 w-14 justify-center flex border-2 rounded-2xl border-gray-300 shadow-sm w-2/12">
                        <svg class="my-auto" width="32" height="9" viewBox="0 0 32 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.88788 2.23274C7.66919 1.85294 7.17425 1.72634 6.79441 1.94501L4.79164 3.10742V0.794117C4.79164 0.356777 4.43483 0 3.99744 0C3.56006 0 3.20324 0.356777 3.20324 0.794117V3.10742L1.20047 1.94501C0.820636 1.72634 0.325699 1.85294 0.107006 2.23274C-0.111687 2.61253 0.0149245 3.10742 0.39476 3.32609L2.40904 4.5L0.39476 5.67391C0.0149245 5.89258 -0.111687 6.38747 0.107006 6.76726C0.325699 7.14706 0.820636 7.27366 1.20047 7.05499L3.20324 5.89258V8.20588C3.20324 8.64322 3.56006 9 3.99744 9C4.43483 9 4.79164 8.64322 4.79164 8.20588V5.89258L6.79441 7.05499C7.17425 7.27366 7.66919 7.14706 7.88788 6.76726C8.10657 6.38747 7.97996 5.89258 7.60012 5.67391L5.58584 4.5L7.60012 3.32609C7.97996 3.09591 8.11808 2.61253 7.88788 2.23274Z" fill="#262626"/>
                            <path d="M19.8879 2.23274C19.6692 1.85294 19.1742 1.72634 18.7944 1.94501L16.7916 3.10742V0.794117C16.7916 0.356777 16.4348 0 15.9974 0C15.5601 0 15.2032 0.356777 15.2032 0.794117V3.10742L13.2005 1.94501C12.8206 1.72634 12.3257 1.85294 12.107 2.23274C11.8883 2.61253 12.0149 3.10742 12.3948 3.32609L14.409 4.5L12.3948 5.67391C12.0149 5.89258 11.8883 6.38747 12.107 6.76726C12.3257 7.14706 12.8206 7.27366 13.2005 7.05499L15.2032 5.89258V8.20588C15.2032 8.64322 15.5601 9 15.9974 9C16.4348 9 16.7916 8.64322 16.7916 8.20588V5.89258L18.7944 7.05499C19.1742 7.27366 19.6692 7.14706 19.8879 6.76726C20.1066 6.38747 19.98 5.89258 19.6001 5.67391L17.5858 4.5L19.6001 3.32609C19.98 3.09591 20.1181 2.61253 19.8879 2.23274Z" fill="#262626"/>
                            <path d="M24.1071 6.76726C24.3259 7.14706 24.8212 7.27366 25.2012 7.05499L27.2053 5.89258V8.20588C27.2053 8.64322 27.5623 9 28 9C28.4377 9 28.7947 8.64322 28.7947 8.20588V5.89258L30.7988 7.05499C31.1788 7.27366 31.6741 7.14706 31.8929 6.76726C32.1118 6.38747 31.9851 5.89258 31.605 5.67391L29.5894 4.5L31.605 3.32609C31.9851 3.10742 32.1118 2.61253 31.8929 2.23274C31.6741 1.85294 31.1788 1.72634 30.7988 1.94501L28.7947 3.10742V0.794117C28.7947 0.356777 28.4377 0 28 0C27.5623 0 27.2053 0.356777 27.2053 0.794117V3.10742L25.2012 1.94501C24.8212 1.72634 24.3259 1.85294 24.1071 2.23274C23.8882 2.61253 24.0149 3.10742 24.395 3.32609L26.4106 4.5L24.395 5.67391C24.0149 5.89258 23.8882 6.38747 24.1071 6.76726Z" fill="#262626"/>
                        </svg>
                    </div>
                    <div class="ml-3 py-2 w-8/12">
                        <p class="ubuntu font-bold">Email with password</p>
                    </div>
                    <div class="ml-3 py-3">
                        <svg width="10" height="14" viewBox="0 0 10 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.33333 0.999999L8 6.99106L1.33333 13" stroke="#A9B0B5" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>
        <div v-if="log_in_via_email === 1">
            <div class="p-3">
                <div class="w-full overflow-hidden">
                    <div class="mb-5">
                        <p class="text-dark montserrat text-2xl font-bold flex items-center">
                             <span @click="log_in_via_email = 0">
                          <svg class="h-6 w-6 rotate-180 mr-2 " fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" >
                            <path  d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>
                        </span>
                            Email login
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
                        <div class="flex justify-between mt-5">
                            <label class="block ubuntu text-2xs text-dark font-bold mb-2" for="grid-password">Password</label>
                            <Link class="ubuntu underline text-niagara-500" :href="route('password.request')">
                                Forgot your password?
                            </Link>
                        </div>

                        <div class="relative flex w-full flex-wrap items-stretch mb-3">
                              <span class="z-10 h-full leading-snug font-normal absolute text-center text-slate-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                              <i class="fas fa-lock text-gray-500"></i>
                              </span>
                            <input  v-model="form.password" required autocomplete="current-password" type="password" class="px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10"/>
                        </div>
                        <div class="flex">
                            <div class="flex w-full mx-auto">
                                <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="flex mt-2 items-center font-bold justify-center focus:outline-none text-white text-sm sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-3 w-full transition duration-150 ease-in">
                                    <span class="mr-2 uppercase">Log in</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex mt-20 justify-center flex-wrap ">
                            <h6 class="ubuntu text-xl w-full text-center text-gray-400">Don’t have an account?</h6>
                            <Link class="ubuntu text w-full-xl underline text-center text-niagara-500 font-bold" :href="route('register')">
                                Register
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div v-if="log_in_via_email === 2">
            <div class="p-3">
                <div class="w-full overflow-hidden">
                    <div class="mb-5">
                        <p class="text-dark montserrat text-2xl font-bold flex items-center">
                             <span @click="log_in_via_email = 0">
                          <svg class="h-6 w-6 rotate-180 mr-2 " fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" >
                            <path  d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>
                        </span>
                            Email link login ✨
                        </p>
                    </div>
                </div>
                <div v-if="$page.props.flash.message" class="alert w-full">
                    <el-alert :title="$page.props.flash.message" type="success" show-icon />
                </div>
                <div class="mt-2 w-11/12 mx-auto ">
                    <form @submit.prevent="submit_magic">
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
                            <input placeholder="Email" v-model="form_magic.email" required autofocus autocomplete="username" type="text" class="px-3 py-3 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full pl-10"/>
                        </div>
                        <div class="flex">
                            <div class="flex w-full mx-auto">
                                <button type="submit" :class="{ 'opacity-25': form_magic.processing }" :disabled="form_magic.processing" class="flex mt-2 items-center font-bold justify-center focus:outline-none text-white text-sm sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-3 w-full transition duration-150 ease-in">
                                    <span class="mr-2 uppercase">SEND log in LINK </span>
                                </button>
                            </div>
                        </div>
                        <div class="flex mt-20 justify-center flex-wrap ">
                            <h6 class="ubuntu text-xl w-full text-center text-gray-400">Don’t have an account?</h6>
                            <Link class="ubuntu text w-full-xl underline text-center text-niagara-500 font-bold" :href="route('register')">
                                Register
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </BreezeGuestLayout>
</template>
