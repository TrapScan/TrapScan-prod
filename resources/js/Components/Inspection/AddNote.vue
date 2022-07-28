<template>
    <div class="flex flex-col h-full gap-y-3 mt-5 px-4 mb-24">
        <textarea v-model="val" placeholder="Inspection Note" cols="90" rows="6" class="block py-3 px-4 w-full text-base text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>

        <div class="flex w-full mx-auto mt-4">
            <button @click='selected(0)' class="flex mt-2 items-center font-bold justify-center focus:outline-none text-white text-lg sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-4 w-full transition duration-150 ease-in">
                <span class="mr-2 uppercase">submit inspection</span>
            </button>
        </div>
        <div class="flex w-full mx-auto mt-4">
            <button @click='selected(6)' class="flex mt-2 items-center font-bold justify-center focus:outline-none text-white text-lg sm:text-base border-2  border-bay-of-many-500 hover:bg-bay-of-many-600 rounded-full py-4 w-full transition duration-150 ease-in">
                <span class="mr-2 uppercase text-bay-of-many-500">back to summary screen</span>
            </button>
        </div>

    </div>
</template>

<script>
import ArrowUp from "@/Components/SVG/ArrowUp.vue";
import Note from "@/Components/SVG/Note.vue";
import Pen from "@/Components/SVG/Pen.vue";
import ArrowNext from "@/Components/SVG/ArrowNext.vue";
import TextVal from "@/Components/Inspection/Other/TextVal.vue";
export default {
    name: "AddNote",
    components: {TextVal, ArrowNext, Pen, Note, ArrowUp},
    props:{
        text:String
    },
    data() {
        return {
            val:this.text
        }
    },
    methods:{
        selected (val){
            if (val === 0){
                this.$emit('selected',{notes: this.val, step: 0})
            } else {
                this.$emit('selected',{notes: this.val, step: 6})
            }
        }
    }
}
</script>

<style scoped>

</style>
