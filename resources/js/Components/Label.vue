<script setup>
defineProps(['value']);
</script>

<template>
    <label class="font-bold text-lg text-text-light dark:text-text-dark text-left dark:text-white">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
