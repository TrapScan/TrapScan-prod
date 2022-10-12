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
    <div :class="{'mb-[16px] h-[80px]':$slots.svg && small_text !== null, 'mb-[24px] h-[72px]': $slots.svg && small_text === null, 'mb-[16px] h-[48px]': !$slots.svg && small_text === null}"
         class="w-full hover:border-[3px] hover:border-t_purple-500 duration-500 overflow-hidden items-center dark:bg-t_black-800 justify-center bg-white px-[16px] py-[16px] border-black  flex justify-between rounded-[4px]">
        <div class="h-[44px] w-[44px] justify-center flex items-center rounded-[4px] dark:bg-gray-900 bg-gray-100" v-if="$slots.svg">
            <slot name="svg"/>
        </div>
        <div class="ml-1 w-9/12">
            <p class="font-fira font-medium dark:text-t_white-200 tracking-[.05em]">{{text}}</p>
            <p class="text-sm font-fira text-gray-400" v-if="small_text !== null">{{small_text}}</p>
        </div>
        <div class="ml-3 py-3">
            <arrow-next/>
        </div>
    </div>
</template>
