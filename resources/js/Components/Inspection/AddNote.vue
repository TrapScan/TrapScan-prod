<template>
    <div class="flex flex-wrap overflow-hidden mx-[24px]">
        <ts-label value="Notes"/>
        <ts-text-area v-model="val"/>

        <div class="flex w-full mx-auto mt-4">
            <primary @click='selected(0)' >submit inspection</primary>
        </div>
        <div class="flex w-full mx-auto mt-4">
            <secondary @click='selected(6)'>view summary first</secondary>
        </div>

    </div>
</template>

<script>
import ArrowUp from "@/Components/SVG/ArrowUp.vue";
import Note from "@/Components/SVG/Note.vue";
import Pen from "@/Components/SVG/Pen.vue";
import ArrowNext from "@/Components/SVG/ArrowNext.vue";
import TextVal from "@/Components/Inspection/Other/TextVal.vue";
import Secondary from "@/UI/Buttons/Secondary.vue";
import Primary from "@/UI/Buttons/Primary.vue";
import TsTextArea from "@/Components/Textarea.vue"
import TsLabel from "@/Components/Label.vue"


export default {
    name: "AddNote",
    components: {TextVal, ArrowNext, Pen, Note, ArrowUp, Primary, Secondary, TsTextArea,TsLabel},
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
