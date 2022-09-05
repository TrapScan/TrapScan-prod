<template>
    <h1 v-if="type" class="text-t_purple-700 text-[36px] dark:text-t_purple-200 montserrat text font-bold text-3xl ml-4 mb-2">
       <slot/>
    </h1>
    <h2 v-else class="text-t_black-800 text-[24px] dark:text-white font-fira text font-bold text-3xl ml-4 mb-2">
        <slot/>
    </h2>
</template>

<script>
export default {
    props:{
      type:{
          type:Boolean,
          default:false
      }
    },
    name: "Heading_H1"
}
</script>

<style scoped>

</style>
