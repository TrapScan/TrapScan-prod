<template>
    <div class="min-h-screen h-full bg-t_blue_gray-100  dark:bg-t_black-900 ">
        <nav class="bg-t_green-800 h-[44px] flex items-center justify-between flex-wrap w-full shadow-2xl px-4">
            <Link :href="route('inspection.index',trap.qr_id)">
                <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.39316 12.0653C7.86179 11.5966 7.86179 10.8368 7.39316 10.3682L3.44168 6.41675L7.39316 2.46528C7.86179 1.99665 7.86179 1.23685 7.39316 0.76822C6.92453 0.299591 6.16473 0.299591 5.6961 0.76822L0.896099 5.56822C0.427469 6.03685 0.427469 6.79665 0.896099 7.26528L5.6961 12.0653C6.16473 12.5339 6.92453 12.5339 7.39316 12.0653Z" fill="white"/>
                </svg>
            </Link>
            <div>
                <h1 class="text-white font-bold ml-1 text-[16px] font-fira tracking-wide">{{trap.qr_id}}</h1>
            </div>
            <div>
                <Link :href="route('scan')">
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.837327 0.709641C1.22785 0.319117 1.86102 0.319117 2.25154 0.709641L6.54443 5.00253L10.8373 0.709639C11.2279 0.319115 11.861 0.319115 12.2515 0.709639C12.6421 1.10016 12.6421 1.73333 12.2515 2.12385L7.95865 6.41675L12.2515 10.7096C12.6421 11.1002 12.6421 11.7333 12.2515 12.1239C11.861 12.5144 11.2279 12.5144 10.8373 12.1239L6.54443 7.83096L2.25154 12.1239C1.86102 12.5144 1.22785 12.5144 0.837329 12.1239C0.446804 11.7333 0.446804 11.1002 0.837329 10.7096L5.13022 6.41675L0.837327 2.12385C0.446803 1.73333 0.446803 1.10017 0.837327 0.709641Z" fill="white"/>
                    </svg>
                </Link>
            </div>
        </nav>
        <main class="h-full max-w-lg flex flex-wrap w-full mx-auto justify-center overflow-auto">
            <div class="h-[116px] pb-5 justify-center flex items-center w-full bg-green_highlight">
                <svg width="96" height="96" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="11.5039" height="44.372" transform="matrix(0.706152 -0.70806 0.706152 0.70806 0.629883 64.1406)" fill="#0AB587"/>
                    <rect width="11.5039" height="90.3875" transform="matrix(0.706152 0.70806 -0.706152 0.70806 87.668 23.4131)" fill="#0AB587"/>
                </svg>
            </div>
            <div class="flex justify-center flex-col w-full bg-light_menu_bar_bg dark:bg-t_black-750">
                <h1 class="text-[24px] font-fira font-semibold text-black dark:text-white text-center dark:text-t_white-150">Success</h1>
                <h4 class="font-normal text-black dark:text-white text-[18px] font-fira text-center mt-2 dark:text-t_white-150">Your inspection has been recorded</h4>

            </div>
            <div class="flex justify-center flex-col w-full mt-6">
                <div class="mt-6 ml-8 px-4 text-lg text-t_black-800 dark:text-t_white-150 font-fira text-[18px]">
                    <p v-if="trap?.last_checked && trap?.last_checked_by" class=" mb-3">
                        This trap was last checked
                        <b>{{ trap.last_checked }}</b> by
                        <b>{{ trap.last_checked_by }}</b>
                    </p>
                    <p v-if="trap?.last_caught" class=" mb-3">
                        The trap last caught a
                        <b>{{ trap.last_caught }}</b>
                    </p>
                    <p class="   mb-3">There have been <span class="font-bold">{{ trap.total_catches ?? 0 }}</span> catches in this trap before now</p>
                </div>
            </div>
            <div class="flex mt-20 justify-center flex-wrap w-full">
                <Link :href="route('register')" class="w-10/12">
                    <primary>finish</primary>
                </Link>
            </div>
        </main>

    </div>


</template>

<script>
import Show from "@/Layouts/Show.vue";
import { Link } from '@inertiajs/inertia-vue3'
import Primary from "@/UI/Buttons/Primary.vue";

export default {
    components:{
        Show,
        Link,
        Primary
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
