<template>
    <div class="flex flex-col h-full gap-y-3 mt-5 mb-24 ">
        <h6 class="ml-4 mt-6 mb-2 w-full text-3xl montserrat font-bold font-weight-bold text-bay-of-many-500 dark:text-white">My Projects</h6>
        <div class="flex flex-col">
            <div v-for="item in list" :key="item.name" class="w-full text-gray-900 test dark:bg-gray-700  dark:text-white flex justify-between">
                <Link :href="route('user.projects.view',item.id)" class="montserrat justify-between inline-flex relative items-center py-6 px-4 w-full text-xl font-bold border-b border-t border-mystic-800  hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                    <span>{{item.name}}</span>
                    <arrow-next/>
                </Link>
            </div>
        </div>
        <br>
        <h6 class="ml-4 mt-6 mb-2 w-full text-3xl montserrat font-bold font-weight-bold text-bay-of-many-500 dark:text-white">Other Projects</h6>
        <div class="flex flex-col">
            <div v-for="item in projects_all" :key="item.name" class="w-full text-gray-900 test dark:bg-gray-700  dark:text-white flex justify-between">
                <Link :href="route('user.projects.view',item.id)" class="montserrat justify-between inline-flex relative items-center py-6 px-4 w-full text-xl font-bold border-b border-t border-mystic-800  hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                    <span>{{item.name}}</span>
                    <arrow-next/>
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import TextVal from "@/Components/Inspection/Other/TextVal.vue";
import ArrowNext from "@/Components/SVG/ArrowNext.vue";
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {ArrowNext, TextVal, Link},
    name: "Index",
    props:{
        list: Object,
        projects_all: Object
    }
}
</script>

<style scoped>

</style>
