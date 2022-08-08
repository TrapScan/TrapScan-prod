<template>
    <button class="
    w-full
    rounded-full
    border-light_button
    border-2
    text-light_button
    dark:border-light_tertiary_button
    dark:text-light_tertiary_button
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
    name: "Secondary"
}
</script>

<style scoped>

</style>
