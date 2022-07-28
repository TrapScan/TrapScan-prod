<template>
    <span class="px-4 pt-10 pb-5 text-4xl font-bold text-lg ">Is this correct?</span>
    <div class="flex flex-col h-full gap-y-3 mt-5 px-4 mb-24">
        <div class="flex w-full mx-auto mt-4 mb-6">
            <button @click='selected(0)' class="flex mt-2 items-center font-bold justify-center focus:outline-none text-white text-lg sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-4 w-full transition duration-150 ease-in">
                <span class="uppercase">Yes, submit inspection</span>
            </button>
        </div>
        <div @click='selected(7)' class="flex w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val><template #icon><edit/></template> Add note first</text-val>
            <arrow-next/>
        </div>
        <div @click='selected(8)' class="flex w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val><template #icon><no class="mt-1"/></template> No, let me edit</text-val>
            <arrow-next/>
        </div>
    </div>
</template>

<script>
import ArrowUp from "@/Components/SVG/ArrowUp.vue";
import Note from "@/Components/SVG/Note.vue";
import ArrowNext from "@/Components/SVG/ArrowNext.vue";
import TextVal from "@/Components/Inspection/Other/TextVal.vue";
import No from  "@/Components/SVG/No.vue";
import Edit from "@/Components/SVG/Edit.vue";
export default {
    name: "StepSix",
    components: {Edit, TextVal, ArrowNext, No, Note, ArrowUp},
    data() {
        return {

        }
    },
    methods:{
        selected (val){
            this.$emit('selected',val)
        }
    }
}
</script>

<style scoped>

</style>
