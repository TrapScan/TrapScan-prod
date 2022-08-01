<template>
    <div class="flex flex-wrap mt-5 px-4">
        <h6 class="font-bold montserrat text-xl text-dark dark:text-white">
            Trap.NZ synchronisation
        </h6>
<!--        <div class=" pt-4 ml-5 pb-2 w-full flex">-->
<!--            <h6 class="font-italic text-gray-500 ">-->
<!--                Last checked <span class="font-bold">3 weeks</span> ago-->
<!--            </h6>-->
<!--        </div>-->
        <div class=" w-full px-8 mt-5">
            <button type="button" class="flex montserrat items-center font-bold justify-center focus:outline-none text-white text-md sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-3 w-full transition duration-150 ease-in">
                <span class="uppercase">sync trap.nz traps</span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        project: Object,
        user_data: Object,
        coordinator: Boolean
    },
    name: "InProject"
}
</script>

<style scoped>

</style>
