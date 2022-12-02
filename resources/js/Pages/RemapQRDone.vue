<template>
    <div class="min-h-screen h-full bg-t_blue_gray-100  dark:bg-t_black-900 ">
        <nav class="bg-t_green-800 h-[44px] flex items-center justify-between flex-wrap w-full shadow-2xl px-4">
            <div></div>
            <div>
                <h1 class="text-white font-bold ml-1 text-[16px] font-fira tracking-wide">{{qr_id}}</h1>
            </div>
            <div>
                <Link :href="route('scan',qr_id)">
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
            <div class="flex justify-center flex-col w-full bg-light_menu_bar_bg dark:bg-t_black-800">
                <h1 class="text-[18px] font-fira font-[700] text-center dark:text-t_white-200">QR Installed</h1>
            </div>
            <div class="flex justify-center flex-col w-full mt-6">
                <div class="mt-6 ml-8 px-4 text-lg text-t_black-800 dark:text-t_white-150 font-fira text-[18px]">

                    <p class="mb-3"><span class="font-bold montserrat capitalize">{{qr_id}}</span> is now linked to <span class="font-bold">{{trap_name}}</span></p>
                    <p class="mb-3" v-if="old_qr_id !== null">QR <span class="font-bold montserrat capitalize">{{old_qr_id}}</span> is now free to be installed on another trap</p>
                </div>
            </div>
            <div class="flex mt-20 justify-center flex-wrap w-full">
                <Link :href="route('scan',qr_id)" class="w-10/12">
                    <primary>finish</primary>
                </Link>
            </div>
        </main>

    </div>

</template>

<script>
import {Link} from '@inertiajs/inertia-vue3'
import Primary from "@/UI/Buttons/Primary.vue";

export default {
    components:{
        Link,
        Primary
    },
    name: "RemapQR",
    props:{
        trap_name:String,
        qr_id:String,
        old_qr_id:String,
    },
    data() {
        return {
        }
    },
    mounted() {
    },
    watch: {

    },
    methods: {
    }
}
</script>

<style scoped>

</style>
