<template>
    <div class="flex items-center">
        <div class="flex w-full bg-white rounded-full shadow">
            <input class="relative px-6 py-3 w-full rounded-full focus:shadow-outline" autocomplete="off" type="text" name="search" placeholder="Search…" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
        </div>
        <button class="ml-3 text-gray-500 dark:text-white hover:text-gray-700 focus:text-indigo-500 text-sm" type="button" @click="$emit('reset')">Reset</button>
    </div>
</template>

<script>
export default {
    components: {
    },
    props: {
        modelValue: String,
        maxWidth: {
            type: Number,
            default: 300,
        },
    },
    emits: ['update:modelValue', 'reset'],
}
</script>
