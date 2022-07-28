<template>
    <Show>
        <template #header>
            <div @click="back">

            </div>
            <div>
                <Link :href="route('scan')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 dark:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </Link>
            </div>
        </template>
        <div class="py-16 flex justify-center w-full bg-caribbean-green">
            <svg class="stroke-caribbean-green" width="96" height="96" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect y="64" width="11.5194" height="44.4319" transform="rotate(-45 0 64)" fill="#0AB587"/>
                <rect x="87.2725" y="23.2727" width="11.5194" height="90.5094" transform="rotate(45 87.2725 23.2727)" fill="#0AB587"/>
            </svg>
        </div>
        <div class="flex justify-center flex-col w-full mt-6">
            <h1 class="text-3xl font-bold text-black dark:text-white montserrat text-center">Success</h1>
            <h4 class="font-bold text-black dark:text-white ubuntu text-center mt-2">Your inspection has been recorded</h4>
            <div class="mt-6 ml-8 px-4 text-lg text-gray-600 border-l-4 border-l-gray-300">
                <p v-if="trap?.last_checked && trap?.last_checked_by" class="ubuntu mb-3">
                    This trap was last checked
                    <b>{{ trap.last_checked }}</b> by
                    <b>{{ trap.last_checked_by }}</b>
                </p>
                <p v-if="trap?.last_caught" class="ubuntu mb-3">
                    The trap last caught a
                    <b>{{ trap.last_caught }}</b>
                </p>
                <p class="ubuntu mb-3">There have been <span class="font-bold">{{ trap.total_catches ?? 0 }}</span> catches in this trap before now</p>
            </div>
        </div>
        <div class="flex mt-20 justify-center flex-wrap ">
            <h6 class="ubuntu text-xl w-full text-center text-gray-400">Don’t have an account?</h6>
            <Link class="flex mt-2 items-center font-bold justify-center focus:outline-none text-white text-lg sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-4 w-full transition duration-150 ease-in" :href="route('register')">
                <span class="uppercase">finish</span>
            </Link>
        </div>
    </Show>
</template>

<script>
import Show from "@/Layouts/Show.vue";
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components:{
        Show,
        Link
    },
    name: "InspectionDone",
    props:{
        trap_data:String,
        inspection: Object,
        trap: Object
    },
    data() {
        return {

        }
    },
    methods:{

    }
}
</script>

<style scoped>

</style>
