<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="w-9/12 flex mt-2 items-center justify-center focus:outline-none text-bay-of-many-500 font-bold text-sm sm:text-base border-2 border-bay-of-many-500 hover:bg-bay-of-many-500 hover:text-white rounded-2xl py-2 w-full transition duration-150 ease-in">
        <slot />
    </button>
</template>
