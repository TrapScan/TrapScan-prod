<script setup>
defineProps(['value']);
</script>

<template>
    <label class="w-full font-fira text-2xs text-t_black-800 dark:text-t_white-200 mb-2">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
