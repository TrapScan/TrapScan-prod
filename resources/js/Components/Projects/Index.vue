<template>
    <div class="flex flex-col h-full gap-y-3 mt-5 mb-24">
        <Heading_H1 :type="true">My Projects</Heading_H1>
<!--        <h6 class="ml-4 mt-6 mb-2 w-full text-[] montserrat font-bold font-weight-bold text-bay-of-many-500 dark:text-white">My Projects</h6>-->
        <div class="flex flex-col dark:bg-t_black-950 bg-t_blue_gray-50 border-b border-t border-t_blue_gray-400 dark:border-gray-600 pl-4">
            <div v-for="(item, index) in list" :key="item.name" :class='{"border-b border-t_blue_gray-400 dark:border-gray-600": list.length !== (index + 1)}' class="w-full text-t_black-800 dark:text-t_white-200 flex justify-between">
                <Link :href="route('user.projects.view',item.id)" class="font-fira text-[20px] justify-between inline-flex items-center py-6 px-4 w-full font-bold">
                    <span>{{item.name}}</span>
                    <arrow-next/>
                </Link>
            </div>
        </div>
        <span class="mt-3"></span>
        <Heading_H1>Other Projects</Heading_H1>
        <div class="flex flex-col dark:bg-t_black-950 bg-t_blue_gray-50 border-b border-t border-t_blue_gray-400 dark:border-gray-600 pl-4">
            <div v-for="(item, index) in projects_all" :key="item.name" :class='{"border-b border-t_blue_gray-400 dark:border-gray-600": projects_all.length !== (index + 1)}' class="w-full text-t_black-800 dark:text-t_white-200 flex justify-between">
                <Link :href="route('user.projects.view',item.id)" class="font-fira text-[20px] justify-between inline-flex items-center py-6 px-4 w-full font-bold">
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
import Heading_H1 from "@/UI/Text/Heading_H1.vue";

export default {
    components: {ArrowNext, TextVal, Link, Heading_H1},
    name: "Index",
    props:{
        list: Object,
        projects_all: Object
    }
}
</script>

<style scoped>

</style>
