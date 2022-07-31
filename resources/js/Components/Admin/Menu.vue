<template>
    <!-- Header -->
    <div class="fixed w-full flex items-center justify-between h-14 text-white z-10">
        <div class="flex items-center justify-start md:justify-center pl-3 w-14 md:w-64 h-14 bg-blue-800 dark:bg-gray-800 border-none">
            <img class="w-7 h-7 md:w-10 md:h-10 mr-2 rounded-md overflow-hidden" src="https://therminic2018.eu/wp-content/uploads/2018/07/dummy-avatar.jpg" />
            <span class="hidden md:block">ADMIN</span>
        </div>
        <div class="flex justify-end items-center h-14 bg-blue-800 dark:bg-gray-800 header-right">

            <ul class="flex items-center">
                <li>
                    <button
                        aria-hidden="true"
                        @click="toggleDarkMode"
                        class="group p-2 transition-colors duration-200 rounded-full shadow-md bg-blue-200 hover:bg-blue-200 dark:bg-gray-50 dark:hover:bg-gray-200 text-gray-900 focus:outline-none"
                    >
                        <svg
                            v-if="them === 'dark'"
                            width="24"
                            height="24"
                            class="fill-current text-gray-700 group-hover:text-gray-500 group-focus:text-gray-700 dark:text-gray-700 dark:group-hover:text-gray-500 dark:group-focus:text-gray-700"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke=""
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                            />
                        </svg>
                        <svg
                            v-else
                            width="24"
                            height="24"
                            class="fill-current text-gray-700 group-hover:text-gray-500 group-focus:text-gray-700 dark:text-gray-700 dark:group-hover:text-gray-500 dark:group-focus:text-gray-700"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke=""
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
                            />
                        </svg>
                    </button>
                </li>
                <li>
                    <div class="block w-px h-6 mx-3 bg-gray-400 dark:bg-gray-700"></div>
                </li>
                <li>
                    <Link :href="route('logout')" method="post" as="button" class="flex items-center mr-4 hover:text-blue-100">
                                <span class="inline-flex mr-1">
                                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                </span>
                        Logout
                    </Link>
                </li>
            </ul>
        </div>
    </div>
    <!-- ./Header -->

    <!-- Sidebar -->
    <div class="fixed flex flex-col top-14 left-0 w-14 hover:w-64 md:w-64 bg-blue-900 dark:bg-gray-900 h-full text-white transition-all duration-300 border-none z-10 sidebar">
        <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
            <ul class="flex flex-col py-4 space-y-1">
                <li class="px-5 hidden md:block">
                    <div class="flex flex-row items-center h-8">
                        <div class="text-sm font-light tracking-wide text-gray-400 uppercase">Main</div>
                    </div>
                </li>
                <li>
                    <Link :href="route('admin.index')" :class="{'bg-blue-800 dark:bg-gray-600 border-blue-500 dark:border-gray-800': route().current('admin.index'), ' hover:bg-blue-800 dark:hover:bg-gray-600 hover:border-blue-500 dark:hover:border-gray-800': !route().current('admin.index')}" class="relative flex flex-row items-center h-11 focus:outline-none  text-white-600 hover:text-white-800 border-l-4 border-transparent  pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Stats</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('admin.unmapped_codes')" :class="{'bg-blue-800 dark:bg-gray-600 border-blue-500 dark:border-gray-800': route().current('admin.unmapped_codes'), ' hover:bg-blue-800 dark:hover:bg-gray-600 hover:border-blue-500 dark:hover:border-gray-800': !route().current('admin.unmapped_codes')}" class="relative flex flex-row items-center h-11 focus:outline-none  text-white-600 hover:text-white-800 border-l-4 border-transparent  pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Unmapped Codes</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('admin.unmapped_traps')" :class="{'bg-blue-800 dark:bg-gray-600 border-blue-500 dark:border-gray-800': route().current('admin.unmapped_traps'), ' hover:bg-blue-800 dark:hover:bg-gray-600 hover:border-blue-500 dark:hover:border-gray-800': !route().current('admin.unmapped_traps')}" class="relative flex flex-row items-center h-11 focus:outline-none  text-white-600 hover:text-white-800 border-l-4 border-transparent  pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Unmapped Traps</span>
                    </Link>
                </li>

                <li>
                    <Link :href="route('admin.all_traps')" :class="{'bg-blue-800 dark:bg-gray-600 border-blue-500 dark:border-gray-800': route().current('admin.all_traps'), ' hover:bg-blue-800 dark:hover:bg-gray-600 hover:border-blue-500 dark:hover:border-gray-800': !route().current('admin.all_traps')}" class="relative flex flex-row items-center h-11 focus:outline-none  text-white-600 hover:text-white-800 border-l-4 border-transparent  pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </span>
                        <span class="ml-2 text-sm tracking-wide truncate">All Traps</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('admin.scrape_data')" :class="{'bg-blue-800 dark:bg-gray-600 border-blue-500 dark:border-gray-800': route().current('admin.scrape_data'), ' hover:bg-blue-800 dark:hover:bg-gray-600 hover:border-blue-500 dark:hover:border-gray-800': !route().current('admin.scrape_data')}" class="relative flex flex-row items-center h-11 focus:outline-none  text-white-600 hover:text-white-800 border-l-4 border-transparent  pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Trap NZ Data</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('admin.users')" :class="{'bg-blue-800 dark:bg-gray-600 border-blue-500 dark:border-gray-800': route().current('admin.users'), ' hover:bg-blue-800 dark:hover:bg-gray-600 hover:border-blue-500 dark:hover:border-gray-800': !route().current('admin.users')}" class="relative flex flex-row items-center h-11 focus:outline-none  text-white-600 hover:text-white-800 border-l-4 border-transparent  pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </span>
                        <span class="ml-2 text-sm tracking-wide truncate">User Management</span>
                    </Link>
                </li>
            </ul>
            <p class="mb-14 px-5 py-3 hidden md:block text-center text-xs">Copyright @2022</p>
        </div>
    </div>
    <!-- ./Sidebar -->
</template>

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


<style scoped>

</style>
