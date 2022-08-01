<template>
    <Show>
        <template #header>
            <div>
                <Link :href="back">
                    <svg  xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </Link>
            </div>
            <div>
                <h1 class="text-xl w-full text-white font-bold montserrat">{{project.name ?? ''}}</h1>
            </div>
            <div>
                <Link :href="route('scan')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </Link>
            </div>
        </template>
        <div class="flex flex-wrap mt-6 p-4">
            <div class="w-full text-tree-poppy uppercase montserrat font-bold text-sm">
                project
            </div>
            <div class="mt-4 w-full montserrat text-4xl text-bay-of-many-500 font-bold">
                {{project.name ?? ''}}
            </div>
            <div v-if="!user_in_pr" class=" w-full px-8 mt-5">
                <button type="button" class="flex montserrat items-center font-bold justify-center focus:outline-none text-white text-md sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-3 w-full transition duration-150 ease-in">
                    <span class="uppercase">JOIN project</span>
                </button>
            </div>
            <div class="w-full mt-3 text-sm dark:text-white:" v-if="user_in_pr && !coordinator">
                Member
            </div>
            <div class="w-full mt-3 text-sm dark:text-white:" v-if="coordinator">
                Project Coordinator
            </div>
            <div v-if="user_in_pr && !coordinator" class=" w-full px-8 mt-5 flex flex-wrap">
                <button type="button" class="flex montserrat items-center font-bold justify-center focus:outline-none text-bay-of-many-500 text-md sm:text-base bg-mystic-600 hover:bg-bay-of-many-600 rounded-full py-3 w-full transition duration-150 ease-in">
                    <span class="uppercase">leave project</span>
                </button>
            </div>

        </div>
        <in-project :project="project" :user_data="user_in_pr" v-if="coordinator"/>

    </Show>
</template>

<script>
import Show from '@/Layouts/Show.vue';
import { Link } from '@inertiajs/inertia-vue3'
import NotInProject from "@/Components/Projects/NotInProject.vue";
import InProject from "@/Components/Projects/InProject.vue";

export default {
    components:{
        InProject,
        NotInProject,
        Link,
        Show
    },
    name: "ViewProject",
    props:{
        project:Object,
        back:String,
        user_in_pr_data:Object,
        user_in_pr:Boolean,
        coordinator:Boolean,
    },
    data() {
        return {
        }
    },
    mounted() {

    },
    methods: {

    }
}
</script>
<style scoped>

</style>
