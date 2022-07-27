<script >
import {Link} from "@inertiajs/inertia-vue3";
export default {
    components:{
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
    <div class="min-h-screen bg-mystic-500 dark:bg-mirage-500 dark:text-gray-300 ">
        <nav class="bg-niagara-500 h-[64px] mb-10 shadow-2xl">
            <!-- Primary Navigation Menu -->
            <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex ">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <Link :href="route('scan')">
                                <svg :key="them" width="27" height="33" viewBox="0 0 27 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.0856 30.5827V32.9608H0V24.8752H2.3781V30.5827H8.0856Z" fill="black"/>
                                    <path d="M18.5493 2.3781V0H26.6349V8.0856H24.2568V2.3781H18.5493Z" fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1712 30.245L26.6349 24.2038V12.1214L10.4637 2.78491L0 8.82612V20.9085L16.1712 30.245ZM22.8299 14.2981L10.4637 7.15844L3.80497 11.0029V18.6917L16.1712 25.8313V18.1626L22.8299 21.9869V14.2981Z" fill="black"/>
                                    <path d="M16.1714 18.1623L22.8301 14.3179V22.0067L16.1714 18.1623Z" fill="#ABC2D2"/>
                                    <path d="M10.4634 7.1582L3.80469 11.0027V18.6915L16.1709 25.8311V18.1623L22.8296 14.2978L10.4634 7.1582Z" fill="white"/>
                                </svg>
                            </Link>
                        </div>
                    </div>
                    <button @click="toggleDarkMode" id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">

                    </button>
                </div>
            </div>

        </nav>
        <!-- Page Content -->
        <main class="container mx-auto max-w-lg">
            <slot />
        </main>

    </div>
</template>
