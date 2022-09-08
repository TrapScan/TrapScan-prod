<template>
    <button class="
    w-full
    rounded-full
    bg-t_white-150
    text-t_purple-800
    dark:bg-t_black-800
    dark:text-t_white-200
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
    name: "Tertiary"
}
</script>

<style scoped>

</style>
