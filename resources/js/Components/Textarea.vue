<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
    <textarea placeholder="Type notes about the inspection here" rows="3" cols="10" class="border-t_blue_gray-700 border-[3px] dark:border-white dark:bg-dark_input_bg w-full p-4 focus:border-dark_button dark:focus:border-dark_button rounded-[3px] shadow-sm" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input"/>
</template>
