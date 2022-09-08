<template>
    <button class="
    w-full
    rounded-full
    border-t_purple-700
    border-[3px]
    text-t_purple-700
    dark:border-t_purple-700
    py-[8px]
    px-[32px]
    flex
    justify-center
    items-center
    font-extrabold
    text-[13px]
    montserrat
    hover:bg-opacity-80
    uppercase
    h-[50px]
">
        <slot name="default"/>
    </button>
</template>

<script>
export default {
    name: "Secondary"
}
</script>

<style scoped>

</style>
