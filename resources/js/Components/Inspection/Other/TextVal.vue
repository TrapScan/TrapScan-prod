<template>
    <div class="flex ubuntu place-content-center  items-center">
        <div class="flex justify-center py-1.5 align-content-center w-16 h-5 dark:bg-mirage-500 bg-gray-200 rounded-xl h-11">
            <slot name="icon"></slot>
        </div>
        <span class="ml-3 ubuntu dark:text-white font-bold text-xl"><slot></slot></span>
    </div>
</template>

<!--<script setup>-->
<!--import {computed} from 'vue';-->

<!--computed(() => {-->
<!--    hasFooterSlot()-->
<!--    hasHintTextSlot()-->
<!--});-->

<!--function hasFooterSlot(){-->
<!--    return !!this.$slots.icon-->
<!--}-->

<!--function hasHintTextSlot(){-->
<!--    return !!this.$slots.hint_text-->
<!--}-->
<!--</script>-->

<!--<template>-->
<!--    <div class="flex montserrat place-content-center w-full">-->
<!--        <div class="flex justify-center py-1.5 align-content-center w-16 h-5 dark:bg-mirage-500 bg-gray-200 rounded-xl h-11" v-if="hasFooterSlot">-->
<!--            <slot name="icon"></slot>-->
<!--        </div>-->
<!--        <span class="ml-3 ubuntu dark:text-white font-bold text-xl"><slot></slot></span>-->

<!--        <div v-if="hasHintTextSlot">-->
<!--            <slot name="hint_text"></slot>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->
