<script setup>
import ArrowNext from "@/Components/SVG/ArrowNext.vue";
defineProps({
    text:{
        type:String
    },
    small_text:{
        type:String,
        default:null
    }
});
</script>

<template>
    <div class="w-full hover:scale-x-105 duration-1000 overflow-hidden items-center dark:bg-t_black-750 justify-center bg-white px-[16px] py-[12px] border-black h-[72px] flex justify-between rounded-[6px] mb-4">
        <div class="h-[44px] w-[44px] justify-center flex rounded-lg shadow-sm dark:bg-gray-900 bg-gray-100" v-if="$slots.svg">
            <slot name="svg"/>
        </div>
        <div class="ml-1 w-9/12">
            <p class="font-fira font-bold">{{text}}</p>
            <p class="text-sm font-fira text-gray-400" v-if="small_text !== null">{{small_text}}</p>
        </div>
        <div class="ml-3 py-3">
            <arrow-next/>
        </div>
    </div>
</template>
