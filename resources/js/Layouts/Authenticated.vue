<script>
import { Link } from '@inertiajs/inertia-vue3'
import Menu from "@/Components/BottomMenu.vue";
import {ElMessage} from "element-plus";

export default {
    components:{
        Menu,
        Link
    },
    data() {
        return {
            them:localStorage.getItem('color-theme')
        }
    },
    watch: {

    },
    mounted() {
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }

    },
    methods: {
        toggleDarkMode() {
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                    this.them = 'dark';
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                    this.them = 'light';
                }

            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                    this.them = 'light';
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                    this.them = 'dark';

                }
            }
        }
    }
}
</script>

<template>
    <div class="min-h-screen h-full bg-mystic-500 dark:bg-mirage-600 dark:text-gray-300 ">
        <nav class="bg-niagara-500 h-[64px] mb-8 shadow-2xl">
            <!-- Primary Navigation Menu -->
            <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <Link :href="route('scan')">
                                <svg width="27" height="33" viewBox="0 0 27 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.0856 30.5827V32.9608H0V24.8752H2.3781V30.5827H8.0856Z" fill="black"/>
                                    <path d="M18.5493 2.3781V0H26.6349V8.0856H24.2568V2.3781H18.5493Z" fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1712 30.245L26.6349 24.2038V12.1214L10.4637 2.78491L0 8.82612V20.9085L16.1712 30.245ZM22.8299 14.2981L10.4637 7.15844L3.80497 11.0029V18.6917L16.1712 25.8313V18.1626L22.8299 21.9869V14.2981Z" fill="black"/>
                                    <path d="M16.1714 18.1623L22.8301 14.3179V22.0067L16.1714 18.1623Z" fill="#ABC2D2"/>
                                    <path d="M10.4634 7.1582L3.80469 11.0027V18.6915L16.1709 25.8311V18.1623L22.8296 14.2978L10.4634 7.1582Z" fill="white"/>
                                </svg>
                            </Link>
                        </div>
                    </div>

                    <button @click="toggleDarkMode" id="theme-toggle" type="button" class="text-gray-500 p-2.5">
                        <svg v-if="them !== 'dark'" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.0008 6.38306C10.2494 6.38306 6.38379 10.2487 6.38379 15.0001C6.38379 19.7515 10.2494 23.6172 15.0008 23.6172C19.7523 23.6172 23.6179 19.7515 23.6179 15.0001C23.6179 10.2487 19.7523 6.38306 15.0008 6.38306ZM15.0008 21.7023C11.3053 21.7023 8.2987 18.6957 8.2987 15.0001C8.2987 11.3045 11.3053 8.29796 15.0008 8.29796C18.6964 8.29796 21.703 11.3045 21.703 15.0001C21.703 18.6957 18.6964 21.7023 15.0008 21.7023Z" fill="white" fill-opacity="0.5"/>
                            <path d="M14.9999 4.90478C15.5287 4.90478 15.9573 4.47611 15.9573 3.94735V0.957424C15.9573 0.428673 15.5287 0 14.9999 0C14.4712 0 14.0425 0.428673 14.0425 0.957424V3.9473C14.0425 4.47605 14.4712 4.90478 14.9999 4.90478Z" fill="white" fill-opacity="0.5"/>
                            <path d="M14.9999 25.0952C14.4712 25.0952 14.0425 25.5239 14.0425 26.0526V29.0425C14.0425 29.5713 14.4712 29.9999 14.9999 29.9999C15.5287 29.9999 15.9573 29.5713 15.9573 29.0425V26.0526C15.9573 25.5239 15.5287 25.0952 14.9999 25.0952Z" fill="white" fill-opacity="0.5"/>
                            <path d="M6.50788 7.86114C6.88171 8.23503 7.48798 8.23503 7.86193 7.86114C8.23582 7.48731 8.23582 6.88104 7.86193 6.50709L5.74774 4.39296C5.37391 4.01908 4.76764 4.01908 4.3937 4.39296C4.01981 4.76679 4.01981 5.37306 4.3937 5.74701L6.50788 7.86114Z" fill="white" fill-opacity="0.5"/>
                            <path d="M23.4924 22.1388C23.1185 21.7649 22.5123 21.765 22.1383 22.1388C21.7644 22.5126 21.7644 23.1189 22.1383 23.4928L24.2525 25.607C24.6263 25.981 25.2326 25.981 25.6065 25.607C25.9804 25.2332 25.9804 24.6269 25.6065 24.253L23.4924 22.1388Z" fill="white" fill-opacity="0.5"/>
                            <path d="M4.90478 15.0004C4.90478 14.4716 4.47611 14.043 3.94735 14.043H0.957424C0.428673 14.043 0 14.4716 0 15.0004C0 15.5291 0.428673 15.9578 0.957424 15.9578H3.9473C4.47605 15.9578 4.90478 15.5291 4.90478 15.0004Z" fill="white" fill-opacity="0.5"/>
                            <path d="M29.0425 14.043H26.0526C25.5239 14.043 25.0952 14.4716 25.0952 15.0004C25.0952 15.5291 25.5239 15.9578 26.0526 15.9578H29.0425C29.5713 15.9578 29.9999 15.5291 29.9999 15.0004C29.9999 14.4716 29.5713 14.043 29.0425 14.043Z" fill="white" fill-opacity="0.5"/>
                            <path d="M6.50929 22.1389L4.39516 24.253C4.02127 24.627 4.02127 25.2331 4.39516 25.6071C4.76899 25.981 5.37526 25.9811 5.74921 25.6071L7.86333 23.4929C8.23722 23.119 8.23722 22.5128 7.86333 22.1389C7.48945 21.7649 6.88318 21.7649 6.50929 22.1389Z" fill="white" fill-opacity="0.5"/>
                            <path d="M23.4924 7.8612L25.6065 5.74701C25.9804 5.37312 25.9804 4.76691 25.6065 4.39296C25.2327 4.01908 24.6264 4.01908 24.2525 4.39296L22.1383 6.50715C21.7644 6.88104 21.7644 7.48725 22.1383 7.8612C22.5122 8.23508 23.1185 8.23514 23.4924 7.8612Z" fill="white" fill-opacity="0.5"/>
                        </svg>
                        <svg v-else width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.37381 3.79444C7.37381 2.4477 7.64521 1.16752 8.1368 0C3.46672 1.13168 0 5.33577 0 10.3489C0 16.2275 4.77249 21 10.6511 21C15.6642 21 19.8683 17.5333 21 12.8632C19.8325 13.3548 18.5472 13.6262 17.2056 13.6262C11.7776 13.6262 7.37381 9.22238 7.37381 3.79444Z" fill="#101A23" fill-opacity="0.5"/>
                        </svg>

                    </button>
<!--                    <Link :href="route('logout')" method="post" as="button">-->
<!--                        Log Out-->
<!--                    </Link>-->
                </div>
            </div>

        </nav>
        <!-- Page Content -->
        <main class="container mx-auto h-full max-w-lg mb-auto overflow-auto">
            <slot />
        </main>

        <Menu/>

    </div>
</template>

