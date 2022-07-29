<template>
    <div class="flex flex-col h-full gap-y-3 mt-5 px-4 mb-24 ">
        <h6 class="ml-4 mt-6 mb-2 w-full text-2xl montserrat font-bold font-weight-bold dark:text-white">MY PROJECTS</h6>
        <hr class="w-full bg-mystic-800 h-1 dark:bg-white">
        <div class="flex flex-col h-full gap-y-1">
            <div v-for="item in list" :key="item.name" class="w-full text-gray-900 bg-white rounded-lg border border-dark dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <button  type="button" class="inline-flex relative items-center py-6 px-4 w-full text-xl font-medium rounded-t-lg border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                    {{item.name}}
                </button>
            </div>
        </div>

    </div>
</template>

<script>
import TextVal from "@/Components/Inspection/Other/TextVal.vue";
export default {
    components: {TextVal},
    name: "Index",
    props:{
        list: Object
    }
}
</script>

<style scoped>

</style>
