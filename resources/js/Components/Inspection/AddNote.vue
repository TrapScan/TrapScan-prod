<template>
    <div class="flex flex-col h-full gap-y-3 mt-5 px-4 mb-24">
        <textarea v-model="val" placeholder="Inspection Note" cols="90" rows="6" class="px-3 py-3 placeholder-slate-500 text-xl text-slate-600 relative bg-white bg-white rounded-xl text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>

        <div class="flex w-full mx-auto">
            <button @click='selected(0)' class="flex mt-2 items-center font-bold justify-center focus:outline-none text-white text-sm sm:text-base bg-bay-of-many-500 hover:bg-bay-of-many-600 rounded-2xl py-3 w-full transition duration-150 ease-in">
                <span class="mr-2 uppercase">Yes, submit inspection</span>
            </button>
        </div>
        <div @click='selected(8)' class="flex w-full mx-auto border rounded-xl dark:border-white border-gray-900 p-5 justify-between bg-white dark:bg-mirage-400">
            <text-val><template #icon><pen/></template> Edit Inspection</text-val>
            <arrow-next/>
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
                this.$emit('selected',{notes: this.val, step: 8})
            }
        }
    }
}
</script>

<style scoped>

</style>
