<template>
    <BreezeAuthenticatedLayout>
        <div class="pb-24">
        <Link :href="route('user.projects')" class="w-full flex flex-wrap justify-start items-center mt-4 ml-6">
            <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_2440_1962)">
                    <rect class="fill-[#232F80] dark:fill-[#2F45C5]" x="40.1875" y="40.6123" width="40" height="40" rx="20" transform="rotate(180 40.1875 40.6123)"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M23.0362 26.2608C23.5049 25.7922 23.5049 25.0324 23.0362 24.5638L19.0848 20.6123L23.0362 16.6608C23.5049 16.1922 23.5049 15.4324 23.0362 14.9638C22.5676 14.4951 21.8078 14.4951 21.3392 14.9638L16.5392 19.7638C16.0705 20.2324 16.0705 20.9922 16.5392 21.4608L21.3392 26.2608C21.8078 26.7295 22.5676 26.7295 23.0362 26.2608Z" fill="white"/>
                </g>
                <defs>
                    <clipPath id="clip0_2440_1962">
                        <rect width="40" height="40" fill="white" transform="translate(0.1875 0.612305)"/>
                    </clipPath>
                </defs>
            </svg>
            <span class="font-bold montserrat ml-3 uppercase text-t_purple-700 text-[13px] dark:text-white">Back - </span>
            <span  class=" montserrat ml-3 uppercase text-t_purple-700 text-[13px] dark:text-white">
                projects
            </span>
        </Link>


        <div class="flex flex-wrap mt-12 ml-2">
            <div class="w-full text-t_warms-400 uppercase montserrat font-bold text-[12px] ml-4 mb-3">
                project
            </div>
            <Heading_H1 :type="true">{{project.name ?? ''}}</Heading_H1>

            <div v-if="!user_in_pr" class=" w-full px-8 mt-5">
                <button @click="enter" type="button" class="flex montserrat items-center font-bold justify-center focus:outline-none text-white text-md sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-3 w-full transition duration-150 ease-in">
                    <span class="uppercase">JOIN project</span>
                </button>
            </div>
            <div class="w-full mt-3 text-[18px] font-fira text-t_black-800 ml-4" v-if="user_in_pr && !coordinator">
                You are a member
            </div>
            <div class="w-full mt-3 text-[18px] font-fira text-t_black-800 ml-4" v-if="coordinator">
                You are an admin
            </div>
            <div v-if="user_in_pr && !coordinator" class=" w-full ml-4 mt-10 flex flex-wrap">
                <a @click="visible = !visible" type="button" class="font-fira font-bold text-t_purple-200 text-md">
                    <span class="uppercase underline">leave project</span>
                </a>
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
        </div>
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
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Link, useForm} from '@inertiajs/inertia-vue3'
import NotInProject from "@/Components/Projects/NotInProject.vue";
import InProject from "@/Components/Projects/InProject.vue";
import ModalWindow from "@/Components/ModalWindow.vue";
import Heading_H1 from "@/UI/Text/Heading_H1.vue";

export default {
    components:{
        InProject,
        NotInProject,
        Link,
        ModalWindow,
        BreezeAuthenticatedLayout,
        Heading_H1
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
