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
                <button @click="enter" type="button" class="flex montserrat items-center font-bold justify-center focus:outline-none text-white text-md sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-3 w-full transition duration-150 ease-in">
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
                <button @click="visible = !visible" type="button" class="flex montserrat items-center font-bold justify-center focus:outline-none text-bay-of-many-500 text-md sm:text-base bg-mystic-600 rounded-full py-3 w-full transition duration-150 ease-in">
                    <span class="uppercase">leave project</span>
                </button>
            </div>

        </div>
        <in-project
            :project="project"
            :user_data="user_in_pr"
            v-if="coordinator"
            :notify_catches="user_in_pr_data.pivot.notify_catches"
            :notify_inspections="user_in_pr_data.pivot.notify_inspections"
            :notify_problems="user_in_pr_data.pivot.notify_problems"
        />
        <modal-window :showing="visible">
            <h1 class="mb-3 text-xl montserrat text-bay-of-many-500 font-bold">Are you sure you want to leave {{project.name ?? ''}}?</h1>
            <form @submit.prevent="leave">
                <div class="flex flex-wrap">
                    <div class="flex w-full mx-auto">
                        <button  :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" class="flex mt-2 items-center font-bold justify-center focus:outline-none text-white text-sm sm:text-base bg-valencia-500 hover:bg-valencia-600 rounded-full py-2 w-full transition duration-150 ease-in">
                            <span class="mr-2 uppercase">yes, leave</span>
                        </button>
                    </div>
                    <div class="flex w-full mx-auto">
                        <button  @click="visible = false" class="flex mt-2 items-center justify-center focus:outline-none text-bay-of-many-500 dark:text-mystic-100 dark:border-mystic-100 font-bold text-sm sm:text-base border-2 border-bay-of-many-500 hover:bg-bay-of-many-500 hover:text-white rounded-full py-2 w-full transition duration-150 ease-in">
                            <span class="mr-2 uppercase">No, stay</span>
                        </button>
                    </div>
                </div>
            </form>
        </modal-window>
    </Show>
</template>

<script>
import Show from '@/Layouts/Show.vue';
import {Link, useForm} from '@inertiajs/inertia-vue3'
import NotInProject from "@/Components/Projects/NotInProject.vue";
import InProject from "@/Components/Projects/InProject.vue";
import ModalWindow from "@/Components/ModalWindow.vue";

export default {
    components:{
        InProject,
        NotInProject,
        Link,
        Show,
        ModalWindow
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
            form:useForm({
                projectId:null
            }),
            visible:false,

        }
    },
    mounted() {

    },
    methods: {
        enter(){
            this.form.projectId = this.project.id;
            this.form.post(route('user.projects.enter'))
        },
        leave(){
            this.form.projectId = this.project.id;
            this.form.post(route('user.projects.leave'))
        }
    }
}
</script>
<style scoped>

</style>
