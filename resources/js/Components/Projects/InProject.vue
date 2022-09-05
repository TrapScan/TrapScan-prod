<template>
    <div class="flex flex-wrap mt-5 px-4">
        <h6 class="font-bold montserrat text-xl text-dark dark:text-white">
            Trap.NZ synchronisation
        </h6>
<!--        <div class=" pt-4 ml-5 pb-2 w-full flex">-->
<!--            <h6 class="font-italic text-gray-500 ">-->
<!--                Last checked <span class="font-bold">3 weeks</span> ago-->
<!--            </h6>-->
<!--        </div>-->
        <div class="w-full px-8 mt-5">
            <button @click="syncPr" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="button" class="flex montserrat items-center font-bold justify-center focus:outline-none text-white text-md sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-3 w-full transition duration-150 ease-in">
                <span class="uppercase">sync trap.nz traps</span>
            </button>
        </div>

        <modal-window :showing="visible_sync">
            <h1 class="mb-3 text-xl montserrat text-gray-800 font-bold">Synchronising     ......</h1>
            <div class="flex w-full mx-auto">
                <button  @click="visible_sync = false" class="flex mt-2 items-center justify-center focus:outline-none text-bay-of-many-500 dark:text-mystic-100 dark:border-mystic-100 font-bold text-sm sm:text-base border-2 border-bay-of-many-500 hover:bg-bay-of-many-500 hover:text-white rounded-full py-2 w-full transition duration-150 ease-in">
                    <span class="mr-2 uppercase">Close</span>
                </button>
            </div>
        </modal-window>

        <modal-window :showing="visible_sync_done">
            <h1 class="mb-3 text-xl montserrat text-green-500 font-bold">Synchronisation complate</h1>
            <p>
               {{msg}}
            </p>
            <div class="flex w-full mx-auto">
                <button  @click="visible_sync_done = false" class="flex mt-2 items-center justify-center focus:outline-none text-bay-of-many-500 dark:text-mystic-100 dark:border-mystic-100 font-bold text-sm sm:text-base border-2 border-bay-of-many-500 hover:bg-bay-of-many-500 hover:text-white rounded-full py-2 w-full transition duration-150 ease-in">
                    <span class="mr-2 uppercase">Finish</span>
                </button>
            </div>
        </modal-window>

        <div class="flex flex-wrap w-full mt-3 px-4 py-3">
            <div @click="show = !show" class="flex justify-between items-center w-full">
                <div class="font-fira font-medium text-t_purple-300 text-[18px]">
                    How this button works
                </div>
                <div>
                    <svg :class="{'rotate-180': show}" width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 1.00008L8.01043 9.10718L1 1.00008" stroke="#222E7D" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>
        <div v-if="show" class="w-full w-full px-4 py-3">
            <p >
                If new traps are added to the above Trap.NZ project, pressing this will import them into TrapScan so that QR cards can be mapped to them. This button will also update any traps that have changed in Trap.NZ such as name and location changes.
                <img class="emoji flex inline-flex" alt="warning" height="20" width="20" src="https://github.githubassets.com/images/icons/emoji/unicode/26a0.png"> This can only be used once per hour
            </p>
        </div>
    </div>
    <h6 class="font-bold montserrat text-xl text-dark dark:text-white mt-10 px-4 border-b-2 border-gray-400">
        Notifications
    </h6>
    <div class="flex flex-wrap w-full px-4 py-3">
        <div class="flex justify-between items-center border-b-2 border-gray-400 py-3 w-full">
            <div class="montserrat font-bold text-md text-gray-900 dark:text-white">Catches</div>
            <div>
                <label for="checked-toggle1" class="inline-flex relative items-center cursor-pointer">
                    <input type="checkbox" @change="update('notify_catches',notify_catches)" v-model="notify_catches" id="checked-toggle1" class="sr-only peer" >
                    <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>
        </div>
<!--        <div class="flex justify-between items-center border-b-2 border-gray-400 py-3 w-full mt-2">-->
<!--            <div class="montserrat font-bold text-md text-gray-900 dark:text-white">Species filter</div>-->
<!--            <div>-->
<!--                <label for="checked-toggle2" class="inline-flex relative items-center cursor-pointer">-->
<!--                    <input type="checkbox" @change="update('notify_inspections',notify_inspections)" v-model="notify_inspections" id="checked-toggle2" class="sr-only peer" >-->
<!--                    <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  dark:border-gray-600 peer-checked:bg-blue-600"></div>-->
<!--                </label>-->
<!--            </div>-->
<!--        </div>-->
        <div class="flex justify-between items-center py-3 w-full mt-2">
            <div class="montserrat font-bold text-md text-gray-900 dark:text-white">Trap Issues</div>
            <div>
                <label for="checked-toggle3" class="inline-flex relative items-center cursor-pointer">
                    <input type="checkbox" @change="update('notify_problems',notify_problems)" v-model="notify_problems" id="checked-toggle3" class="sr-only peer" >
                    <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>
        </div>
    </div>
    <h6 class="w-full font-bold montserrat text-xl text-dark dark:text-white  px-4 border-t-2 border-gray-400">

    </h6>
    <div class=" w-full px-8 mt-5 flex flex-wrap justify-center">
        <a @click="visible = !visible" type="button" class="font-fira font-bold  text-t_purple-300 text-md">
            <span class="uppercase underline">leave project</span>
        </a>
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
</template>

<script>
import ModalWindow from "@/Components/ModalWindow.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {ElMessage} from "element-plus";

export default {
    components:{
        ModalWindow
    },
    props:{
        project: Object,
        user_data: Object,
        coordinator: Boolean,
        notify_catches:{
            type: Boolean,
            default: false
        },
        notify_inspections:{
            type: Boolean,
            default: false
        },
        notify_problems:{
            type: Boolean,
            default: false
        },

    },
    name: "InProject",
    data() {
        return {
            show: false,
            visible:false,
            visible_sync:false,
            visible_sync_done:false,
            msg:null,
            form:useForm({
                projectId:null
            }),
            updateUserSettings: useForm({
                projectId:null,
                value:null,
                key:null,
            }),
        }
    },
    mounted() {
        if (this.$page.props.auth.user !== null){
            Echo.private('App.Models.User.' + this.$page.props.auth.user.id ?? 0)
                .notification((notification) => {
                    this.msg = notification.message
                    this.visible_sync = false;
                    this.visible_sync_done = false;
                    this.visible_sync_done = true;
                });
        }
    },
    methods: {
        enter(){
            this.form.projectId = this.project.id;
            this.form.post(route('user.projects.enter'))
        },
        leave(){
            this.form.projectId = this.project.id;
            this.form.post(route('user.projects.leave'))
        },
        syncPr(){
            this.visible_sync = true
            this.form.projectId = this.project.id;
            this.form.post(route('user.projects.sync'))
        },
        update(key, value){
            this.updateUserSettings.projectId = this.project.id
            this.updateUserSettings.value = value
            this.updateUserSettings.key = key
            this.updateUserSettings.put(route('user.projects.update_user'),{
                preserveScroll:true,
                preserveState:true
            })
        }
    }
}
</script>

<style scoped>

</style>
