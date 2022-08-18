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
    <textarea rows="5" cols="10" class="border-gray-900 border-4 dark:border-white dark:bg-dark_input_bg w-full p-4 focus:border-dark_button dark:focus:border-dark_button rounded-md shadow-sm" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input"/>
</template>
