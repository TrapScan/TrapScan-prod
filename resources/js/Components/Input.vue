<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    type: {
        type: String,
        default: 'text',
    },
    modelValue: String,
    label: String,
    disabled:{
        type: Boolean,
        default: false
    }
});
defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
    <div class="flex flex-wrap w-full mb-5">
        <label class="w-full font-fira text-2xs text-t_black-800 dark:text-t_white-200 mb-2">
            {{label}}
        </label>
        <input v-if="!disabled" :type="type" class="border-t_blue_gray-700 border-[3.5px] dark:border-t_blue_gray-300 dark:bg-dark_input_bg w-full px-[12px] py-[8px] dark:text-t_white-200 font-fira focus:border-dark_button dark:focus:border-dark_button rounded-[0.375em] shadow-sm" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
        <input v-else disabled :type="type" class="border-t_blue_gray-700 border-[3.5px] dark:border-t_blue_gray-300 dark:bg-dark_input_bg w-full px-[12px] py-[8px] dark:text-t_white-200 font-fira focus:border-dark_button dark:focus:border-dark_button rounded-[0.375em] shadow-sm" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
    </div>
</template>
