<template>
    <button class="
    w-full
    rounded-full
    bg-red
    text-text-dark
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
    name: "Destructive"
}
</script>

<style scoped>

</style>
