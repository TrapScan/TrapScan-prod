<template>
    <Show>
        <template #header>
            <div @click="route('install_qr',qr.qr_code)">
                <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.39316 12.0653C7.86179 11.5966 7.86179 10.8368 7.39316 10.3682L3.44168 6.41675L7.39316 2.46528C7.86179 1.99665 7.86179 1.23685 7.39316 0.76822C6.92453 0.299591 6.16473 0.299591 5.6961 0.76822L0.896099 5.56822C0.427469 6.03685 0.427469 6.79665 0.896099 7.26528L5.6961 12.0653C6.16473 12.5339 6.92453 12.5339 7.39316 12.0653Z" fill="white"/>
                </svg>
            </div>
            <div>
                <h1 class="text-white font-bold ml-1 text-[16px] montserrat capitalize tracking-wide tracking-[.05em]">{{qr.qr_code}}</h1>
            </div>
            <div @click="back">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.837327 0.709641C1.22785 0.319117 1.86102 0.319117 2.25154 0.709641L6.54443 5.00253L10.8373 0.709639C11.2279 0.319115 11.861 0.319115 12.2515 0.709639C12.6421 1.10016 12.6421 1.73333 12.2515 2.12385L7.95865 6.41675L12.2515 10.7096C12.6421 11.1002 12.6421 11.7333 12.2515 12.1239C11.861 12.5144 11.2279 12.5144 10.8373 12.1239L6.54443 7.83096L2.25154 12.1239C1.86102 12.5144 1.22785 12.5144 0.837329 12.1239C0.446804 11.7333 0.446804 11.1002 0.837329 10.7096L5.13022 6.41675L0.837327 2.12385C0.446803 1.73333 0.446803 1.10017 0.837327 0.709641Z" fill="white"/>
                </svg>
            </div>
        </template>
        <template #last>
            <div class="bg-t_warms-300 w-full flex justify-center items-end py-[6px]">
                <h6 class="italic text-t_black-800  montserrat text-[12px] " >
                    QR <span class="font-bold montserrat capitalize">{{oldQR.qr_code}}</span> is already linked to this trap
                </h6>
            </div>
        </template>
        <div class="px-[24px] w-full flex flex-wrap">
            <div class="w-full">
                <div class="flex justify-center flex-col w-full">
                    <div class="text-t_black-800 dark:text-t_white-150 font-fira text-[18px]">
                        <p class="mb-4">Installing this QR on trap <span class="font-bold">{{trap.name}}</span> will replace the existing QR</p>
                        <p class="mb-4"> <span class="font-bold montserrat capitalize">{{oldQR.qr_code}}</span>  will be uninstalled and free to install on another trap</p>
                    </div>
                </div>
                <span class="w-full text-[24px] font-bold text-t_black-800 dark:text-t_white-200 font-fira font-semibold">
                    Are you sure you want to install on this trap?
                </span>
                <div class="flex flex-wrap overflow-hidden  mt-[24px] ">
                    <panel @click="select" text="Yes" small_text="Install and replace existing QR ">
                        <template #svg>
                            <good/>
                        </template>
                    </panel>
                    <Link :href="route('install_qr',qr.qr_code)" class="w-full">
                        <panel text="No" small_text="Choose a different trap">
                            <template #svg>
                                <no/>
                            </template>
                        </panel>
                    </Link>
                </div>
            </div>

        </div>
    </Show>
</template>

<script>
import Show from "@/Layouts/Show.vue";
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import {Link, useForm} from '@inertiajs/inertia-vue3'
import SelectComponent from '@/Components/SelectComponent.vue'

import Panel from "@/Components/Panel.vue"
import No from  "@/Components/SVG/No.vue";
import Good from "@/Components/SVG/Good.vue";
export default {
    components:{
        Link,
        BreezeGuestLayout,
        Show,
        SelectComponent,
        Panel,
        No,
        Good
    },
    name: "RemapQR",
    props:{
        qr:Object,
        qr_id:String,
        nz_id:String,
        trap:Object,
        oldQR:Object,
    },
    data() {
        return {
            search_text:null,
            collection:[],
            newQR: useForm({
                qr_id:this.qr_id,
                nz_id:this.nz_id,
                confirmed:1
            }),
        }
    },
    mounted() {

    },
    watch: {

    },
    methods: {
        back(){
            this.$inertia.visit(this.route('scan'));
        },

        select(){
            this.newQR.post(route('inspection.map_trap'),{
                preserveScroll: true,
                preserveState: true,
                onSuccess:() => {
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
