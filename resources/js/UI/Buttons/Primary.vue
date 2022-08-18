<template>
    <button class="
    w-full
    rounded-full
    bg-light_button
    text-text-dark
    dark:bg-dark_button
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
    name: "Primary"
}
</script>

<style scoped>

</style>
