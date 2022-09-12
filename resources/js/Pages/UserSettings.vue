<template>
    <BreezeAuthenticatedLayout>
        <div class="flex flex-wrap p-4">
            <div class="w-full bg-gray-100 dark:bg-mirage-400 dark:text-white rounded-xl p-4 flex flex-col">
                <div class="flex flex-wrap mb-3 border-b-2 pb-3">
                    <h1 class="mt-6 mb-2 w-full text-3xl montserrat font-bold font-weight-bold text-bay-of-many-500 dark:text-white">My profile</h1>
                <p class="w-full text-black text-lg ubuntu dark:text-t_white-200">{{$page.props.auth.user.name}}</p>
                <p class="w-full text-gray-400">{{$page.props.auth.user.email}}</p>
                </div>

                <h1 class="montserrat text-2xl font-bold leading-normal">Settings</h1>
                <div class="border-b-2 border-t-2 border-gray-300 mt-2 px-3">
                <label for="checked-toggle3" class="flex justify-between items-center py-3 w-full mt-2">
                    <div class="montserrat font-bold text-md text-gray-900 dark:text-white">Dark mode</div>
                        <div  class="inline-flex relative items-center cursor-pointer">
                            <input type="checkbox" @click="toggleDarkMode" v-model="them" id="checked-toggle3" class="sr-only peer" >
                            <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </div>
                </label>
                </div>
                <div class=" w-full px-8 mt-5 flex flex-wrap justify-center">
                    <Link :href="route('logout')" method="post" type="button" class="font-fira font-bold  text-t_purple-200 text-md">
                        <span class="uppercase underline">Log out</span>
                    </Link>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Link } from '@inertiajs/inertia-vue3'
export default {
    components:{
        Link,
        BreezeAuthenticatedLayout
    },
    name: "UserProjects",
    props:{
        projects:Object,
    },
    data() {
        return {
            usr_s:null,
            them:false
        }
    },
    mounted() {
        this.them = localStorage.getItem('color-theme') === 'dark';
    },
    methods: {
        toggleDarkMode() {
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                    this.them = true;
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                    this.them = false;
                }

            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                    this.them = false;
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                    this.them = true;

                }
            }
        }
    }
}
</script>
<style scoped>

</style>
