<template>
    <button class="
    w-full
    rounded-full
    bg-light_tertiary_button
    text-light_button
    dark:bg-dark_tertiary_button
    dark:text-text-dark
    py-4
    flex
    justify-center
    items-center
    font-bold
    montserrat
    hover:bg-opacity-80
    uppercase
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
